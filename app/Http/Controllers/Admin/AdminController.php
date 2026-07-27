<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Company;
use App\Models\Review;
use App\Models\Blog;
use App\Models\QuoteRequest;
use App\Models\ContactMessage;
use App\Models\User;
use App\Models\State;
use App\Models\City;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function showLogin() { return view('auth.admin_login'); }

    public function login(Request $request)
    {
        $credentials = $request->validate(['email' => 'required|email', 'password' => 'required']);
        if (Auth::attempt($credentials) && Auth::user()->is_admin) {
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard');
        }
        Auth::logout();
        return back()->withErrors(['email' => 'Invalid admin credentials.'])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login');
    }

    public function dashboard()
    {
        return view('admin.dashboard', [
            'companiesCount' => Company::count(),
            'activeCompanies' => Company::where('is_active', true)->count(),
            'pendingCompanies' => Company::where('status', 'pending')->count(),
            'reviewsCount' => Review::count(),
            'reviewsThisMonth' => Review::whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->count(),
            'blogsCount' => Blog::count(),
            'quotesCount' => QuoteRequest::count(),
            'usersCount' => User::count(),
            'recentQuotes' => QuoteRequest::latest()->limit(10)->get(),
            'recentCompanies' => Company::latest()->limit(5)->get(),
        ]);
    }

    // Companies Management
    public function companies(Request $request)
    {
        $companies = Company::with('state')
            ->when($request->status, fn($q,$s) => $q->where('status', $s))
            ->latest()->paginate(20);
        return view('admin.companies.index', compact('companies'));
    }

    public function companyImportForm()
    {
        return view('admin.companies.import');
    }

    public function companyImportStore(Request $request)
    {
        // Avoid strict MIME-type validation to bypass server-specific misdetections which cause 500 errors
        $request->validate([
            'csv_file' => 'required|file|max:10240' // Max 10MB
        ]);

        $file = $request->file('csv_file');
        $extension = strtolower($file->getClientOriginalExtension());
        if (!in_array($extension, ['csv', 'txt'])) {
            return back()->with('error', 'Only CSV files are supported.');
        }

        $filePath = $file->getRealPath();

        // Parse CSV
        $handle = fopen($filePath, 'r');
        if (!$handle) {
            return back()->with('error', 'Unable to open the CSV file.');
        }

        // Get headers
        $headerRow = fgetcsv($handle, 1000, ',');
        if (!$headerRow) {
            fclose($handle);
            return back()->with('error', 'CSV file is empty.');
        }

        // Normalize headers
        $headers = array_map(function($h) {
            return strtolower(trim(str_replace([' ', '_', '.', '#'], '', $h)));
        }, $headerRow);

        // Find column indices
        $idxName = array_search('companyname', $headers);
        if ($idxName === false) $idxName = array_search('name', $headers);
        
        $idxEmail = array_search('companyemail', $headers);
        if ($idxEmail === false) $idxEmail = array_search('email', $headers);
        
        $idxPhone = array_search('phoneno', $headers);
        if ($idxPhone === false) $idxPhone = array_search('phone', $headers);
        if ($idxPhone === false) $idxPhone = array_search('companyphone', $headers);
        
        $idxAddress = array_search('companyaddress', $headers);
        if ($idxAddress === false) $idxAddress = array_search('address', $headers);
        
        $idxDot = array_search('dotno', $headers);
        if ($idxDot === false) $idxDot = array_search('usdot', $headers);
        if ($idxDot === false) $idxDot = array_search('usdotnumber', $headers);
        
        $idxState = array_search('companystate', $headers);
        if ($idxState === false) $idxState = array_search('state', $headers);
        
        $idxDate = array_search('createdate', $headers);

        if ($idxName === false) {
            fclose($handle);
            return back()->with('error', 'Unable to find the "Company Name" or "Name" column in your CSV.');
        }

        // 1. Read all rows to collect ZIPs, States, Emails and DOTs for bulk pre-fetching
        $rows = [];
        $zips = [];
        $stateNames = [];
        $emails = [];
        $dotNumbers = [];

        while (($row = fgetcsv($handle, 2000, ',')) !== false) {
            if (empty($row) || !isset($row[$idxName]) || empty(trim($row[$idxName]))) {
                continue;
            }
            $rows[] = $row;
            
            // Extract ZIP
            $address = $idxAddress !== false && isset($row[$idxAddress]) ? trim($row[$idxAddress]) : null;
            if ($address && preg_match('/\b\d{5}\b/', $address, $matches)) {
                $zips[] = $matches[0];
            }

            // Extract State
            $stateName = $idxState !== false && isset($row[$idxState]) ? trim($row[$idxState]) : null;
            if ($stateName) {
                $stateNames[] = strtolower($stateName);
            }

            // Extract Emails & DOTs for pre-fetching duplicates
            $email = $idxEmail !== false && isset($row[$idxEmail]) ? trim($row[$idxEmail]) : null;
            if ($email) $emails[] = $email;

            $dotNumber = $idxDot !== false && isset($row[$idxDot]) ? trim($row[$idxDot]) : null;
            if ($dotNumber) $dotNumbers[] = $dotNumber;
        }
        fclose($handle);

        // 2. Pre-fetch matching Cities and States in bulk (Exactly 1 query for cities, 1 for states!)
        $uniqueZips = array_unique($zips);
        $cities = empty($uniqueZips) ? collect() : City::whereIn('zip_code', $uniqueZips)->with('state')->get()->keyBy('zip_code');

        $statesByName = State::all()->keyBy(function($s) { return strtolower($s->name); });
        $statesByCode = State::all()->keyBy(function($s) { return strtolower($s->code); });

        // Pre-fetch existing companies to verify duplicates in memory
        $existingByDot = empty($dotNumbers) ? collect() : Company::whereIn('dot_number', $dotNumbers)->get()->keyBy('dot_number');
        $existingByEmail = empty($emails) ? collect() : Company::whereIn('email', $emails)->get()->keyBy('email');

        $imported = 0;
        $updated = 0;
        $failed = 0;

        // 3. Process each row in memory (Super Fast!)
        foreach ($rows as $row) {
            $name = trim($row[$idxName]);
            $email = $idxEmail !== false && isset($row[$idxEmail]) ? trim($row[$idxEmail]) : null;
            $phone = $idxPhone !== false && isset($row[$idxPhone]) ? trim($row[$idxPhone]) : null;
            $address = $idxAddress !== false && isset($row[$idxAddress]) ? trim($row[$idxAddress]) : null;
            $dotNumber = $idxDot !== false && isset($row[$idxDot]) ? trim($row[$idxDot]) : null;
            $stateName = $idxState !== false && isset($row[$idxState]) ? trim($row[$idxState]) : null;
            
            // Clean date
            $createdAt = now();
            if ($idxDate !== false && isset($row[$idxDate]) && !empty($row[$idxDate])) {
                try {
                    $createdAt = Carbon::parse(trim($row[$idxDate]));
                } catch (\Exception $e) {
                    // Ignore date parsing error
                }
            }

            // Location Resolution from pre-fetched Memory
            $city = null;
            $stateId = null;
            $defaultCountryId = \App\Models\Country::where('iso2', 'US')->first()->id ?? (\App\Models\Country::first()->id ?? null);
            $countryId = $defaultCountryId;
            $zip = null;

            if ($address && preg_match('/\b\d{5}\b/', $address, $matches)) {
                $zip = $matches[0];
                $cityRecord = $cities->get($zip);
                if ($cityRecord) {
                    $city = $cityRecord->name;
                    $stateId = $cityRecord->state_id;
                    $countryId = $cityRecord->state->country_id ?? $defaultCountryId;
                }
            }

            // Fallback State lookup from Memory
            if (!$stateId && $stateName) {
                $lowerState = strtolower($stateName);
                $stateRecord = $statesByName->get($lowerState) ?? $statesByCode->get($lowerState);
                if ($stateRecord) {
                    $stateId = $stateRecord->id;
                    $countryId = $stateRecord->country_id ?? $defaultCountryId;
                }
            }

            // Fallback City parsing
            if (!$city && $address) {
                $parts = array_map('trim', explode(',', $address));
                if (count($parts) >= 2) {
                    $cityPart = $parts[count($parts) - 2] ?? '';
                    $cityClean = preg_replace('/\b[A-Z]{2}\b/', '', $cityPart);
                    $cityClean = preg_replace('/\b\d{5}\b/', '', $cityClean);
                    $cityClean = trim($cityClean);
                    if (!empty($cityClean) && strlen($cityClean) > 2) {
                        $city = $cityClean;
                    }
                }
            }

            if (!$stateId) {
                $failed++;
                continue;
            }

            $companyData = [
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
                'address_line1' => $address,
                'city' => $city ?? 'Unknown',
                'state_id' => $stateId,
                'country_id' => $countryId,
                'zip' => $zip,
                'dot_number' => $dotNumber,
                'status' => 'active',
                'is_active' => true,
                'is_claimed' => false,
                'updated_at' => now(),
            ];

            // Avoid duplicates: check pre-fetched collections in memory
            $existingCompany = null;
            if ($dotNumber) {
                $existingCompany = $existingByDot->get($dotNumber);
            }
            if (!$existingCompany && $email) {
                $existingCompany = $existingByEmail->get($email);
            }

            if ($existingCompany) {
                $existingCompany->update($companyData);
                $updated++;
            } else {
                // Generate unique slug
                $slug = \Illuminate\Support\Str::slug($name);
                $slugExists = Company::where('slug', $slug)->exists();
                if ($slugExists) {
                    $slug = $slug . '-' . rand(100, 999);
                }
                
                $companyData['slug'] = $slug;
                $companyData['created_at'] = $createdAt;
                Company::create($companyData);
                $imported++;
            }
        }

        $msg = "Bulk import completed successfully! Imported {$imported} new companies, updated {$updated} existing, and {$failed} rows could not be matched with a valid State.";
        return redirect()->route('admin.companies')->with('success', $msg);
    }
    public function companyCreate()
    {
        $states = State::orderBy('name')->get();
        return view('admin.companies.create', compact('states'));
    }

    public function companyStore(Request $request)
    {
        $request->validate([
            // Owner / User fields
            'owner_name' => 'required|string|max:255',
            'owner_email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            
            // Company fields
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:companies,email',
            'phone' => 'required|string|max:50',
            'website' => 'nullable|string|max:255',
            'state_id' => 'required|exists:states,id',
            'city' => 'required|string|max:120',
            'address_line1' => 'required|string|max:255',
            'mc_number' => 'nullable|string|max:120',
            'dot_number' => 'nullable|string|max:120',
            'description' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:1000',
        ]);

        // 1. Create Associated User (owner)
        $user = \App\Models\User::create([
            'name' => $request->owner_name,
            'email' => $request->owner_email,
            'password' => bcrypt($request->password),
            'role' => 'company',
            'is_admin' => false,
        ]);

        // 2. Prepare Company data
        $data = $request->only([
            'name', 'email', 'phone', 'website', 'state_id', 'city', 'address_line1', 'mc_number', 'dot_number', 'description', 'meta_title', 'meta_description'
        ]);

        // Map service types
        $services = $request->input('services', []);
        $data['service_type'] = implode(',', $services);

        $slug = \Illuminate\Support\Str::slug($data['name']);
        if (Company::where('slug', $slug)->exists()) {
            $slug = $slug . '-' . rand(100, 999);
        }
        $data['slug'] = $slug;
        $data['status'] = $request->status ?? 'pending';
        $data['is_active'] = $request->has('is_active');
        $data['is_lead_active'] = $request->has('is_lead_active');
        $data['country_id'] = \App\Models\Country::where('iso2', 'US')->first()->id ?? (\App\Models\Country::first()->id ?? null);

        if ($request->hasFile('logo')) {
            $logoDir = public_path('storage/companies');
            if (!file_exists($logoDir)) {
                @mkdir($logoDir, 0755, true);
            }
            $data['logo'] = $request->file('logo')->store('companies', 'public');
        }

        Company::create($data);
        return redirect()->route('admin.companies')->with('success', 'Company added successfully.');
    }

    public function companyEdit($id)
    {
        $company = Company::with('owner')->findOrFail($id);
        $states = State::orderBy('name')->get();
        return view('admin.companies.edit', compact('company','states'));
    }

    public function companyUpdate(Request $request, $id)
    {
        $company = Company::findOrFail($id);
        
        $request->validate([
            // Owner / User fields
            'owner_name' => 'required|string|max:255',
            'owner_email' => 'required|email|unique:users,email,' . $company->user_id,
            'password' => 'nullable|string|min:6',
            
            // Company fields
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:companies,email,' . $id,
            'phone' => 'required|string|max:50',
            'website' => 'nullable|string|max:255',
            'state_id' => 'required|exists:states,id',
            'city' => 'required|string|max:120',
            'address_line1' => 'required|string|max:255',
            'mc_number' => 'nullable|string|max:120',
            'dot_number' => 'nullable|string|max:120',
            'description' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:1000',
        ]);

        // 1. Update Associated User
        if ($company->user_id) {
            $user = \App\Models\User::find($company->user_id);
            if ($user) {
                $userData = [
                    'name' => $request->owner_name,
                    'email' => $request->owner_email,
                ];
                if (!empty($request->password)) {
                    $userData['password'] = bcrypt($request->password);
                }
                $user->update($userData);
            }
        } else {
            // Create user if not linked previously
            $user = \App\Models\User::create([
                'name' => $request->owner_name,
                'email' => $request->owner_email,
                'password' => bcrypt($request->password ?: 'password123'),
                'role' => 'company',
                'is_admin' => false,
            ]);
            $company->user_id = $user->id;
        }

        // 2. Update Company data
        $data = $request->only([
            'name', 'email', 'phone', 'website', 'state_id', 'city', 'address_line1', 'mc_number', 'dot_number', 'description', 'meta_title', 'meta_description'
        ]);

        // Map service types
        $services = $request->input('services', []);
        $data['service_type'] = implode(',', $services);

        $data['is_active'] = $request->has('is_active');
        $data['is_lead_active'] = $request->has('is_lead_active');
        $data['status'] = $request->status ?? 'pending';
        $data['user_id'] = $company->user_id;

        if ($request->hasFile('logo')) {
            $logoDir = public_path('storage/companies');
            if (!file_exists($logoDir)) {
                @mkdir($logoDir, 0755, true);
            }
            $data['logo'] = $request->file('logo')->store('companies', 'public');
        }

        $company->update($data);
        return redirect()->route('admin.companies')->with('success', 'Company updated successfully.');
    }

    public function companyDestroy($id)
    {
        Company::findOrFail($id)->delete();
        return redirect()->route('admin.companies')->with('success', 'Company deleted.');
    }

    // Pending Approvals
    public function pending()
    {
        $companies = Company::where('status','pending')->with('state')->latest()->paginate(20);
        return view('admin.pending', compact('companies'));
    }

    public function approve($id)
    {
        $company = Company::findOrFail($id);
        $company->update(['status' => 'active', 'is_active' => true]);
        return back()->with('success', 'Company approved.');
    }

    public function reject($id)
    {
        $company = Company::findOrFail($id);
        $company->update(['status' => 'suspended', 'is_active' => false]);
        return back()->with('success', 'Company rejected.');
    }

    // Reviews
    public function reviews(Request $request)
    {
        $reviews = Review::with('company')
            ->when($request->status, fn($q,$s) => $q->where('status',$s))
            ->latest()->paginate(20);
        return view('admin.reviews.index', compact('reviews'));
    }

    public function reviewCreate()
    {
        $companies = Company::orderBy('name')->get();
        return view('admin.reviews.create', compact('companies'));
    }

    public function reviewStore(Request $request)
    {
        $data = $request->validate([
            'company_id' => 'required|exists:companies,id',
            'name' => 'required|string|max:255',
            'rating' => 'required|numeric|min:1|max:5',
            'title' => 'nullable|string|max:255',
            'review' => 'required|string',
            'is_featured' => 'nullable|boolean',
            'status' => 'required|in:approved,pending,rejected',
        ]);
        $data['is_featured'] = $request->has('is_featured');
        Review::create($data);
        return redirect()->route('admin.reviews')->with('success', 'Review added manually.');
    }

    public function reviewEdit($id)
    {
        $review = Review::findOrFail($id);
        $companies = Company::orderBy('name')->get();
        return view('admin.reviews.edit', compact('review', 'companies'));
    }

    public function reviewUpdate(Request $request, $id)
    {
        $review = Review::findOrFail($id);
        $data = $request->validate([
            'company_id' => 'required|exists:companies,id',
            'name' => 'required|string|max:255',
            'rating' => 'required|numeric|min:1|max:5',
            'title' => 'nullable|string|max:255',
            'review' => 'required|string',
            'is_featured' => 'nullable|boolean',
            'status' => 'required|in:approved,pending,rejected',
        ]);
        $data['is_featured'] = $request->has('is_featured');
        $review->update($data);
        return redirect()->route('admin.reviews')->with('success', 'Review updated successfully.');
    }

    public function reviewApprove($id)
    {
        Review::findOrFail($id)->update(['status' => 'approved']);
        return back()->with('success', 'Review approved.');
    }

    public function reviewReject($id)
    {
        Review::findOrFail($id)->update(['status' => 'rejected']);
        return back()->with('success', 'Review rejected.');
    }

    public function reviewDestroy($id)
    {
        Review::findOrFail($id)->delete();
        return back()->with('success', 'Review deleted.');
    }

    // Blog Management
    public function blogs()
    {
        $blogs = Blog::with('category')->latest()->paginate(20);
        return view('admin.blogs.index', compact('blogs'));
    }

    public function blogCreate()
    {
        $categories = \App\Models\BlogCategory::all();
        return view('admin.blogs.create', compact('categories'));
    }

    public function blogStore(Request $request)
    {
        if (empty($request->slug)) {
            $request->merge(['slug' => \Illuminate\Support\Str::slug($request->title)]);
        } else {
            $request->merge(['slug' => \Illuminate\Support\Str::slug($request->slug)]);
        }

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|unique:blogs',
            'content' => 'required',
            'category_id' => 'nullable|exists:blog_categories,id',
            'meta_title' => 'nullable|string',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            'status' => 'required|in:published,draft',
        ]);
        $data['user_id'] = Auth::id();
        $data['published_at'] = $data['status'] === 'published' ? now() : null;

        if ($request->hasFile('featured_image')) {
            $data['featured_image'] = $request->file('featured_image')->store('blogs', 'public');
        }

        $blog = Blog::create($data);

        if ($request->has('faqs')) {
            foreach ($request->faqs as $faqData) {
                if (!empty($faqData['question']) && !empty($faqData['answer'])) {
                    $blog->faqs()->create([
                        'question' => $faqData['question'],
                        'answer' => $faqData['answer'],
                        'order' => $faqData['order'] ?? 0,
                    ]);
                }
            }
        }

        return redirect()->route('admin.blogs')->with('success', 'Blog created.');
    }

    public function blogEdit($id)
    {
        $blog = Blog::findOrFail($id);
        $categories = \App\Models\BlogCategory::all();
        return view('admin.blogs.edit', compact('blog','categories'));
    }

    public function blogUpdate(Request $request, $id)
    {
        $blog = Blog::findOrFail($id);
        if (empty($request->slug)) {
            $request->merge(['slug' => \Illuminate\Support\Str::slug($request->title)]);
        } else {
            $request->merge(['slug' => \Illuminate\Support\Str::slug($request->slug)]);
        }

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|unique:blogs,slug,'.$id,
            'content' => 'required',
            'category_id' => 'nullable|exists:blog_categories,id',
            'meta_title' => 'nullable|string',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            'status' => 'required|in:published,draft',
        ]);
        if ($request->hasFile('featured_image')) {
            $data['featured_image'] = $request->file('featured_image')->store('blogs', 'public');
        }
        $blog->update($data);

        $blog->faqs()->delete();
        if ($request->has('faqs')) {
            foreach ($request->faqs as $faqData) {
                if (!empty($faqData['question']) && !empty($faqData['answer'])) {
                    $blog->faqs()->create([
                        'question' => $faqData['question'],
                        'answer' => $faqData['answer'],
                        'order' => $faqData['order'] ?? 0,
                    ]);
                }
            }
        }

        return redirect()->route('admin.blogs')->with('success', 'Blog updated.');
    }

    public function blogDestroy($id)
    {
        Blog::findOrFail($id)->delete();
        return redirect()->route('admin.blogs')->with('success', 'Blog deleted.');
    }

    // Blog Category CRUD
    public function blogCategories()
    {
        $categories = \App\Models\BlogCategory::withCount('blogs')->orderBy('name')->paginate(15);
        return view('admin.blog_categories.index', compact('categories'));
    }

    public function blogCategoryStore(Request $request)
    {
        if (empty($request->slug)) {
            $request->merge(['slug' => \Illuminate\Support\Str::slug($request->name)]);
        } else {
            $request->merge(['slug' => \Illuminate\Support\Str::slug($request->slug)]);
        }

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|unique:blog_categories,slug',
        ]);

        \App\Models\BlogCategory::create($data);

        return redirect()->route('admin.blog-categories')->with('success', 'Blog category created.');
    }

    public function blogCategoryEdit($id)
    {
        $category = \App\Models\BlogCategory::findOrFail($id);
        return view('admin.blog_categories.edit', compact('category'));
    }

    public function blogCategoryUpdate(Request $request, $id)
    {
        $category = \App\Models\BlogCategory::findOrFail($id);

        if (empty($request->slug)) {
            $request->merge(['slug' => \Illuminate\Support\Str::slug($request->name)]);
        } else {
            $request->merge(['slug' => \Illuminate\Support\Str::slug($request->slug)]);
        }

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|unique:blog_categories,slug,' . $id,
        ]);

        $category->update($data);

        return redirect()->route('admin.blog-categories')->with('success', 'Blog category updated.');
    }

    public function blogCategoryDestroy($id)
    {
        $category = \App\Models\BlogCategory::findOrFail($id);
        
        if ($category->blogs()->count() > 0) {
            return back()->with('error', 'Cannot delete category because it contains active blog posts.');
        }

        $category->delete();
        return redirect()->route('admin.blog-categories')->with('success', 'Blog category deleted.');
    }

    // Revenue
    public function revenue()
    {
        $quotes = QuoteRequest::latest()->paginate(20);
        $companies = Company::where('is_active', true)->orderBy('name')->get();
        return view('admin.revenue', compact('quotes', 'companies'));
    }

    public function dispatchLead(Request $request, $id)
    {
        $request->validate([
            'company_ids' => 'required|array',
            'company_ids.*' => 'exists:companies,id',
        ]);

        $quote = QuoteRequest::findOrFail($id);
        $companyIds = $request->input('company_ids');
        $dispatchedCount = 0;

        foreach ($companyIds as $companyId) {
            // Prevent duplicate dispatches
            $exists = \App\Models\Lead::where('quote_request_id', $quote->id)
                ->where('company_id', $companyId)
                ->exists();

            if (!$exists) {
                $lead = \App\Models\Lead::create([
                    'company_id' => $companyId,
                    'quote_request_id' => $quote->id,
                    'name' => $quote->name,
                    'email' => $quote->email,
                    'phone' => $quote->phone,
                    'zip_from' => $quote->zip_from,
                    'zip_to' => $quote->zip_to,
                    'move_date' => $quote->move_date,
                    'move_size' => $quote->move_size,
                    'message' => "Dispatched quote request. Distance: {$quote->calculated_distance} miles. Est. Cost Range: \${$quote->min_price} - \${$quote->max_price}.",
                    'status' => 'new',
                ]);

                // Send email to the company
                $company = Company::find($companyId);
                if ($company && $company->email) {
                    try {
                        \Illuminate\Support\Facades\Mail::to($company->email)->send(new \App\Mail\LeadDispatched($lead));
                    } catch (\Exception $e) {
                        \Illuminate\Support\Facades\Log::error("Failed to send lead email dispatch to company ID {$companyId}: " . $e->getMessage());
                    }
                }
                $dispatchedCount++;
            }
        }

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => "Lead successfully dispatched to {$dispatchedCount} company(s)."
            ]);
        }

        return back()->with('success', "Lead successfully dispatched to {$dispatchedCount} company(s).");
    }

    // States Management
    public function states()
    {
        $states = State::withCount('companies')->orderBy('name')->paginate(20);
        return view('admin.states.index', compact('states'));
    }

    public function stateEdit($id)
    {
        $state = State::findOrFail($id);
        $companies = Company::where('state_id', $state->id)->orderBy('name')->get();
        return view('admin.states.edit', compact('state', 'companies'));
    }

    public function stateUpdate(Request $request, $id)
    {
        $state = State::findOrFail($id);
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'heading' => 'nullable|string|max:255',
            'content' => 'nullable|string',
            'content_below' => 'nullable|string',
        ]);
        $data['is_active'] = $request->has('is_active');
        $state->update($data);

        // Sync State FAQs (Defensive check for live server migrations)
        if (\Illuminate\Support\Facades\Schema::hasTable('state_faqs')) {
            $state->faqs()->delete();
            if ($request->has('faqs')) {
                foreach ($request->faqs as $faqData) {
                    if (!empty($faqData['question']) && !empty($faqData['answer'])) {
                        $state->faqs()->create([
                            'question' => $faqData['question'],
                            'answer' => $faqData['answer'],
                            'order' => $faqData['order'] ?? 0,
                        ]);
                    }
                }
            }
        }

        return redirect()->route('admin.states')->with('success', 'State updated.');
    }

    public function statePageCreate()
    {
        $states = State::orderBy('name')->get();
        return view('admin.states.create_page', compact('states'));
    }

    public function statePageStore(Request $request)
    {
        $request->validate([
            'state_id' => 'required|exists:states,id',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'heading' => 'nullable|string|max:255',
            'content' => 'nullable|string',
        ]);

        $state = State::findOrFail($request->state_id);
        
        $state->update([
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'heading' => $request->heading,
            'content' => $request->content,
            'is_active' => $request->has('is_active'),
        ]);

        // Sync State FAQs (Defensive check for live server migrations)
        if (\Illuminate\Support\Facades\Schema::hasTable('state_faqs')) {
            $state->faqs()->delete();
            if ($request->has('faqs')) {
                foreach ($request->faqs as $faqData) {
                    if (!empty($faqData['question']) && !empty($faqData['answer'])) {
                        $state->faqs()->create([
                            'question' => $faqData['question'],
                            'answer' => $faqData['answer'],
                            'order' => $faqData['order'] ?? 0,
                        ]);
                    }
                }
            }
        }

        return redirect()->route('admin.states')->with('success', 'State page created/configured successfully.');
    }

    // Cities Management
    public function cities(Request $request)
    {
        $cities = City::has('content')->with(['state', 'content'])
            ->when($request->state_id, fn($q,$s) => $q->where('state_id', $s))
            ->when($request->q, fn($q,$search) => $q->where('name', 'LIKE', "%$search%"))
            ->orderBy('name')
            ->paginate(30);
        $states = State::orderBy('name')->get();
        return view('admin.cities.index', compact('cities', 'states'));
    }

    public function cityEdit($id)
    {
        $city = City::with('content')->findOrFail($id);
        $states = State::orderBy('name')->get();
        return view('admin.cities.edit', compact('city', 'states'));
    }

    public function cityUpdate(Request $request, $id)
    {
        $city = City::findOrFail($id);
        
        $data = $request->validate([
            'slug' => 'nullable|string|max:255|unique:city_contents,slug,' . ($city->content->id ?? 'NULL'),
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'heading' => 'nullable|string|max:255',
            'content' => 'nullable|string',
            'content_below' => 'nullable|string',
        ]);

        $data['is_active'] = $request->has('is_active');
        
        // Update or create city content
        \App\Models\CityContent::updateOrCreate(
            ['city_id' => $city->id],
            $data
        );

        // Sync City FAQs (Defensive check for live server migrations)
        if (\Illuminate\Support\Facades\Schema::hasTable('city_faqs')) {
            $city->faqs()->delete();
            if ($request->has('faqs')) {
                foreach ($request->faqs as $faqData) {
                    if (!empty($faqData['question']) && !empty($faqData['answer'])) {
                        $city->faqs()->create([
                            'question' => $faqData['question'],
                            'answer' => $faqData['answer'],
                            'order' => $faqData['order'] ?? 0,
                        ]);
                    }
                }
            }
        }

        return redirect()->route('admin.cities')->with('success', 'City content updated.');
    }

    public function cityPageCreate()
    {
        $states = State::orderBy('name')->get();
        return view('admin.cities.create_page', compact('states'));
    }

    public function cityPageStore(Request $request)
    {
        $request->validate([
            'city_id' => 'required|exists:cities,id',
            'slug' => 'nullable|string|max:255',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'heading' => 'nullable|string|max:255',
            'content' => 'nullable|string',
            'content_below' => 'nullable|string',
        ]);

        $city = City::findOrFail($request->city_id);
        $slug = $request->slug ?: \Illuminate\Support\Str::slug($city->name);

        // Check unique slug on city_contents except this city
        $existingSlug = \App\Models\CityContent::where('slug', $slug)
            ->where('city_id', '!=', $city->id)
            ->exists();

        if ($existingSlug) {
            $slug = $slug . '-' . $city->id; // make it unique
        }

        \App\Models\CityContent::updateOrCreate(
            ['city_id' => $city->id],
            [
                'slug' => $slug,
                'meta_title' => $request->meta_title,
                'meta_description' => $request->meta_description,
                'heading' => $request->heading,
                'content' => $request->content,
                'content_below' => $request->content_below,
                'is_active' => $request->has('is_active'),
            ]
        );

        // Sync City FAQs (Defensive check for live server migrations)
        if (\Illuminate\Support\Facades\Schema::hasTable('city_faqs')) {
            $city->faqs()->delete();
            if ($request->has('faqs')) {
                foreach ($request->faqs as $faqData) {
                    if (!empty($faqData['question']) && !empty($faqData['answer'])) {
                        $city->faqs()->create([
                            'question' => $faqData['question'],
                            'answer' => $faqData['answer'],
                            'order' => $faqData['order'] ?? 0,
                        ]);
                    }
                }
            }
        }

        return redirect()->route('admin.cities')->with('success', 'City page created/configured successfully.');
    }

    // Settings
    public function settings()
    {
        $settings = \App\Models\SiteSetting::all()->pluck('value', 'key');
        return view('admin.settings', compact('settings'));
    }

    public function settingsUpdate(Request $request)
    {
        foreach ($request->except('_token') as $key => $value) {
            \App\Models\SiteSetting::updateOrCreate(['key' => $key], ['value' => $value]);
        }
        return back()->with('success', 'Settings updated.');
    }

    public function getCities($state_id)
    {
        $cities = City::where('state_id', $state_id)->orderBy('name')->get();
        return response()->json($cities);
    }

    // Top Movers CRUD
    public function topMovers()
    {
        $topMovers = [];
        if (\Illuminate\Support\Facades\Schema::hasTable('top_movers')) {
            $topMovers = \App\Models\TopMover::with(['company.state', 'states', 'cities'])->orderBy('order')->paginate(20);
        }
        return view('admin.top_movers.index', compact('topMovers'));
    }

    public function topMoversCreate()
    {
        $currentTopMovers = [];
        if (\Illuminate\Support\Facades\Schema::hasTable('top_movers')) {
            $currentTopMovers = \App\Models\TopMover::pluck('company_id')->toArray();
        }
        $companies = Company::whereNotIn('id', $currentTopMovers)->orderBy('name')->get();
        $states = \App\Models\State::orderBy('name')->get();
        $cities = \App\Models\City::with('state')->get()->sortBy('name');
        return view('admin.top_movers.create', compact('companies', 'states', 'cities'));
    }

    public function topMoversStore(Request $request)
    {
        $request->validate([
            'company_id' => 'required|exists:companies,id|unique:top_movers,company_id',
            'order' => 'nullable|integer',
            'badge' => 'nullable|string|max:255',
            'heading_1' => 'nullable|string|max:255',
            'heading_2' => 'nullable|string|max:255',
            'heading_3' => 'nullable|string|max:255',
            'states' => 'nullable|array',
            'states.*' => 'exists:states,id',
            'cities' => 'nullable|array',
            'cities.*' => 'exists:cities,id',
        ]);
        
        if (\Illuminate\Support\Facades\Schema::hasTable('top_movers')) {
            $mover = \App\Models\TopMover::create([
                'company_id' => $request->company_id,
                'order' => $request->order ?? 0,
                'badge' => $request->badge,
                'heading_1' => $request->heading_1,
                'heading_2' => $request->heading_2,
                'heading_3' => $request->heading_3,
            ]);

            if ($request->has('states')) {
                $mover->states()->sync($request->states);
            }
            if ($request->has('cities')) {
                $mover->cities()->sync($request->cities);
            }
        }
        return redirect()->route('admin.top-movers')->with('success', 'Company added to Top Movers successfully.');
    }

    public function topMoversEdit($id)
    {
        $topMover = \App\Models\TopMover::with(['states', 'cities'])->findOrFail($id);
        $companies = Company::orderBy('name')->get();
        $states = \App\Models\State::orderBy('name')->get();
        $cities = \App\Models\City::with('state')->get()->sortBy('name');
        
        $selectedStates = $topMover->states->pluck('id')->toArray();
        $selectedCities = $topMover->cities->pluck('id')->toArray();
        
        return view('admin.top_movers.edit', compact('topMover', 'companies', 'states', 'cities', 'selectedStates', 'selectedCities'));
    }

    public function topMoversUpdate(Request $request, $id)
    {
        $mover = \App\Models\TopMover::findOrFail($id);
        
        $request->validate([
            'company_id' => 'required|exists:companies,id|unique:top_movers,company_id,' . $mover->id,
            'order' => 'nullable|integer',
            'badge' => 'nullable|string|max:255',
            'heading_1' => 'nullable|string|max:255',
            'heading_2' => 'nullable|string|max:255',
            'heading_3' => 'nullable|string|max:255',
            'states' => 'nullable|array',
            'states.*' => 'exists:states,id',
            'cities' => 'nullable|array',
            'cities.*' => 'exists:cities,id',
        ]);
        
        $mover->update([
            'company_id' => $request->company_id,
            'order' => $request->order ?? 0,
            'badge' => $request->badge,
            'heading_1' => $request->heading_1,
            'heading_2' => $request->heading_2,
            'heading_3' => $request->heading_3,
        ]);

        $mover->states()->sync($request->states ?? []);
        $mover->cities()->sync($request->cities ?? []);
        
        return redirect()->route('admin.top-movers')->with('success', 'Top Mover updated successfully.');
    }

    public function topMoversDestroy($id)
    {
        if (\Illuminate\Support\Facades\Schema::hasTable('top_movers')) {
            \App\Models\TopMover::findOrFail($id)->delete();
        }
        return redirect()->route('admin.top-movers')->with('success', 'Company removed from Top Movers.');
    }

    // Bottom Movers CRUD
    public function bottomMovers()
    {
        $bottomMovers = [];
        if (\Illuminate\Support\Facades\Schema::hasTable('bottom_movers')) {
            $bottomMovers = \App\Models\BottomMover::with(['company.state', 'states', 'cities'])->orderBy('order')->paginate(20);
        }
        return view('admin.bottom_movers.index', compact('bottomMovers'));
    }

    public function bottomMoversCreate()
    {
        $currentBottomMovers = [];
        if (\Illuminate\Support\Facades\Schema::hasTable('bottom_movers')) {
            $currentBottomMovers = \App\Models\BottomMover::pluck('company_id')->toArray();
        }
        $companies = Company::whereNotIn('id', $currentBottomMovers)->orderBy('name')->get();
        $states = \App\Models\State::orderBy('name')->get();
        $cities = \App\Models\City::with('state')->get()->sortBy('name');
        return view('admin.bottom_movers.create', compact('companies', 'states', 'cities'));
    }

    public function bottomMoversStore(Request $request)
    {
        $request->validate([
            'company_id' => 'required|exists:companies,id|unique:bottom_movers,company_id',
            'order' => 'nullable|integer',
            'content' => 'nullable|string',
            'states' => 'nullable|array',
            'states.*' => 'exists:states,id',
            'cities' => 'nullable|array',
            'cities.*' => 'exists:cities,id',
        ]);
        
        if (\Illuminate\Support\Facades\Schema::hasTable('bottom_movers')) {
            $mover = \App\Models\BottomMover::create([
                'company_id' => $request->company_id,
                'order' => $request->order ?? 0,
                'content' => $request->content,
            ]);

            if ($request->has('states')) {
                $mover->states()->sync($request->states);
            }
            if ($request->has('cities')) {
                $mover->cities()->sync($request->cities);
            }
        }
        return redirect()->route('admin.bottom-movers')->with('success', 'Company added to Bottom Movers successfully.');
    }

    public function bottomMoversEdit($id)
    {
        $bottomMover = \App\Models\BottomMover::with(['states', 'cities'])->findOrFail($id);
        $companies = Company::orderBy('name')->get();
        $states = \App\Models\State::orderBy('name')->get();
        $cities = \App\Models\City::with('state')->get()->sortBy('name');
        
        $selectedStates = $bottomMover->states->pluck('id')->toArray();
        $selectedCities = $bottomMover->cities->pluck('id')->toArray();
        
        return view('admin.bottom_movers.edit', compact('bottomMover', 'companies', 'states', 'cities', 'selectedStates', 'selectedCities'));
    }

    public function bottomMoversUpdate(Request $request, $id)
    {
        $mover = \App\Models\BottomMover::findOrFail($id);
        
        $request->validate([
            'company_id' => 'required|exists:companies,id|unique:bottom_movers,company_id,' . $mover->id,
            'order' => 'nullable|integer',
            'content' => 'nullable|string',
            'states' => 'nullable|array',
            'states.*' => 'exists:states,id',
            'cities' => 'nullable|array',
            'cities.*' => 'exists:cities,id',
        ]);
        
        $mover->update([
            'company_id' => $request->company_id,
            'order' => $request->order ?? 0,
            'content' => $request->content,
        ]);

        $mover->states()->sync($request->states ?? []);
        $mover->cities()->sync($request->cities ?? []);
        
        return redirect()->route('admin.bottom-movers')->with('success', 'Bottom Mover updated successfully.');
    }

    public function bottomMoversDestroy($id)
    {
        if (\Illuminate\Support\Facades\Schema::hasTable('bottom_movers')) {
            \App\Models\BottomMover::findOrFail($id)->delete();
        }
        return redirect()->route('admin.bottom-movers')->with('success', 'Company removed from Bottom Movers.');
    }

    public function contactMoverLeads()
    {
        $leads = \App\Models\ContactMoverLead::with('company')->latest()->paginate(20);
        return view('admin.contact_mover_leads.index', compact('leads'));
    }

    public function contactMoverLeadShow($id)
    {
        $lead = \App\Models\ContactMoverLead::with('company')->findOrFail($id);
        return response()->json([
            'success' => true,
            'lead' => $lead,
            'company_name' => $lead->company ? $lead->company->name : 'N/A'
        ]);
    }

    public function contactMoverLeadDestroy($id)
    {
        $lead = \App\Models\ContactMoverLead::findOrFail($id);
        $lead->delete();
        return redirect()->route('admin.contact-mover-leads')->with('success', 'Lead deleted successfully.');
    }
}
