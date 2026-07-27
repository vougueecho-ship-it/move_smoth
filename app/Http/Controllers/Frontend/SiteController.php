<?php
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Review;
use App\Models\State;
use App\Models\City;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\QuoteRequest;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function home()
    {
        $reviews = Review::whereHas('company', function($q) {
                $q->where('is_active', true);
            })
            ->where('status', 'approved')
            ->whereIn('id', function($query) {
                $query->selectRaw('MAX(id)')
                    ->from('reviews')
                    ->where('status', 'approved')
                    ->groupBy('company_id');
            })
            ->with('company')
            ->latest()
            ->take(6)
            ->get();

        $featuredCompanies = Company::where('is_active', true)
            ->with(['reviews', 'state'])
            ->withAvg('reviews', 'rating')
            ->withCount('reviews')
            ->orderByDesc('created_at')
            ->take(6)->get();
            
        $blogs = Blog::with(['category','user'])->where('status','published')->latest()->take(3)->get();
        
        // footerStates is shared via AppServiceProvider, but we can pass local ones if needed
        return view('pages.home', compact('reviews','featuredCompanies','blogs'));
    }

    public function movers(Request $request)
    {
        $q = trim((string)$request->get('q')) ?: null;
        $companies = Company::where('is_active', true)
            ->with(['state'])
            ->withAvg('reviews','rating')
            ->withCount('reviews')
            ->when($q, function($query) use ($q) {
                $query->where(function($qq) use ($q) {
                    $qq->where('name','LIKE',"%$q%")
                       ->orWhere('city','LIKE',"%$q%")
                       ->orWhereHas('state', fn($s) => $s->where('name','LIKE',"%$q%")->orWhere('code','LIKE',"%$q%"));
                });
            })
            ->orderBy('name')
            ->paginate(12)
            ->appends($request->query());

        return view('pages.movers', compact('companies','q'));
    }

    public function moversDirectory()
    {
        $states = State::active()
            ->withCount('companies')
            ->orderBy('name')
            ->get();

        $cities = City::active()
            ->with(['state', 'content'])
            ->orderBy('name')
            ->get()
            ->groupBy('state_id');

        return view('pages.movers_directory', compact('states', 'cities'));
    }

    public function stateMovers($state)
    {
        $stateModel = State::where('slug', $state)
            ->orWhere('code', strtoupper($state))
            ->first();

        if (!$stateModel || !$stateModel->is_active || empty($stateModel->content)) {
            // Fallback check: If the URL is actually a company profile slug requested under movers/ prefix
            $company = Company::where('slug', $state)->where('is_active', true)->first();
            if ($company) {
                return redirect()->route('front.company.profile', $company->slug, 301);
            }
            abort(404);
        }

        // If the URL contains the 2-letter state code or wrong casing, redirect to the lowercase slug
        if (strlen($state) === 2 || $state !== strtolower($stateModel->slug)) {
            return redirect()->route('front.state.movers', strtolower($stateModel->slug), 301);
        }

        $stateModelQuery = State::where('id', $stateModel->id);
            
        if (\Illuminate\Support\Facades\Schema::hasTable('state_faqs')) {
            $stateModelQuery->with(['faqs']);
        }
        
        $stateModel = $stateModelQuery->first();

        $topMovers = collect();
        if (\Illuminate\Support\Facades\Schema::hasTable('top_movers')) {
            $topMoversList = \App\Models\TopMover::whereHas('states', function($q) use ($stateModel) {
                $q->where('states.id', $stateModel->id);
            })->with(['company' => function($q) {
                $q->where('is_active', true)->withCount('reviews')->withAvg('reviews', 'rating');
            }])->orderBy('order')->take(3)->get();

            $topMovers = $topMoversList->filter(fn($tm) => !empty($tm->company))->map(function($tm) {
                $comp = $tm->company;
                $comp->mover_heading_1 = $tm->heading_1;
                $comp->mover_heading_2 = $tm->heading_2;
                $comp->mover_heading_3 = $tm->heading_3;
                $comp->mover_badge = $tm->badge;
                $comp->is_custom_mover = true;
                return $comp;
            });
        }

        if ($topMovers->isEmpty()) {
            $topMovers = Company::where('state_id', $stateModel->id)
                ->where('is_active', true)
                ->withCount('reviews')
                ->withAvg('reviews', 'rating')
                ->orderByDesc('reviews_avg_rating')
                ->take(3)
                ->get()
                ->map(function($comp) {
                    $comp->mover_heading_1 = null;
                    $comp->mover_heading_2 = null;
                    $comp->mover_heading_3 = null;
                    $comp->mover_badge = null;
                    $comp->is_custom_mover = false;
                    return $comp;
                });
        }

        $bottomMovers = collect();
        if (\Illuminate\Support\Facades\Schema::hasTable('bottom_movers')) {
            $bottomMoversList = \App\Models\BottomMover::whereHas('states', function($q) use ($stateModel) {
                $q->where('states.id', $stateModel->id);
            })->with(['company' => function($q) {
                $q->where('is_active', true)->withCount('reviews')->withAvg('reviews', 'rating');
            }])->orderBy('order')->take(5)->get();

            $bottomMovers = $bottomMoversList->filter(fn($bm) => !empty($bm->company))->map(function($bm) {
                $comp = $bm->company;
                $comp->mover_content = $bm->content;
                $comp->is_custom_mover = true;
                return $comp;
            });
        }

        if ($bottomMovers->isEmpty()) {
            $bottomMovers = Company::where('state_id', $stateModel->id)
                ->where('is_active', true)
                ->whereNotIn('id', $topMovers->pluck('id'))
                ->withCount('reviews')
                ->withAvg('reviews', 'rating')
                ->take(5)
                ->get()
                ->map(function($comp) {
                    $comp->mover_content = null;
                    $comp->is_custom_mover = false;
                    return $comp;
                });
        }

        $companies = Company::where('state_id', $stateModel->id)
            ->where('is_active', true)
            ->withCount('reviews')
            ->withAvg('reviews', 'rating')
            ->paginate(10);

        $cities = City::where('state_id', $stateModel->id)
            ->whereHas('content', fn($q) => $q->where('is_active', true)->whereNotNull('content'))
            ->with('content')
            ->orderBy('name')
            ->get();

        $stateName = $stateModel->name;

        return view('pages.state_movers', compact('stateModel', 'companies', 'topMovers', 'bottomMovers', 'cities', 'stateName'));
    }

    public function cityMovers($state, $city)
    {
        if (strlen($state) !== 2 || $state !== strtolower($state)) {
            $stateModel = State::where('slug', $state)
                ->orWhere('code', strtoupper($state))
                ->firstOrFail();
            return redirect()->route('front.city.movers', [strtolower($stateModel->code), $city], 301);
        }

        if (strtolower($state) === 'ny' && ($city === 'new-york' || $city === 'new-york-city')) {
            return redirect()->route('front.city.movers', ['ny', 'movers-in-new-york-city'], 301);
        }

        $stateModel = State::where('code', strtoupper($state))->firstOrFail();

        $cityModelQuery = City::whereHas('content', fn($q) => $q->where('slug', $city))
            ->where('state_id', $stateModel->id)
            ->with('content');

        if (\Illuminate\Support\Facades\Schema::hasTable('city_faqs')) {
            $cityModelQuery->with('faqs');
        }

        $cityModel = $cityModelQuery->first();

        if (
            !$cityModel
            || !$cityModel->content
            || !$cityModel->content->is_active
            || empty($cityModel->content->content)
        ) {
            if ($stateModel->is_active && !empty($stateModel->content)) {
                return redirect()->route('front.state.movers', strtolower($stateModel->slug), 301);
            }

            abort(404);
        }

        $topMovers = collect();
        if (\Illuminate\Support\Facades\Schema::hasTable('top_movers')) {
            $topMoversList = \App\Models\TopMover::whereHas('cities', function($q) use ($cityModel) {
                $q->where('cities.id', $cityModel->id);
            })->with(['company' => function($q) {
                $q->where('is_active', true)->withCount('reviews')->withAvg('reviews', 'rating');
            }])->orderBy('order')->take(3)->get();

            $topMovers = $topMoversList->filter(fn($tm) => !empty($tm->company))->map(function($tm) {
                $comp = $tm->company;
                $comp->mover_heading_1 = $tm->heading_1;
                $comp->mover_heading_2 = $tm->heading_2;
                $comp->mover_heading_3 = $tm->heading_3;
                $comp->mover_badge = $tm->badge;
                $comp->is_custom_mover = true;
                return $comp;
            });
        }

        $bottomMovers = collect();
        if (\Illuminate\Support\Facades\Schema::hasTable('bottom_movers')) {
            $bottomMoversList = \App\Models\BottomMover::whereHas('cities', function($q) use ($cityModel) {
                $q->where('cities.id', $cityModel->id);
            })->with(['company' => function($q) {
                $q->where('is_active', true)->withCount('reviews')->withAvg('reviews', 'rating');
            }])->orderBy('order')->take(5)->get();

            $bottomMovers = $bottomMoversList->filter(fn($bm) => !empty($bm->company))->map(function($bm) {
                $comp = $bm->company;
                $comp->mover_content = $bm->content;
                $comp->is_custom_mover = true;
                return $comp;
            });
        }

        $companies = Company::where('state_id', $stateModel->id)
            ->where('is_active', true)
            ->withCount('reviews')
            ->withAvg('reviews', 'rating')
            ->paginate(10);

        $cityName = $cityModel->name;
        $stateName = $stateModel->name;

        return view('pages.city_movers', compact('stateModel', 'cityModel', 'companies', 'cityName', 'stateName', 'topMovers', 'bottomMovers'));
    }

    public function companyProfile($slug)
    {
        $company = Company::where('slug', $slug)
            ->where('is_active', true)
            ->with(['reviews' => fn($q) => $q->where('status', 'approved')->latest(), 'state', 'country'])
            ->first();

        if (!$company) {
            // Check if slug ends with -digits (e.g. -123)
            if (preg_match('/^(.+)-(\d+)$/', $slug, $matches)) {
                $baseSlug = $matches[1];
                $companyExists = Company::where('slug', $baseSlug)->where('is_active', true)->exists();
                if ($companyExists) {
                    return redirect()->route('front.company.profile', ['slug' => $baseSlug], 301);
                }
            }
            abort(404);
        }

        return view('pages.company_profile', compact('company'));
    }

    public function about() { return view('pages.about'); }
    public function contact() { return view('pages.contact'); }

    public function contactStore(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);
        ContactMessage::create($data);
        return back()->with('success', 'Message sent.');
    }



    public function quoteSubmit(Request $request)
    {
        $data = $request->validate([
            'zip_from' => 'required|string',
            'zip_to' => 'required|string',
            'move_date' => 'nullable|date',
            'move_size' => 'nullable|string',
            'name' => 'required|string|max:120',
            'email' => 'required|email',
            'phone' => 'required|string|max:50',
        ]);

        // Robust multi-tier city lookup utility
        $findCity = function ($input) {
            $input = trim($input);
            if (empty($input)) {
                return null;
            }

            // Tier 1: Check for 5-digit ZIP code anywhere in the input
            if (preg_match('/(\d{5})/', $input, $matches)) {
                $zip = $matches[1];
                $city = City::where('zip_code', $zip)->first();
                if ($city) {
                    return $city;
                }
            }

            // Tier 2: Check for "City, State" pattern (e.g., "Beverly Hills, CA" or "Austin, Texas")
            if (str_contains($input, ',')) {
                $parts = explode(',', $input);
                $cityName = trim($parts[0]);
                $statePart = trim($parts[1]);

                // Try to find state by code or name
                $state = State::where('code', $statePart)
                    ->orWhere('name', 'LIKE', $statePart)
                    ->first();

                if ($state) {
                    $city = City::where('state_id', $state->id)
                        ->where('name', 'LIKE', $cityName)
                        ->first();
                    if ($city) {
                        return $city;
                    }

                    // Fallback to fuzzy city match within state
                    $city = City::where('state_id', $state->id)
                        ->where('name', 'LIKE', '%' . $cityName . '%')
                        ->first();
                    if ($city) {
                        return $city;
                    }
                }
            }

            // Tier 3: Check if input matches zip_code exactly (e.g. non-5 digit or exact zip lookup)
            $city = City::where('zip_code', $input)->first();
            if ($city) {
                return $city;
            }

            // Tier 4: Exact match by city name
            $city = City::where('name', $input)->first();
            if ($city) {
                return $city;
            }

            // Tier 5: Fuzzy match by city name
            $city = City::where('name', 'LIKE', '%' . $input . '%')->first();
            if ($city) {
                return $city;
            }

            return null;
        };

        $cityFrom = $findCity($data['zip_from']);
        $cityTo = $findCity($data['zip_to']);

        $distance = 150; // Default distance in miles
        if ($cityFrom && $cityTo) {
            $lat1 = $cityFrom->latitude;
            $lon1 = $cityFrom->longitude;
            $lat2 = $cityTo->latitude;
            $lon2 = $cityTo->longitude;

            if ($lat1 && $lon1 && $lat2 && $lon2) {
                $theta = $lon1 - $lon2;
                $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
                $dist = acos($dist);
                $dist = rad2deg($dist);
                $miles = $dist * 60 * 1.1515;
                $distance = round($miles);
            }
        }

        $basePrices = [
            'Studio' => 400,
            '1 Bedroom' => 600,
            '2 Bedroom' => 900,
            '3+ Bedroom' => 1400,
            'Studio / 1BR' => 500,
            '2 - 3 Bedroom' => 1000,
            '4+ Bedroom' => 1800,
        ];

        $size = $data['move_size'] ?? '1 Bedroom';
        $base = $basePrices[$size] ?? 600;

        $minPrice = $base + ($distance * 1.25);
        $maxPrice = $base + ($distance * 1.75) + 100;

        $data['calculated_distance'] = $distance;
        $data['min_price'] = round($minPrice);
        $data['max_price'] = round($maxPrice);
        $data['status'] = 'Delivered';

        $quote = QuoteRequest::create($data);

        // Dispatch Email to User
        try {
            \Illuminate\Support\Facades\Mail::to($quote->email)->send(new \App\Mail\UserQuoteEstimate($quote));
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error("Failed to send quote estimate email to user {$quote->email}: " . $e->getMessage());
        }

        // Dispatch Email to Admin
        try {
            $adminUser = \App\Models\User::where('is_admin', true)->first();
            $adminEmail = $adminUser ? $adminUser->email : null;
            
            // Fallback to configured from address if DB admin is a placeholder or not set
            if (!$adminEmail || str_contains($adminEmail, 'example.com') || $adminEmail === 'admin@movesmoth.com') {
                $adminEmail = config('mail.from.address') ?: 'admin@movesmoth.com';
            }
            
            \Illuminate\Support\Facades\Mail::to($adminEmail)->send(new \App\Mail\AdminQuoteNotification($quote));
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error("Failed to send new quote request email to admin: " . $e->getMessage());
        }

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'quote' => $quote,
                'min_price' => $quote->min_price,
                'max_price' => $quote->max_price,
                'distance' => $quote->calculated_distance
            ]);
        }

        session(['quote_data' => $data]);
        return redirect()->route('front.thankyou');
    }

    public function zipSuggestions(Request $request)
    {
        $q = trim((string)$request->get('q'));
        if (strlen($q) < 2) {
            return response()->json([]);
        }

        $cities = City::with('state')
            ->where(function($query) use ($q) {
                if (is_numeric($q)) {
                    $query->where('zip_code', 'LIKE', "$q%");
                } else {
                    $query->where('name', 'LIKE', "%$q%")
                          ->orWhereHas('state', function($sQuery) use ($q) {
                              $sQuery->where('code', 'LIKE', "$q%")
                                     ->orWhere('name', 'LIKE', "%$q%");
                          });
                }
            })
            ->limit(10)
            ->get();

        $suggestions = $cities->map(function($city) {
            return [
                'zip_code' => $city->zip_code,
                'city' => $city->name,
                'state' => $city->state->code ?? ''
            ];
        });

        return response()->json($suggestions);
    }


    public function thankYou() { return view('pages.thankyou'); }

    public function blog(Request $request)
    {
        $query = Blog::with(['category','user'])->where('status','published');

        if ($request->filled('category')) {
            $categorySlug = $request->query('category');
            $query->whereHas('category', function($q) use ($categorySlug) {
                $q->where('slug', $categorySlug);
            });
        }

        if ($request->filled('search')) {
            $search = $request->query('search');
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                  ->orWhere('content', 'like', '%' . $search . '%');
            });
        }

        $blogs = $query->latest()->paginate(9)->withQueryString();
        $categories = BlogCategory::orderBy('name')->get();
        return view('pages.blog', compact('blogs','categories'));
    }

    public function blogDetail($category_slug, $slug)
    {
        $blog = Blog::with(['category','user','faqs'])->where('slug', $slug)->firstOrFail();

        // Validate the category slug, redirect if mismatch to maintain SEO canonicalization
        if (!$blog->category || $blog->category->slug !== $category_slug) {
            return redirect()->route('front.blog.detail', [
                'category_slug' => $blog->category->slug ?? 'uncategorized',
                'slug' => $blog->slug
            ], 301);
        }

        $relatedBlogs = Blog::with('category')->where('id','!=', $blog->id)->where('category_id', $blog->category_id)->where('status','published')->take(3)->get();
        return view('pages.blog_detail', compact('blog','relatedBlogs'));
    }

    public function privacy() { return view('pages.privacy'); }
    public function terms() { return view('pages.terms'); }

    public function reviewCreate(Request $request)
    {
        $q = $request->get('q');
        $companies = Company::where('is_active', true)
            ->when($q, function($query) use ($q) {
                $query->where('name', 'LIKE', "%$q%");
            })
            ->orderBy('name')
            ->paginate(20);

        return view('pages.review_create', compact('companies', 'q'));
    }

    public function reviewForm($slug)
    {
        $company = Company::where('slug', $slug)->first();
        if (!$company) {
            if (preg_match('/^(.+)-(\d+)$/', $slug, $matches)) {
                $baseSlug = $matches[1];
                $companyExists = Company::where('slug', $baseSlug)->exists();
                if ($companyExists) {
                    return redirect()->route('front.review.form', ['company' => $baseSlug], 301);
                }
            }
            abort(404);
        }
        return view('pages.review_form', compact('company'));
    }

    public function reviewStore(Request $request, $slug)
    {
        $company = Company::where('slug', $slug)->first();
        if (!$company) {
            if (preg_match('/^(.+)-(\d+)$/', $slug, $matches)) {
                $baseSlug = $matches[1];
                $company = Company::where('slug', $baseSlug)->first();
            }
        }
        if (!$company) {
            abort(404);
        }
        
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'rating' => 'required|numeric|min:1|max:5',
            'title' => 'required|string|max:255',
            'comment' => 'required|string|min:10',
            'move_date' => 'nullable|date',
            'move_type' => 'nullable|string|in:local,interstate,commercial,specialty',
            'would_recommend' => 'required|boolean'
        ]);

        $data['company_id'] = $company->id;
        $data['status'] = 'pending';

        Review::create($data);

        return redirect()->route('front.company.profile', $company->slug)->with('success', 'Thank you! Your review has been submitted and is pending approval.');
    }

    public function pricing() { return view('pages.pricing'); }
    public function movingCostCalculator() { return view('pages.calculator'); }

    public function compareMovers(Request $request)
    {
        $companies = Company::where('is_active', true)
            ->with(['state'])
            ->withAvg('reviews', 'rating')
            ->withCount('reviews')
            ->orderBy('name')
            ->get()
            ->map(function($c) {
                $serviceTypes = explode(',', strtolower($c->service_type ?? ''));
                return [
                    'id' => $c->id,
                    'name' => $c->name,
                    'slug' => $c->slug,
                    'logo' => $c->logo_url,
                    'rating' => number_format($c->reviews_avg_rating ?? 0.0, 1),
                    'reviews_count' => $c->reviews_count ?? 0,
                    'city' => $c->city,
                    'state' => $c->state->name ?? 'US',
                    'usdot' => $c->dot_number ?? 'N/A',
                    'phone' => $c->phone ?? 'N/A',
                    'website' => $c->website ?? '#',
                    'services' => [
                        'local' => in_array('local', $serviceTypes),
                        'long' => in_array('long_distance', $serviceTypes) || in_array('interstate', $serviceTypes),
                        'commercial' => in_array('commercial', $serviceTypes),
                        'residential' => in_array('residential', $serviceTypes) || in_array('local', $serviceTypes) || in_array('long_distance', $serviceTypes),
                        'packing' => in_array('packing', $serviceTypes),
                        'storage' => in_array('storage', $serviceTypes)
                    ]
                ];
            });
            
        return view('pages.compare_movers', compact('companies'));
    }

    public function serviceLocal()
    {
        $companies = Company::where('is_active', true)
            ->with(['state'])
            ->withAvg('reviews', 'rating')
            ->withCount('reviews')
            ->orderBy('name')
            ->paginate(10);
        return view('pages.services.local-moving', compact('companies'));
    }

    public function serviceLongDistance()
    {
        $companies = Company::where('is_active', true)
            ->with(['state'])
            ->withAvg('reviews', 'rating')
            ->withCount('reviews')
            ->orderBy('name')
            ->paginate(10);
        return view('pages.services.long-distance-moving', compact('companies'));
    }

    public function serviceCommercial()
    {
        $companies = Company::where('is_active', true)
            ->with(['state'])
            ->withAvg('reviews', 'rating')
            ->withCount('reviews')
            ->orderBy('name')
            ->paginate(10);
        return view('pages.services.commercial-moving', compact('companies'));
    }

    public function servicePacking()
    {
        $companies = Company::where('is_active', true)
            ->with(['state'])
            ->withAvg('reviews', 'rating')
            ->withCount('reviews')
            ->orderBy('name')
            ->paginate(10);
        return view('pages.services.packing-services', compact('companies'));
    }

    public function serviceStorage()
    {
        $companies = Company::where('is_active', true)
            ->with(['state'])
            ->withAvg('reviews', 'rating')
            ->withCount('reviews')
            ->orderBy('name')
            ->paginate(10);
        return view('pages.services.storage-units', compact('companies'));
    }

    public function serviceResidential()
    {
        $companies = Company::where('is_active', true)
            ->with(['state'])
            ->withAvg('reviews', 'rating')
            ->withCount('reviews')
            ->orderBy('name')
            ->paginate(10);
        return view('pages.services.residential-moving', compact('companies'));
    }
    public function cookies() { return view('pages.cookies'); }
    public function disclaimer() { return view('pages.disclaimer'); }

    public function getCitiesByState($state_id)
    {
        $cities = City::where('state_id', $state_id)->orderBy('name')->get(['id', 'name']);
        return response()->json($cities);
    }

    public function chatbotChat(Request $request)
    {
        $messages = $request->input('messages', []);
        $apiKey = env('ANTHROPIC_API_KEY');

        if ($apiKey) {
            try {
                $systemPrompt = "You are a friendly, conversational AI assistant for MoveSmooth — a professional moving company that helps people move homes and offices.
Your personality is warm, helpful, and natural. Your main goal is to naturally steer the conversation toward moving services and collect lead info (Name, Email, Phone, Moving From, Moving To, Move Date, Home Size) gradually. Once you have gathered Name, Email, Phone, Moving From, and Moving To, output a special JSON block exactly like this at the end of your message (invisible to the user):
<!--LEAD_DATA:{\"name\":\"...\",\"email\":\"...\",\"phone\":\"...\",\"from_city\":\"...\",\"to_city\":\"...\",\"move_date\":\"...\",\"home_size\":\"...\"}-->
Always respond in English only.";

                $response = \Illuminate\Support\Facades\Http::withHeaders([
                    'x-api-key' => $apiKey,
                    'anthropic-version' => '2023-06-01',
                    'content-type' => 'application/json',
                ])->post('https://api.anthropic.com/v1/messages', [
                    'model' => 'claude-3-5-sonnet-20241022',
                    'max_tokens' => 1000,
                    'system' => $systemPrompt,
                    'messages' => $messages
                ]);

                if ($response->successful()) {
                    return response()->json($response->json());
                } else {
                    \Illuminate\Support\Facades\Log::error("Anthropic API Error: " . $response->body());
                }
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::error("Anthropic Client Exception: " . $e->getMessage());
            }
        }

        // Rule-based Fallback AI Engine (highly smart and conversational)
        $name = null;
        $email = null;
        $phone = null;
        $from = null;
        $to = null;
        $date = null;
        $size = null;

        foreach ($messages as $msg) {
            if (($msg['role'] ?? '') === 'user') {
                $content = $msg['content'] ?? '';

                // Extract email
                if (preg_match('/[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}/', $content, $matches)) {
                    $email = $matches[0];
                }

                // Extract phone
                if (preg_match('/(\+?\d{1,3}[-.\s]?)?\(?\d{3}\)?[-.\s]?\d{3}[-.\s]?\d{4}/', $content, $matches)) {
                    $phone = $matches[0];
                }

                // Extract ZIP or Cities
                if (preg_match_all('/(\d{5})/', $content, $matches)) {
                    foreach ($matches[0] as $z) {
                        if (!$from) {
                            $from = $z;
                        } elseif (!$to) {
                            $to = $z;
                        }
                    }
                }
            }
        }

        // Get last user message to extract details contextually
        $lastUserMsg = '';
        for ($i = count($messages) - 1; $i >= 0; $i--) {
            if (($messages[$i]['role'] ?? '') === 'user') {
                $lastUserMsg = trim($messages[$i]['content'] ?? '');
                break;
            }
        }

        $userMsgsCount = 0;
        foreach ($messages as $msg) {
            if (($msg['role'] ?? '') === 'user') {
                $userMsgsCount++;
            }
        }

        if ($userMsgsCount <= 1) {
            $name = $lastUserMsg ?: 'Friend';
            if (strlen($name) > 30 || str_contains($name, ' ')) {
                $name = 'Friend';
            }
            $reply = "Hello! 👋 Nice to meet you. I am your MoveSmooth AI Assistant. I can help with packing tips, moving advice, or calculate an instant estimate. \n\nTo help you best, what is your name and where are you moving from? 🚚";
        } elseif (!$from || !$to) {
            // Contextual extraction
            if (preg_match('/from\s+([a-zA-Z\s,]+)\s+to\s+([a-zA-Z\s,]+)/i', $lastUserMsg, $m)) {
                $from = trim($m[1]);
                $to = trim($m[2]);
            }
            $reply = "Got it! Knowing your route helps us calculate a highly accurate estimate. Where are you moving **from** and what is your **destination city**? (ZIP codes or City, State work great!) 📍";
        } elseif (!$size || !$date) {
            $reply = "Awesome! 📦 To calculate a precise moving budget range, what is your approximate **move date** and **home size** (e.g. Studio, 1 Bedroom, or 2-3 Bedroom)?";
        } elseif (!$email || !$phone) {
            $reply = "Perfect, thanks! We are ready to calculate your automated cost range. \n\nCould you please share your **email address** and **phone number** so we can secure your quote reference number? 📞";
        } else {
            $reply = "Fantastic! I've saved your details and calculated your estimate. One of our regional dispatchers will reach out with the best options shortly! \n\nIs there any other packing or service details I can help you with? 🌟";
            
            $leadData = [
                'name' => $name ?: 'Valued Customer',
                'email' => $email ?: 'customer@movesmoth.com',
                'phone' => $phone ?: '555-0199',
                'from_city' => $from ?: '90001',
                'to_city' => $to ?: '94101',
                'move_date' => $date ?: now()->addDays(14)->format('Y-m-d'),
                'home_size' => $size ?: '1 Bedroom'
            ];
            $reply .= "\n<!--LEAD_DATA:" . json_encode($leadData) . "-->";
        }

        return response()->json([
            'content' => [
                [
                    'text' => $reply
                ]
            ]
        ]);
    }

    public function chatbotLeadStore(Request $request)
    {
        $data = $request->validate([
            'name' => 'nullable|string|max:120',
            'email' => 'nullable|email|max:120',
            'phone' => 'nullable|string|max:50',
            'from_city' => 'nullable|string|max:120',
            'to_city' => 'nullable|string|max:120',
            'move_date' => 'nullable|string',
            'home_size' => 'nullable|string|max:120',
        ]);

        $quoteData = [
            'name' => $data['name'] ?: 'Chatbot Lead',
            'email' => $data['email'] ?: 'chatbot@movesmoth.com',
            'phone' => $data['phone'] ?: '555-0000',
            'zip_from' => $data['from_city'] ?: '90001',
            'zip_to' => $data['to_city'] ?: '94101',
            'move_size' => $data['home_size'] ?: '1 Bedroom',
            'move_date' => null,
            'status' => 'Delivered'
        ];

        if (!empty($data['move_date'])) {
            try {
                $quoteData['move_date'] = \Carbon\Carbon::parse($data['move_date'])->format('Y-m-d');
            } catch (\Exception $e) {
                // Ignore parse errors
            }
        }

        // 5-tier fuzzy coordinate lookups
        $findCity = function ($input) {
            $input = trim($input);
            if (empty($input)) {
                return null;
            }

            if (preg_match('/(\d{5})/', $input, $matches)) {
                $zip = $matches[1];
                $city = City::where('zip_code', $zip)->first();
                if ($city) {
                    return $city;
                }
            }

            if (str_contains($input, ',')) {
                $parts = explode(',', $input);
                $cityName = trim($parts[0]);
                $statePart = trim($parts[1]);

                $state = State::where('code', $statePart)
                    ->orWhere('name', 'LIKE', $statePart)
                    ->first();

                if ($state) {
                    $city = City::where('state_id', $state->id)
                        ->where('name', 'LIKE', $cityName)
                        ->first();
                    if ($city) {
                        return $city;
                    }

                    $city = City::where('state_id', $state->id)
                        ->where('name', 'LIKE', '%' . $cityName . '%')
                        ->first();
                    if ($city) {
                        return $city;
                    }
                }
            }

            $city = City::where('zip_code', $input)->first();
            if ($city) {
                return $city;
            }

            $city = City::where('name', $input)->first();
            if ($city) {
                return $city;
            }

            $city = City::where('name', 'LIKE', '%' . $input . '%')->first();
            if ($city) {
                return $city;
            }

            return null;
        };

        $cityFrom = $findCity($quoteData['zip_from']);
        $cityTo = $findCity($quoteData['zip_to']);

        $distance = 150;
        if ($cityFrom && $cityTo) {
            $lat1 = $cityFrom->latitude;
            $lon1 = $cityFrom->longitude;
            $lat2 = $cityTo->latitude;
            $lon2 = $cityTo->longitude;

            if ($lat1 && $lon1 && $lat2 && $lon2) {
                $theta = $lon1 - $lon2;
                $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
                $dist = acos($dist);
                $dist = rad2deg($dist);
                $miles = $dist * 60 * 1.1515;
                $distance = round($miles);
            }
        }

        $basePrices = [
            'Studio' => 400,
            '1 Bedroom' => 600,
            '2 Bedroom' => 900,
            '3+ Bedroom' => 1400,
            'Studio / 1BR' => 500,
            '2 - 3 Bedroom' => 1000,
            '4+ Bedroom' => 1800,
        ];

        $size = $quoteData['move_size'] ?? '1 Bedroom';
        $base = $basePrices[$size] ?? 600;

        $minPrice = $base + ($distance * 1.25);
        $maxPrice = $base + ($distance * 1.75) + 100;

        $quoteData['calculated_distance'] = $distance;
        $quoteData['min_price'] = round($minPrice);
        $quoteData['max_price'] = round($maxPrice);

        $quote = QuoteRequest::create($quoteData);

        // Dispatch emails to user and admin
        try {
            \Illuminate\Support\Facades\Mail::to($quote->email)->send(new \App\Mail\UserQuoteEstimate($quote));
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error("Failed to send chatbot quote estimate to user: " . $e->getMessage());
        }

        try {
            $adminUser = \App\Models\User::where('is_admin', true)->first();
            $adminEmail = $adminUser ? $adminUser->email : null;
            if (!$adminEmail || str_contains($adminEmail, 'example.com') || $adminEmail === 'admin@movesmoth.com') {
                $adminEmail = config('mail.from.address') ?: 'admin@movesmoth.com';
            }
            \Illuminate\Support\Facades\Mail::to($adminEmail)->send(new \App\Mail\AdminQuoteNotification($quote));
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error("Failed to send chatbot quote notification to admin: " . $e->getMessage());
        }

        return response()->json([
            'success' => true,
            'quote' => $quote
        ]);
    }

    public function contactMover($slug)
    {
        $company = \App\Models\Company::where('slug', $slug)->firstOrFail();
        return view('pages.contact_mover', compact('company'));
    }

    public function contactMoverSubmit(Request $request, $slug)
    {
        $company = \App\Models\Company::where('slug', $slug)->firstOrFail();

        $data = $request->validate([
            'zip_from' => 'required|string|max:255',
            'zip_to' => 'required|string|max:255',
            'move_date' => 'required|date',
            'move_size' => 'required|string|max:255',
            'num_rooms' => 'required|string|max:255',
            'packing_service' => 'required|string|max:255',
            'storage_option' => 'required|string|max:255',
            'name' => 'required|string|max:120',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:50',
            'message' => 'nullable|string',
        ]);

        $lead = \App\Models\ContactMoverLead::create([
            'company_id' => $company->id,
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'move_from' => $data['zip_from'],
            'move_to' => $data['zip_to'],
            'move_date' => $data['move_date'],
            'move_size' => $data['move_size'],
            'num_rooms' => $data['num_rooms'],
            'packing_service' => $data['packing_service'],
            'storage_option' => $data['storage_option'],
            'message' => $data['message'] ?? null,
        ]);

        // Send Email to User
        try {
            \Illuminate\Support\Facades\Mail::to($lead->email)->send(new \App\Mail\UserContactMoverLeadEmail($lead));
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error("Failed to send contact mover lead confirmation email to user {$lead->email}: " . $e->getMessage());
        }

        // Send Email to Admin (optional but helpful so admin knows there's a new direct company lead)
        try {
            $adminUser = \App\Models\User::where('is_admin', true)->first();
            $adminEmail = $adminUser ? $adminUser->email : null;
            if (!$adminEmail || str_contains($adminEmail, 'example.com') || $adminEmail === 'admin@movesmoth.com') {
                $adminEmail = config('mail.from.address') ?: 'admin@movesmoth.com';
            }
            // Send standard quote notification or custom notify
            \Illuminate\Support\Facades\Mail::to($adminEmail)->send(new \App\Mail\AdminQuoteNotification(new \App\Models\QuoteRequest([
                'name' => $lead->name,
                'email' => $lead->email,
                'phone' => $lead->phone,
                'zip_from' => $lead->move_from,
                'zip_to' => $lead->move_to,
                'move_date' => $lead->move_date,
                'move_size' => $lead->move_size,
                'calculated_distance' => 0,
                'min_price' => 0,
                'max_price' => 0,
                'status' => 'Company Direct Lead'
            ])));
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error("Failed to send admin notification for direct company lead: " . $e->getMessage());
        }

        return redirect()->route('front.contact-mover.thankyou', $company->slug)->with('lead_id', $lead->id);
    }

    public function contactMoverThankYou($slug)
    {
        $company = \App\Models\Company::where('slug', $slug)->firstOrFail();
        $lead = null;
        if (session('lead_id')) {
            $lead = \App\Models\ContactMoverLead::find(session('lead_id'));
        }
        return view('pages.contact_mover_thankyou', compact('company', 'lead'));
    }
}
