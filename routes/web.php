<?php

use Illuminate\Support\Facades\Route;

require __DIR__.'/frontend.php';
require __DIR__.'/admin.php';
require __DIR__.'/company.php';

// SEO Routes
$forceCanonicalUrl = function () {
    if (!str_contains(request()->getHost(), 'localhost') && !str_contains(request()->getHost(), '127.0.0.1')) {
        \Illuminate\Support\Facades\URL::forceScheme('https');
        \Illuminate\Support\Facades\URL::forceRootUrl('https://movesmoth.com');
    }
};

$xmlResponse = function (array $urls) {
    return response()
        ->view('sitemaps.urlset', compact('urls'))
        ->header('Content-Type', 'application/xml');
};

Route::get('/sitemap.xml', function () use ($forceCanonicalUrl) {
    $forceCanonicalUrl();

    $sitemapUrls = [
        url('/sitemap-main.xml'),
        url('/movers.sitemap.xml'),
        url('/states.sitemap.xml'),
        url('/cities.sitemap.xml'),
        url('/routes.sitemap.index.xml'),
        url('/blogs.sitemap.xml'),
        url('/resources.sitemap.xml'),
        url('/popular-route-state.sitemap.xml'),
        url('/popular-route-city.sitemap.xml'),
        url('/state-to-state-routes.sitemap.xml'),
        url('/state-move-costs.sitemap.xml'),
    ];

    return response()
        ->view('sitemap_index', compact('sitemapUrls'))
        ->header('Content-Type', 'application/xml');
})->name('sitemap');

Route::get('/sitemap-main.xml', function () use ($forceCanonicalUrl, $xmlResponse) {
    $forceCanonicalUrl();

    $urls = [
        ['loc' => route('front.home'), 'changefreq' => 'daily', 'priority' => '1.0'],
        ['loc' => route('front.about'), 'changefreq' => 'monthly', 'priority' => '0.8'],
        ['loc' => route('front.contact'), 'changefreq' => 'monthly', 'priority' => '0.7'],
        ['loc' => route('front.movers'), 'changefreq' => 'daily', 'priority' => '0.9'],
        ['loc' => route('front.movers.directory'), 'changefreq' => 'daily', 'priority' => '0.9'],
        ['loc' => route('front.calculator'), 'changefreq' => 'monthly', 'priority' => '0.8'],
        ['loc' => route('front.blog'), 'changefreq' => 'daily', 'priority' => '0.8'],
        ['loc' => route('front.compare-movers'), 'changefreq' => 'weekly', 'priority' => '0.8'],
        ['loc' => route('front.privacy'), 'changefreq' => 'yearly', 'priority' => '0.4'],
        ['loc' => route('front.terms'), 'changefreq' => 'yearly', 'priority' => '0.4'],
        ['loc' => route('front.cookies'), 'changefreq' => 'yearly', 'priority' => '0.3'],
        ['loc' => route('front.disclaimer'), 'changefreq' => 'yearly', 'priority' => '0.3'],
    ];

    return $xmlResponse($urls);
});

Route::get('/movers.sitemap.xml', function () use ($forceCanonicalUrl, $xmlResponse) {
    $forceCanonicalUrl();
    $urls = \App\Models\Company::select('slug', 'updated_at')
        ->where('is_active', true)
        ->get()
        ->map(fn ($company) => [
            'loc' => route('front.company.profile', $company->slug),
            'lastmod' => optional($company->updated_at)->toAtomString() ?? now()->toAtomString(),
            'changefreq' => 'weekly',
            'priority' => '0.9',
        ])->values()->all();

    return $xmlResponse($urls);
});

Route::get('/states.sitemap.xml', function () use ($forceCanonicalUrl, $xmlResponse) {
    $forceCanonicalUrl();
    $urls = \App\Models\State::active()->get()->map(fn ($state) => [
        'loc' => route('front.state.movers', $state->slug),
        'lastmod' => optional($state->updated_at)->toAtomString() ?? now()->toAtomString(),
        'changefreq' => 'weekly',
        'priority' => '0.8',
    ])->values()->all();

    return $xmlResponse($urls);
});

Route::get('/cities.sitemap.xml', function () use ($forceCanonicalUrl, $xmlResponse) {
    $forceCanonicalUrl();
    $urls = \App\Models\City::active()
        ->with(['state', 'content'])
        ->get()
        ->filter(fn ($city) => $city->state && $city->content)
        ->map(fn ($city) => [
            'loc' => route('front.city.movers', [strtolower($city->state->code), $city->content->slug]),
            'lastmod' => optional($city->updated_at)->toAtomString() ?? now()->toAtomString(),
            'changefreq' => 'weekly',
            'priority' => '0.8',
        ])->values()->all();

    return $xmlResponse($urls);
});

Route::get('/blogs.sitemap.xml', function () use ($forceCanonicalUrl, $xmlResponse) {
    $forceCanonicalUrl();
    $urls = \App\Models\Blog::select('slug', 'category_id', 'updated_at')
        ->with('category')
        ->where('status', 'published')
        ->get()
        ->map(fn ($blog) => [
            'loc' => route('front.blog.detail', [$blog->category?->slug ?? 'uncategorized', $blog->slug]),
            'lastmod' => optional($blog->updated_at)->toAtomString() ?? now()->toAtomString(),
            'changefreq' => 'weekly',
            'priority' => '0.8',
        ])->values()->all();

    return $xmlResponse($urls);
});

Route::get('/resources.sitemap.xml', function () use ($forceCanonicalUrl, $xmlResponse) {
    $forceCanonicalUrl();
    $urls = [
        ['loc' => route('front.service.local'), 'changefreq' => 'monthly', 'priority' => '0.8'],
        ['loc' => route('front.service.long'), 'changefreq' => 'monthly', 'priority' => '0.8'],
        ['loc' => route('front.service.commercial'), 'changefreq' => 'monthly', 'priority' => '0.8'],
        ['loc' => route('front.service.packing'), 'changefreq' => 'monthly', 'priority' => '0.8'],
        ['loc' => route('front.service.storage'), 'changefreq' => 'monthly', 'priority' => '0.8'],
        ['loc' => route('front.service.residential'), 'changefreq' => 'monthly', 'priority' => '0.8'],
        ['loc' => route('front.calculator'), 'changefreq' => 'monthly', 'priority' => '0.8'],
        ['loc' => route('front.compare-movers'), 'changefreq' => 'weekly', 'priority' => '0.8'],
    ];

    return $xmlResponse($urls);
});

Route::get('/routes.sitemap.index.xml', function () use ($forceCanonicalUrl) {
    $forceCanonicalUrl();
    $sitemapUrls = [
        url('/popular-route-state.sitemap.xml'),
        url('/popular-route-city.sitemap.xml'),
        url('/state-to-state-routes.sitemap.xml'),
    ];

    return response()
        ->view('sitemap_index', compact('sitemapUrls'))
        ->header('Content-Type', 'application/xml');
});

Route::get('/popular-route-state.sitemap.xml', function () use ($forceCanonicalUrl, $xmlResponse) {
    $forceCanonicalUrl();
    $urls = [];
    if (\Illuminate\Support\Facades\Schema::hasTable('state_routes')) {
        $urls = \App\Models\StateRoute::query()
            ->select('slug', 'updated_at', 'from_state_id', 'to_state_id')
            ->get()
            ->map(fn ($route) => [
                'loc' => url('/routes/' . ltrim((string) $route->slug, '/')),
                'lastmod' => optional($route->updated_at)->toAtomString() ?? now()->toAtomString(),
                'changefreq' => 'monthly',
                'priority' => '0.7',
            ])->values()->all();
    }

    return $xmlResponse($urls);
});

Route::get('/popular-route-city.sitemap.xml', function () use ($forceCanonicalUrl, $xmlResponse) {
    $forceCanonicalUrl();
    $urls = [];
    if (\Illuminate\Support\Facades\Schema::hasTable('city_routes')) {
        $urls = \App\Models\CityRoute::query()
            ->select('slug', 'updated_at')
            ->get()
            ->map(fn ($route) => [
                'loc' => url('/routes/' . ltrim((string) $route->slug, '/')),
                'lastmod' => optional($route->updated_at)->toAtomString() ?? now()->toAtomString(),
                'changefreq' => 'monthly',
                'priority' => '0.7',
            ])->values()->all();
    }

    return $xmlResponse($urls);
});

Route::get('/state-to-state-routes.sitemap.xml', function () use ($forceCanonicalUrl, $xmlResponse) {
    $forceCanonicalUrl();
    $urls = [];
    if (\Illuminate\Support\Facades\Schema::hasTable('state_routes')) {
        $urls = \App\Models\StateRoute::query()
            ->select('slug', 'updated_at')
            ->get()
            ->map(fn ($route) => [
                'loc' => url('/state-to-state/' . ltrim((string) $route->slug, '/')),
                'lastmod' => optional($route->updated_at)->toAtomString() ?? now()->toAtomString(),
                'changefreq' => 'monthly',
                'priority' => '0.7',
            ])->values()->all();
    }

    return $xmlResponse($urls);
});

Route::get('/state-move-costs.sitemap.xml', function () use ($forceCanonicalUrl, $xmlResponse) {
    $forceCanonicalUrl();
    $urls = [];
    if (\Illuminate\Support\Facades\Schema::hasTable('best_moving_pages')) {
        $urls = \App\Models\BestMovingPage::query()
            ->when(
                \Illuminate\Support\Facades\Schema::hasColumn('best_moving_pages', 'is_active'),
                fn ($q) => $q->where('is_active', true)
            )
            ->get()
            ->map(fn ($page) => [
                'loc' => url('/' . ltrim((string) $page->slug, '/')),
                'lastmod' => optional($page->updated_at)->toAtomString() ?? now()->toAtomString(),
                'changefreq' => 'monthly',
                'priority' => '0.7',
            ])->values()->all();
    }

    return $xmlResponse($urls);
});

Route::get('/robots.txt', function () use ($forceCanonicalUrl) {
    $forceCanonicalUrl();

    $content = "User-agent: *\n"
        . "\n"
        . "Disallow: /*?*\n"
        . "Disallow: /*?sort=low_to_high\n"
        . "Disallow: /*?sort=high_to_low\n"
        . "Disallow: /*?sort=newest\n"
        . "Disallow: /*?sort=oldest\n"
        . "Disallow: /*?page=*\n"
        . "Disallow: /*?from=*\n"
        . "Disallow: /cdn-cgi/\n"
        . "Disallow: /mover/*/review\n"
        . "Disallow: /contact-mover/*\n"
        . "Disallow: /claim-company/*\n"
        . "Disallow: /admin\n"
        . "Disallow: /company/login\n"
        . "Disallow: /user/login\n"
        . "Disallow: /user/register\n"
        . "Disallow: /add-listing\n"
        . "Disallow: /mover/verification\n"
        . "\n"
        . "Sitemap: " . url('/sitemap.xml') . "\n"
        . "Sitemap: " . url('/sitemap-main.xml') . "\n"
        . "Sitemap: " . url('/movers.sitemap.xml') . "\n"
        . "Sitemap: " . url('/states.sitemap.xml') . "\n"
        . "Sitemap: " . url('/cities.sitemap.xml') . "\n"
        . "Sitemap: " . url('/blogs.sitemap.xml') . "\n"
        . "Sitemap: " . url('/resources.sitemap.xml') . "\n"
        . "Sitemap: " . url('/popular-route-state.sitemap.xml') . "\n"
        . "Sitemap: " . url('/popular-route-city.sitemap.xml') . "\n"
        . "Sitemap: " . url('/routes.sitemap.index.xml') . "\n"
        . "Sitemap: " . url('/state-to-state-routes.sitemap.xml') . "\n"
        . "Sitemap: " . url('/state-move-costs.sitemap.xml') . "\n"
        . "\n"
        . "# AI Crawlers\n"
        . "User-agent: GPTBot\n"
        . "Allow: /\n"
        . "\n"
        . "User-agent: ClaudeBot\n"
        . "Allow: /\n"
        . "\n"
        . "User-agent: PerplexityBot\n"
        . "Allow: /\n"
        . "\n"
        . "User-agent: AI-Agent\n"
        . "Allow: /llms.txt\n";

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
