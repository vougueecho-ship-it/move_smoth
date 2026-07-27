<?php
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function showLogin() { return view('auth.login'); }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            $user = Auth::user();
            if ($user->is_admin) return redirect()->route('admin.dashboard');
            if ($user->role === 'company') return redirect()->route('company.dashboard');
            return redirect()->route('front.home');
        }

        return back()->withErrors(['email' => 'Invalid credentials.'])->onlyInput('email');
    }

    public function showRegister() { return view('auth.register'); }

    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
            'phone' => 'nullable|string|max:50',
        ]);
        $data['password'] = Hash::make($data['password']);
        $data['role'] = 'customer';
        User::create($data);
        Auth::attempt(['email' => $request->email, 'password' => $request->password]);
        return redirect()->route('front.home')->with('success', 'Account created successfully!');
    }

    public function showCompanyRegister()
    {
        $states = \App\Models\State::orderBy('name')->get();
        return view('auth.register_company', compact('states'));
    }

    public function companyRegister(Request $request)
    {
        $request->validate([
            // Owner Account Fields
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            
            // Company Business Fields
            'company_name' => 'required|string|max:255',
            'company_email' => 'required|email|unique:companies,email',
            'phone' => 'required|string|max:50',
            'website' => 'nullable|url|max:255',
            'state_id' => 'required|exists:states,id',
            'city' => 'required|string|max:120',
            'address_line1' => 'required|string|max:255',
            
            // Credentials & Logo
            'mc_number' => 'nullable|string|max:120',
            'dot_number' => 'nullable|string|max:120',
            'logo' => 'nullable|image|max:2048', // Max 2MB image
        ]);

        // 1. Create Associated User
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'role' => 'company',
        ]);

        // 2. Prepare Company Data
        $companyData = [
            'name' => $request->company_name,
            'email' => $request->company_email,
            'phone' => $request->phone,
            'website' => $request->website,
            'state_id' => $request->state_id,
            'city' => $request->city,
            'address_line1' => $request->address_line1,
            'mc_number' => $request->mc_number,
            'dot_number' => $request->dot_number,
            'status' => 'pending', // Pending approval
            'is_active' => false,  // Hidden until approved
            'is_lead_active' => true,
            'country_id' => \App\Models\Country::where('iso2', 'US')->first()->id ?? (\App\Models\Country::first()->id ?? null),
            'slug' => \Illuminate\Support\Str::slug($request->company_name . '-' . rand(100, 999)),
        ];

        // Map service types
        $services = $request->input('services', []);
        $companyData['service_type'] = implode(',', $services);

        if ($request->hasFile('logo')) {
            $logoDir = public_path('storage/companies');
            if (!file_exists($logoDir)) {
                @mkdir($logoDir, 0755, true);
            }
            $companyData['logo'] = $request->file('logo')->store('companies', 'public');
        }

        $user->company()->create($companyData);

        Auth::login($user);
        return redirect()->route('company.dashboard')->with('success', 'Your company listing has been registered and is pending admin approval.');
    }

    public function showForgotPassword() { return view('auth.forgot_password'); }

    public function forgotPassword(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        return back()->with('success', 'If an account exists, a password reset link has been sent.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('front.home');
    }
}
