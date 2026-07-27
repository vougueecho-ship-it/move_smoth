<?php
namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Company;
use App\Models\Lead;
use App\Models\Review;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $company = Auth::user()->company;
        $leadsCount = $company ? Lead::where('company_id', $company->id)->count() : 0;
        $reviewsCount = $company ? Review::where('company_id', $company->id)->count() : 0;
        return view('company.dashboard', compact('company','leadsCount','reviewsCount'));
    }

    public function profile()
    {
        $company = Auth::user()->company;
        $states = \App\Models\State::orderBy('name')->get();
        return view('company.profile', compact('company','states'));
    }

    public function profileUpdate(Request $request)
    {
        $company = Auth::user()->company;
        $company->update($request->all());
        return back()->with('success', 'Profile updated.');
    }

    public function leads()
    {
        $company = Auth::user()->company;
        $leads = $company ? Lead::where('company_id', $company->id)->latest()->paginate(20) : collect();
        return view('company.leads', compact('leads'));
    }

    public function reviews()
    {
        $company = Auth::user()->company;
        $reviews = $company ? Review::where('company_id', $company->id)->latest()->paginate(20) : collect();
        return view('company.reviews', compact('reviews'));
    }

    public function analytics()
    {
        $company = Auth::user()->company;
        return view('company.analytics', compact('company'));
    }

    public function billing()
    {
        $company = Auth::user()->company;
        return view('company.billing', compact('company'));
    }
}
