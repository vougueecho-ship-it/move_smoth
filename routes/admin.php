<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;

Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminController::class, 'showLogin'])->name('admin.login');
    Route::post('/login', [AdminController::class, 'login'])->name('admin.login.submit');

    Route::middleware('admin')->group(function () {
        Route::post('/logout', [AdminController::class, 'logout'])->name('admin.logout');
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

        // Companies
        Route::get('/companies', [AdminController::class, 'companies'])->name('admin.companies');
        Route::get('/companies/import', [AdminController::class, 'companyImportForm'])->name('admin.companies.import');
        Route::post('/companies/import', [AdminController::class, 'companyImportStore'])->name('admin.companies.import.store');
        Route::get('/companies/create', [AdminController::class, 'companyCreate'])->name('admin.companies.create');
        Route::post('/companies', [AdminController::class, 'companyStore'])->name('admin.companies.store');
        Route::get('/companies/{id}/edit', [AdminController::class, 'companyEdit'])->name('admin.companies.edit');
        Route::put('/companies/{id}', [AdminController::class, 'companyUpdate'])->name('admin.companies.update');
        Route::delete('/companies/{id}', [AdminController::class, 'companyDestroy'])->name('admin.companies.delete');

        // Pending
        Route::get('/pending', [AdminController::class, 'pending'])->name('admin.pending');
        Route::post('/pending/{id}/approve', [AdminController::class, 'approve'])->name('admin.approve');
        Route::post('/pending/{id}/reject', [AdminController::class, 'reject'])->name('admin.reject');

        // Reviews
        Route::get('/reviews', [AdminController::class, 'reviews'])->name('admin.reviews');
        Route::get('/reviews/create', [AdminController::class, 'reviewCreate'])->name('admin.reviews.create');
        Route::post('/reviews', [AdminController::class, 'reviewStore'])->name('admin.reviews.store');
        Route::get('/reviews/{id}/edit', [AdminController::class, 'reviewEdit'])->name('admin.reviews.edit');
        Route::put('/reviews/{id}', [AdminController::class, 'reviewUpdate'])->name('admin.reviews.update');
        Route::post('/reviews/{id}/approve', [AdminController::class, 'reviewApprove'])->name('admin.reviews.approve');
        Route::post('/reviews/{id}/reject', [AdminController::class, 'reviewReject'])->name('admin.reviews.reject');
        Route::delete('/reviews/{id}', [AdminController::class, 'reviewDestroy'])->name('admin.reviews.delete');

        // Blogs
        Route::get('/blog', [AdminController::class, 'blogs'])->name('admin.blogs');
        Route::get('/blog/create', [AdminController::class, 'blogCreate'])->name('admin.blogs.create');
        Route::post('/blog', [AdminController::class, 'blogStore'])->name('admin.blogs.store');
        Route::get('/blog/{id}/edit', [AdminController::class, 'blogEdit'])->name('admin.blogs.edit');
        Route::put('/blog/{id}', [AdminController::class, 'blogUpdate'])->name('admin.blogs.update');
        Route::delete('/blog/{id}', [AdminController::class, 'blogDestroy'])->name('admin.blogs.delete');

        // Blog Categories
        Route::get('/blog-categories', [AdminController::class, 'blogCategories'])->name('admin.blog-categories');
        Route::post('/blog-categories', [AdminController::class, 'blogCategoryStore'])->name('admin.blog-categories.store');
        Route::get('/blog-categories/{id}/edit', [AdminController::class, 'blogCategoryEdit'])->name('admin.blog-categories.edit');
        Route::put('/blog-categories/{id}', [AdminController::class, 'blogCategoryUpdate'])->name('admin.blog-categories.update');
        Route::delete('/blog-categories/{id}', [AdminController::class, 'blogCategoryDestroy'])->name('admin.blog-categories.delete');

        // Revenue
        Route::get('/revenue', [AdminController::class, 'revenue'])->name('admin.revenue');
        Route::post('/revenue/{id}/dispatch', [AdminController::class, 'dispatchLead'])->name('admin.revenue.dispatch');

        // States & Cities
        Route::get('/states', [AdminController::class, 'states'])->name('admin.states');
        Route::get('/states/create-page', [AdminController::class, 'statePageCreate'])->name('admin.states.create-page');
        Route::post('/states/create-page', [AdminController::class, 'statePageStore'])->name('admin.states.create-page.store');
        Route::get('/states/{id}/edit', [AdminController::class, 'stateEdit'])->name('admin.states.edit');
        Route::put('/states/{id}', [AdminController::class, 'stateUpdate'])->name('admin.states.update');

        // Top Movers CRUD
        Route::get('/top-movers', [AdminController::class, 'topMovers'])->name('admin.top-movers');
        Route::get('/top-movers/create', [AdminController::class, 'topMoversCreate'])->name('admin.top-movers.create');
        Route::post('/top-movers', [AdminController::class, 'topMoversStore'])->name('admin.top-movers.store');
        Route::get('/top-movers/{id}/edit', [AdminController::class, 'topMoversEdit'])->name('admin.top-movers.edit');
        Route::put('/top-movers/{id}', [AdminController::class, 'topMoversUpdate'])->name('admin.top-movers.update');
        Route::delete('/top-movers/{id}', [AdminController::class, 'topMoversDestroy'])->name('admin.top-movers.delete');

        // Bottom Movers CRUD
        Route::get('/bottom-movers', [AdminController::class, 'bottomMovers'])->name('admin.bottom-movers');
        Route::get('/bottom-movers/create', [AdminController::class, 'bottomMoversCreate'])->name('admin.bottom-movers.create');
        Route::post('/bottom-movers', [AdminController::class, 'bottomMoversStore'])->name('admin.bottom-movers.store');
        Route::get('/bottom-movers/{id}/edit', [AdminController::class, 'bottomMoversEdit'])->name('admin.bottom-movers.edit');
        Route::put('/bottom-movers/{id}', [AdminController::class, 'bottomMoversUpdate'])->name('admin.bottom-movers.update');
        Route::delete('/bottom-movers/{id}', [AdminController::class, 'bottomMoversDestroy'])->name('admin.bottom-movers.delete');

        Route::get('/cities', [AdminController::class, 'cities'])->name('admin.cities');
        Route::get('/cities/create-page', [AdminController::class, 'cityPageCreate'])->name('admin.cities.create-page');
        Route::post('/cities/create-page', [AdminController::class, 'cityPageStore'])->name('admin.cities.create-page.store');
        Route::get('/cities/{id}/edit', [AdminController::class, 'cityEdit'])->name('admin.cities.edit');
        Route::put('/cities/{id}', [AdminController::class, 'cityUpdate'])->name('admin.cities.update');
        Route::get('/get-cities/{state_id}', [AdminController::class, 'getCities'])->name('admin.get-cities');

        // Settings & Content
        Route::get('/settings', [AdminController::class, 'settings'])->name('admin.settings');
        Route::post('/settings', [AdminController::class, 'settingsUpdate'])->name('admin.settings.update');

        // Contact Mover Leads
        Route::get('/contact-mover-leads', [AdminController::class, 'contactMoverLeads'])->name('admin.contact-mover-leads');
        Route::get('/contact-mover-leads/{id}', [AdminController::class, 'contactMoverLeadShow'])->name('admin.contact-mover-leads.show');
        Route::delete('/contact-mover-leads/{id}', [AdminController::class, 'contactMoverLeadDestroy'])->name('admin.contact-mover-leads.delete');
    });
});
