<?php
// deploy_helper.php
// Place this file in public/deploy_helper.php to run artisan commands on Hostinger Shared Hosting via browser.

header('Content-Type: text/plain');

// Clear OPcache immediately to force Hostinger to reload the updated files!
if (function_exists('opcache_reset')) {
    @opcache_reset();
}

try {
    require __DIR__.'/../vendor/autoload.php';
    $app = require_once __DIR__.'/../bootstrap/app.php';
    
    // Overwrite public path instance early to __DIR__
    $app->usePublicPath(__DIR__);
    $app->instance('path.public', __DIR__);
    
    $kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
    $kernel->bootstrap();
} catch (\Exception $e) {
    die("Error bootstrapping Laravel: " . $e->getMessage());
}

use Illuminate\Support\Facades\Artisan;

echo "--- Laravel Shared Hosting Deployment Helper ---\n\n";

// 1. Run migrations
try {
    echo "Step 1: Running migrations...\n";
    Artisan::call('migrate', ['--force' => true]);
    echo Artisan::output() . "\n";
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n\n";
}

// 2. Storage Link (Fail-safe wrapper for direct public storage setup)
try {
    echo "Step 2: Configuring storage folder...\n";
    
    $activeLink = __DIR__ . '/storage';
    $target = storage_path('app/public');
    
    echo "Active public directory storage path: " . $activeLink . "\n";
    
    // Check if it is a physical directory
    if (file_exists($activeLink) && is_dir($activeLink) && !is_link($activeLink)) {
        echo "Note: A physical directory already exists at public/storage. Direct public storage uploads are enabled and active!\n";
        echo "No symbolic linking is required. Skipping link creation.\n\n";
    } else {
        // Clean up if old link exists
        if (is_link($activeLink) || file_exists($activeLink)) {
            echo "Removing existing active storage link...\n";
            @unlink($activeLink);
        }
        
        // Since symlink is disabled on Hostinger, let's create the physical directory directly!
        echo "Creating physical storage directory at: " . $activeLink . "...\n";
        if (@mkdir($activeLink, 0755, true)) {
            echo "SUCCESS: Physical storage directory created successfully with write permissions!\n\n";
        } else {
            echo "Direct symbolic linking not supported by server. Relying on direct directory storage.\n\n";
        }
    }
} catch (\Throwable $e) {
    echo "Notice: Symlink setup skipped (" . $e->getMessage() . "). App will rely on direct public folder writes.\n\n";
}

// 3. Cache Clearing (Critical for dynamic path resolving on Shared Hosting)
try {
    echo "Step 3: Clearing application caches to enable dynamic public_html path resolving...\n";
    
    // Clear config cache to prevent hardcoded /public path compilation
    Artisan::call('config:clear');
    echo "Config Cache Cleared: " . Artisan::output();
    
    Artisan::call('route:clear');
    echo "Route Cache Cleared: " . Artisan::output();
    
    Artisan::call('view:clear');
    echo "View Cache Cleared: " . Artisan::output() . "\n";
} catch (\Exception $e) {
    echo "Error clearing cache: " . $e->getMessage() . "\n\n";
}

// 4. Storage Directory Diagnostics
try {
    echo "Step 4: Running storage diagnostics...\n";
    $storagePath = __DIR__ . '/storage';
    
    // Add config path prints
    echo "Active Public Disk Configuration Root: " . config('filesystems.disks.public.root') . "\n";
    echo "Active Public Path: " . public_path() . "\n";
    echo "Active Base Path: " . base_path() . "\n";
    
    if (!file_exists($storagePath)) {
        echo "FAIL: Storage folder does NOT exist at: " . $storagePath . "\n";
    } else {
        echo "SUCCESS: Storage folder exists at: " . $storagePath . "\n";
        echo "Permissions: " . substr(sprintf('%o', fileperms($storagePath)), -4) . "\n";
        echo "Is Writable: " . (is_writable($storagePath) ? 'YES' : 'NO') . "\n";
        echo "Is Readable: " . (is_readable($storagePath) ? 'YES' : 'NO') . "\n";
        echo "Is Link: " . (is_link($storagePath) ? 'YES' : 'NO') . "\n";
        
        // List contents recursively
        echo "\nListing storage directory contents:\n";
        $dirIter = new RecursiveDirectoryIterator($storagePath, RecursiveDirectoryIterator::SKIP_DOTS);
        $iter = new RecursiveIteratorIterator($dirIter, RecursiveIteratorIterator::SELF_FIRST);
        $fileCount = 0;
        foreach ($iter as $file) {
            $relativePath = str_replace($storagePath, '', $file->getPathname());
            echo " - " . ($file->isDir() ? '[DIR]' : '[FILE]') . " " . $relativePath . "\n";
            $fileCount++;
        }
        if ($fileCount === 0) {
            echo " (Directory is completely empty)\n";
        }
    }
    
    // Check DB
    echo "\nChecking latest blog post in Database:\n";
    $latestBlog = \App\Models\Blog::latest()->first();
    if ($latestBlog) {
        echo "Latest Blog ID: " . $latestBlog->id . "\n";
        echo "Title: " . $latestBlog->title . "\n";
        echo "Featured Image DB Value: " . $latestBlog->featured_image . "\n";
        
        $realFilePath = $storagePath . '/' . $latestBlog->featured_image;
        echo "Expected physical file path: " . $realFilePath . "\n";
        echo "Does physical file exist in public_html: " . (file_exists($realFilePath) ? 'YES' : 'NO') . "\n";
        
        // Check old storage path
        $oldStorageFilePath = storage_path('app/public/' . $latestBlog->featured_image);
        echo "Old expected storage path: " . $oldStorageFilePath . "\n";
        echo "Does physical file exist in old storage directory: " . (file_exists($oldStorageFilePath) ? 'YES' : 'NO') . "\n";
    } else {
        echo "No blog posts found in database.\n";
    }
    
} catch (\Exception $e) {
    echo "Diagnostics Error: " . $e->getMessage() . "\n";
}

// 5. Clean up Company Slugs
try {
    echo "\nStep 5: Cleaning up company slugs (removing trailing random numbers)...\n";
    $companies = \App\Models\Company::all();
    $count = 0;
    foreach ($companies as $company) {
        if (preg_match('/-\d{3}$/', $company->slug)) {
            $cleanSlug = preg_replace('/-\d{3}$/', '', $company->slug);
            $exists = \App\Models\Company::where('slug', $cleanSlug)->where('id', '!=', $company->id)->exists();
            if (!$exists) {
                $company->slug = $cleanSlug;
                $company->save();
                $count++;
                echo " - Cleaned: {$company->name} -> {$cleanSlug}\n";
            }
        }
    }
    echo "Total slugs cleaned successfully: {$count}\n";
} catch (\Exception $e) {
    echo "Error cleaning slugs: " . $e->getMessage() . "\n";
}

echo "\n--- Setup Complete! Please delete public/deploy_helper.php for security ---";
