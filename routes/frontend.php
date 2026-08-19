<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\SiteController;
use App\Http\Controllers\Frontend\AuthController;

// Main Pages
Route::get('/', [SiteController::class, 'home'])->name('front.home');
Route::get('/about', [SiteController::class, 'about'])->name('front.about');
Route::get('/contact', [SiteController::class, 'contact'])->name('front.contact');
Route::post('/contact', [SiteController::class, 'contactStore'])->name('front.contact.store');
Route::get('/moving-cost-calculator', [SiteController::class, 'movingCostCalculator'])->name('front.calculator');
Route::post('/get-quote', [SiteController::class, 'quoteSubmit'])->name('front.quote.submit');
Route::get('/get-quote', function() {
    return redirect()->route('front.calculator', [], 301);
});
Route::get('/thank-you', [SiteController::class, 'thankYou'])->name('front.thankyou');
Route::get('/api/zip-search', [SiteController::class, 'zipSuggestions'])->name('front.api.zip-search');
Route::get('/api/states/{state_id}/cities', [SiteController::class, 'getCitiesByState'])->name('front.api.cities');
Route::post('/api/chatbot/chat', [SiteController::class, 'chatbotChat'])->name('front.api.chatbot.chat');
Route::post('/api/chatbot/lead', [SiteController::class, 'chatbotLeadStore'])->name('front.api.chatbot.lead');
Route::get('/compare-movers', [SiteController::class, 'compareMovers'])->name('front.compare-movers');

// Legacy URL fixes (broken links audit — same URL structure, old paths only)
Route::redirect('/blog/how-much-does-it-cost-to-move-2026', '/moving-costs/how-much-does-it-cost-to-move', 301);
Route::redirect('/blog/how-to-get-accurate-moving-quotes-2026', '/moving-tips/how-to-get-accurate-moving-quotes-and-avoid-being-overcharged', 301);
Route::redirect('/how-to-avoid-moving-scams', '/moving-tips/how-to-get-accurate-moving-quotes-and-avoid-being-overcharged', 301);
Route::redirect('/how-to-choose-a-mover', '/blogs?category=moving-tips', 301);
Route::redirect('/movers/georgia/athens', '/movers/ga/athens', 301);
Route::redirect('/movers/georgia/columbus', '/movers/ga/columbus', 301);
Route::redirect('/movers/georgia/macon', '/movers/ga/macon', 301);
Route::redirect('/movers/washington/bellevue', '/movers/wa/bellevue', 301);
Route::redirect('/movers/washington/redmond', '/movers/wa/redmond', 301);
Route::redirect('/movers/ny/new-york', '/movers/ny/new-york-city', 301);
Route::redirect('/movers/ny/movers-in-new-york-city', '/movers/ny/new-york-city', 301);
Route::redirect('/movers/dc', '/movers/district-of-columbia', 301);
Route::redirect('/movers/washington-dc', '/movers/district-of-columbia', 301);
Route::redirect('/movers/movers/{path}', '/movers/{path}', 301)->where('path', '.*');

// Listing Pages
Route::get('/movers', [SiteController::class, 'moversDirectory'])->name('front.movers.directory');
Route::get('/movers/search', [SiteController::class, 'movers'])->name('front.movers');
Route::get('/movers/{state}', [SiteController::class, 'stateMovers'])->name('front.state.movers');
Route::get('/movers/{state}/{city}', [SiteController::class, 'cityMovers'])->name('front.city.movers');
Route::get('/mover/{slug}', [SiteController::class, 'companyProfile'])->name('front.company.profile');
Route::get('/contact-mover/{slug}', [SiteController::class, 'contactMover'])->name('front.contact-mover');
Route::post('/contact-mover/{slug}', [SiteController::class, 'contactMoverSubmit'])->name('front.contact-mover.submit');
Route::get('/contact-mover/{slug}/thank-you', [SiteController::class, 'contactMoverThankYou'])->name('front.contact-mover.thankyou');
Route::get('/company/write-review', [SiteController::class, 'reviewCreate'])->name('front.review.create');
Route::get('/mover/{company}/review', [SiteController::class, 'reviewForm'])->name('front.review.form');
Route::post('/mover/{company}/review/store', [SiteController::class, 'reviewStore'])->name('front.review.store');

// Service Pages
Route::get('/best-movers/local-moving-companies', [SiteController::class, 'serviceLocal'])->name('front.service.local');
Route::get('/best-movers/long-distance-moving-companies', [SiteController::class, 'serviceLongDistance'])->name('front.service.long');
Route::get('/best-movers/commercial-moving-companies', [SiteController::class, 'serviceCommercial'])->name('front.service.commercial');
Route::get('/best-movers/packing-services-moving-companies', [SiteController::class, 'servicePacking'])->name('front.service.packing');
Route::get('/best-movers/storage-units-moving-companies', [SiteController::class, 'serviceStorage'])->name('front.service.storage');
Route::get('/best-movers/residential-moving-companies', [SiteController::class, 'serviceResidential'])->name('front.service.residential');

// Blog
Route::get('/blogs', [SiteController::class, 'blog'])->name('front.blog');
Route::redirect('/blog', '/blogs', 301);
Route::get('/blog/{slug}', function($slug) {
    $blog = \App\Models\Blog::with('category')->where('slug', $slug)->firstOrFail();
    return redirect()->route('front.blog.detail', [
        'category_slug' => $blog->category->slug ?? 'uncategorized',
        'slug' => $blog->slug
    ], 301);
});

// Auth
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
Route::get('/register/company', [AuthController::class, 'showCompanyRegister'])->name('register.company');
Route::post('/register/company', [AuthController::class, 'companyRegister'])->name('register.company.submit');
Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])->name('forgot.password');
Route::post('/forgot-password', [AuthController::class, 'forgotPassword'])->name('forgot.password.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Legal Pages
Route::get('/privacy-policy', [SiteController::class, 'privacy'])->name('front.privacy');
Route::get('/terms-of-service', [SiteController::class, 'terms'])->name('front.terms');
Route::get('/cookie-policy', [SiteController::class, 'cookies'])->name('front.cookies');
Route::redirect('/cookies', '/cookie-policy', 301);
Route::get('/disclaimer', [SiteController::class, 'disclaimer'])->name('front.disclaimer');

// Blog Detail (Root level category/slug) - MUST be defined last to prevent conflicts with other two-segment routes
Route::get('/{category_slug}/{slug}', [SiteController::class, 'blogDetail'])
    ->name('front.blog.detail')
    ->where('category_slug', '(?!(admin|dashboard|movers|mover|contact-mover|api|company|blog|blogs|login|register|logout|best-movers)(/|$))[a-zA-Z0-9_-]+');
