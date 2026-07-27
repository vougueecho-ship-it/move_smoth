<?php

use Illuminate\Support\Facades\Route;

require __DIR__.'/frontend.php';
require __DIR__.'/admin.php';
require __DIR__.'/company.php';

// SEO Routes
Route::get('/sitemap.xml', function () {
    // If not in local development, force canonical scheme and domain for sitemap URLs
    if (!str_contains(request()->getHost(), 'localhost') && !str_contains(request()->getHost(), '127.0.0.1')) {
        \Illuminate\Support\Facades\URL::forceScheme('https');
        \Illuminate\Support\Facades\URL::forceRootUrl('https://movesmoth.com');
    }

    $companies = \App\Models\Company::select('slug', 'updated_at')->where('is_active', true)->get();
    $blogs = \App\Models\Blog::select('slug', 'category_id', 'updated_at')->with('category')->get();
    $states = \App\Models\State::active()->get();
    $cities = \App\Models\City::active()->with(['state', 'content'])->get();
    return response()->view('sitemap', compact('companies','blogs','states','cities'))->header('Content-Type', 'application/xml');
})->name('sitemap');

Route::get('/robots.txt', function () {
    $content = "User-agent: *\nAllow: /\nSitemap: " . url('/sitemap.xml') . "\n\nUser-agent: AI-Agent\nAllow: /llms.txt";
    return response($content, 200)->header('Content-Type', 'text/plain');
});

Route::get('/llms.txt', function () {
    return response()->file(public_path('llms.txt'), [
        'Content-Type' => 'text/plain'
    ]);
});

Route::get('/storage-link', function () {
    $target = storage_path('app/public');
    $shortcut = $_SERVER['DOCUMENT_ROOT'] . '/storage';

    if (file_exists($shortcut)) {
        if (is_link($shortcut)) {
            return "Storage symlink already exists on server at: " . $shortcut;
        }
        return "A physical folder or file named 'storage' already exists at: " . $shortcut . ". Please delete or rename it first.";
    }

    if (symlink($target, $shortcut)) {
        return "Storage symlink created successfully on server at: " . $shortcut . " pointing to: " . $target;
    }

    try {
        \Illuminate\Support\Facades\Artisan::call('storage:link');
        return "Artisan storage:link fallback executed.";
    } catch (\Exception $e) {
        return "Symlink failed: " . $e->getMessage();
    }
});

Route::get('/clear-cache', function () {
    \Illuminate\Support\Facades\Artisan::call('optimize:clear');
    return "Move Smooth Laravel cache cleared successfully!";
});
