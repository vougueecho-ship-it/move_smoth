<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Company extends Model
{
    protected $fillable = [
        'user_id', 'name', 'slug', 'email', 'phone', 'website', 'address_line1', 'address_line2', 
        'city', 'state_id', 'country_id', 'zip', 'description', 'status', 'rating', 'logo', 
        'dot_number', 'mc_number', 'license_number', 'service_type', 'is_active', 'is_lead_active', 'is_claimed', 'claimed_by_user_id',
        'meta_title', 'meta_description'
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($company) {
            if (empty($company->slug)) $company->slug = Str::slug($company->name);
        });
    }

    public function owner() { return $this->belongsTo(User::class, 'user_id'); }
    public function state() { return $this->belongsTo(State::class); }
    public function country() { return $this->belongsTo(Country::class); }
    public function reviews() { return $this->hasMany(Review::class); }
    public function claims() { return $this->hasMany(CompanyClaim::class); }
    public function leads() { return $this->hasMany(ContactMoverLead::class); }
    public function quoteLeads() { return $this->hasMany(Lead::class); }

    public function averageRating(): float
    {
        $avg = $this->reviews()->where('status', 'approved')->avg('rating');
        return $avg ? round((float)$avg, 1) : 0.0;
    }

    public function getAddressAttribute(): ?string
    {
        return $this->address_line1;
    }

    public function getZipCodeAttribute(): ?string
    {
        return $this->zip;
    }

    public function getUsdotNumberAttribute(): ?string
    {
        return $this->dot_number;
    }

    public function getMetaTitleAttribute(): string
    {
        $manualTitle = $this->getRawOriginal('meta_title');
        if (!empty($manualTitle)) {
            return $manualTitle;
        }

        $location = '';
        if ($this->city) {
            $location .= $this->city;
        }
        if ($this->state) {
            $location .= ($location ? ', ' : '') . ($this->state->code ?? $this->state->name);
        }
        $locationStr = $location ?: 'US';

        $ratingVal = (float)$this->rating;
        $hasRating = $ratingVal > 0;
        
        $id = $this->id ?: 1;
        $pattern = $id % 3;

        if ($pattern === 0) {
            if ($hasRating) {
                return "{$this->name} - Movers in {$locationStr} | {$ratingVal} Star Reviews & Quotes";
            }
            return "{$this->name} - Movers in {$locationStr} | Free Moving Quotes";
        } elseif ($pattern === 1) {
            if ($hasRating) {
                return "Best Movers in {$locationStr}: {$this->name} | Reviews & Pricing";
            }
            return "Top Movers in {$locationStr} | {$this->name} Relocation Services";
        } else {
            if ($this->dot_number) {
                return "{$this->name} | {$locationStr} Moving Services & USDOT #{$this->dot_number}";
            }
            return "{$this->name} | {$locationStr} Local & Long Distance Movers";
        }
    }

    public function getMetaDescriptionAttribute(): string
    {
        $manualDesc = $this->getRawOriginal('meta_description');
        if (!empty($manualDesc)) {
            return $manualDesc;
        }

        $location = '';
        if ($this->city) {
            $location .= $this->city;
        }
        if ($this->state) {
            $location .= ($location ? ', ' : '') . ($this->state->name ?? $this->state->code);
        }
        $locationStr = $location ?: 'your area';

        // Parse services
        $services = [];
        $serviceTypes = explode(',', $this->service_type ?: '');
        foreach ($serviceTypes as $s) {
            $s = trim($s);
            if ($s === 'local') $services[] = 'local moving';
            if ($s === 'long_distance') $services[] = 'long-distance relocation';
            if ($s === 'commercial') $services[] = 'commercial office moves';
            if ($s === 'storage') $services[] = 'storage solutions';
        }
        $servicesStr = !empty($services) ? implode(', ', $services) : 'professional relocation';

        // Rating & reviews
        $reviewCount = $this->reviews->where('status', 'approved')->count();
        $ratingVal = (float)$this->rating;
        if ($ratingVal > 0 && $reviewCount > 0) {
            $reviewsStr = "Rated {$ratingVal}/5 stars based on {$reviewCount} verified customer reviews.";
        } else {
            $reviewsStr = "Read verified customer reviews, licensing details, and service info.";
        }

        $dotStr = $this->dot_number ? " (USDOT #{$this->dot_number})" : "";
        $licensingStr = $this->dot_number ? "licensed under USDOT #{$this->dot_number}" : "fully licensed and insured";

        $id = $this->id ?: 1;
        $pattern = $id % 3;

        if ($pattern === 0) {
            return "Looking for trusted movers in {$locationStr}? {$reviewsStr} Get a free, no-obligation moving quote from {$this->name} today!";
        } elseif ($pattern === 1) {
            return "Get verified details for {$this->name} in {$locationStr}{$dotStr}. Check customer ratings, service options, and contact information. Fast, stress-free moving quotes!";
        } else {
            return "Hire professional movers from {$this->name} in {$locationStr}. Specializing in {$servicesStr}. Fully {$licensingStr} for a safe, smooth relocation. Request your free estimate now!";
        }
    }

    public function getLogoUrlAttribute(): ?string
    {
        if ($this->logo) {
            return asset('storage/' . $this->logo);
        }
        
        // Auto fallback to slug-based filename inside the public companies storage
        $slug = $this->slug ?: Str::slug($this->name);
        $extensions = ['png', 'jpg', 'jpeg', 'webp'];
        foreach ($extensions as $ext) {
            $filename = "companies/{$slug}.{$ext}";
            if (file_exists(public_path('storage/' . $filename))) {
                return asset('storage/' . $filename);
            }
        }
        
        return null;
    }
}
