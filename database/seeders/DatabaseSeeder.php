<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\Company;
use App\Models\Review;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Create Admin
        User::updateOrCreate(['email' => 'admin@movesmooth.com'], [
            'name' => 'Admin User',
            'password' => Hash::make('password'),
            'is_admin' => true,
            'role' => 'admin',
        ]);

        // 2. Create Country
        $country = Country::firstOrCreate(['iso2' => 'US'], ['name' => 'United States']);

        // 3. Create States (All 50 US States + Washington D.C.)
        $statesData = [
            ['name' => 'Alabama', 'code' => 'AL'],
            ['name' => 'Alaska', 'code' => 'AK'],
            ['name' => 'Arizona', 'code' => 'AZ'],
            ['name' => 'Arkansas', 'code' => 'AR'],
            ['name' => 'California', 'code' => 'CA'],
            ['name' => 'Colorado', 'code' => 'CO'],
            ['name' => 'Connecticut', 'code' => 'CT'],
            ['name' => 'Delaware', 'code' => 'DE'],
            ['name' => 'District of Columbia', 'code' => 'DC'],
            ['name' => 'Florida', 'code' => 'FL'],
            ['name' => 'Georgia', 'code' => 'GA'],
            ['name' => 'Hawaii', 'code' => 'HI'],
            ['name' => 'Idaho', 'code' => 'ID'],
            ['name' => 'Illinois', 'code' => 'IL'],
            ['name' => 'Indiana', 'code' => 'IN'],
            ['name' => 'Iowa', 'code' => 'IA'],
            ['name' => 'Kansas', 'code' => 'KS'],
            ['name' => 'Kentucky', 'code' => 'KY'],
            ['name' => 'Louisiana', 'code' => 'LA'],
            ['name' => 'Maine', 'code' => 'ME'],
            ['name' => 'Maryland', 'code' => 'MD'],
            ['name' => 'Massachusetts', 'code' => 'MA'],
            ['name' => 'Michigan', 'code' => 'MI'],
            ['name' => 'Minnesota', 'code' => 'MN'],
            ['name' => 'Mississippi', 'code' => 'MS'],
            ['name' => 'Missouri', 'code' => 'MO'],
            ['name' => 'Montana', 'code' => 'MT'],
            ['name' => 'Nebraska', 'code' => 'NE'],
            ['name' => 'Nevada', 'code' => 'NV'],
            ['name' => 'New Hampshire', 'code' => 'NH'],
            ['name' => 'New Jersey', 'code' => 'NJ'],
            ['name' => 'New Mexico', 'code' => 'NM'],
            ['name' => 'New York', 'code' => 'NY'],
            ['name' => 'North Carolina', 'code' => 'NC'],
            ['name' => 'North Dakota', 'code' => 'ND'],
            ['name' => 'Ohio', 'code' => 'OH'],
            ['name' => 'Oklahoma', 'code' => 'OK'],
            ['name' => 'Oregon', 'code' => 'OR'],
            ['name' => 'Pennsylvania', 'code' => 'PA'],
            ['name' => 'Rhode Island', 'code' => 'RI'],
            ['name' => 'South Carolina', 'code' => 'SC'],
            ['name' => 'South Dakota', 'code' => 'SD'],
            ['name' => 'Tennessee', 'code' => 'TN'],
            ['name' => 'Texas', 'code' => 'TX'],
            ['name' => 'Utah', 'code' => 'UT'],
            ['name' => 'Vermont', 'code' => 'VT'],
            ['name' => 'Virginia', 'code' => 'VA'],
            ['name' => 'Washington', 'code' => 'WA'],
            ['name' => 'West Virginia', 'code' => 'WV'],
            ['name' => 'Wisconsin', 'code' => 'WI'],
            ['name' => 'Wyoming', 'code' => 'WY'],
        ];

        $popularCodes = ['CA', 'NY', 'TX', 'FL', 'IL'];

        foreach ($statesData as $sData) {
            $isPopular = in_array($sData['code'], $popularCodes);

            $state = State::firstOrCreate(['code' => $sData['code']], [
                'country_id' => $country->id,
                'name' => $sData['name'],
                'heading' => $isPopular ? 'Best Moving Companies in ' . $sData['name'] : null,
                'meta_title' => $isPopular ? 'Top 10 Moving Companies in ' . $sData['name'] . ' | Reviews & Quotes' : null,
                'meta_description' => $isPopular ? 'Compare moving companies in ' . $sData['name'] . '. View real ratings and request quotes.' : null,
                'content' => $isPopular ? '<p>Moving to ' . $sData['name'] . ' offers a diverse range of opportunities. Our network of movers here is extensive.</p>' : null,
                'is_active' => $isPopular,
            ]);

            // Only seed cities and companies for active, popular states to keep seeder fast
            if ($isPopular) {
                // Create Cities for State
                $cities = ['Metro City', 'Capital Town', 'Sunnyvale', 'Riverside'];
                foreach ($cities as $idx => $cityName) {
                    $cityFullName = $cityName . ' ' . $sData['code'];
                    $city = City::firstOrCreate(['name' => $cityFullName], [
                        'state_id' => $state->id,
                        'zip_code' => '1000' . $idx,
                    ]);

                    // Create City Content
                    $citySlug = Str::slug($cityFullName);
                    $slugExists = \App\Models\CityContent::where('slug', $citySlug)->where('city_id', '!=', $city->id)->exists();
                    if ($slugExists) {
                        $citySlug = $citySlug . '-' . $city->id;
                    }

                    \App\Models\CityContent::updateOrCreate(['city_id' => $city->id], [
                        'slug' => $citySlug,
                        'heading' => 'Best Movers in ' . $cityFullName,
                        'content' => '<p>Welcome to ' . $cityFullName . '. Find the best movers right here.</p>',
                        'is_active' => true,
                    ]);

                    // Create Companies for City
                    for ($i = 1; $i <= 3; $i++) {
                        $companyName = "Top Mover {$i} " . $cityFullName;
                        $company = Company::firstOrCreate(['name' => $companyName], [
                            'email' => strtolower("contact{$i}_{$sData['code']}@mover{$cityName}.com"),
                            'phone' => '1-800-555-' . rand(1000, 9999),
                            'city' => $cityFullName,
                            'state_id' => $state->id,
                            'country_id' => $country->id,
                            'zip' => $city->zip_code,
                            'address_line1' => "123 Main St Suite {$i}",
                            'description' => 'We are a highly rated moving company offering local and long distance services. Fully licensed and insured for your peace of mind.',
                            'status' => 'active',
                            'is_active' => true,
                            'slug' => Str::slug($companyName),
                            'dot_number' => '123456' . $i,
                        ]);

                        // Add to TopMovers if it's the first company
                        if ($i == 1) {
                            \App\Models\TopMover::updateOrCreate(['company_id' => $company->id], ['order' => $idx]);
                        }

                        // Add Reviews only if newly created (to prevent duplicate spam on re-seed)
                        if ($company->wasRecentlyCreated) {
                            for ($r = 1; $r <= 3; $r++) {
                                Review::create([
                                    'company_id' => $company->id,
                                    'name' => "Customer {$r}",
                                    'email' => "cust{$r}@example.com",
                                    'rating' => rand(4, 5),
                                    'title' => 'Great Experience',
                                    'review' => 'The crew was very professional and handled our belongings with care. Highly recommend!',
                                    'status' => 'approved'
                                ]);
                            }
                        }
                    }
                }
            }
        }
        
        // Blog Categories
        $categories = ['Moving Tips', 'Packing Guides', 'City Guides'];
        foreach($categories as $cat) {
            \App\Models\BlogCategory::firstOrCreate(['name' => $cat], ['slug' => Str::slug($cat)]);
        }
        // 5. Checklist Data
        $checklistCat = \App\Models\ChecklistCategory::firstOrCreate(['slug' => 'moving-essentials'], [
            'name' => 'Moving Essentials',
            'description' => 'Everything you need to prepare for your move.'
        ]);

        \App\Models\ChecklistItem::firstOrCreate(['title' => 'Hire Movers'], [
            'checklist_category_id' => $checklistCat->id,
            'content' => 'Research and book a professional moving company at least 4 weeks in advance.',
            'order' => 1
        ]);

        \App\Models\ChecklistItem::firstOrCreate(['title' => 'Declutter Home'], [
            'checklist_category_id' => $checklistCat->id,
            'content' => 'Sell or donate items you no longer need to reduce moving costs.',
            'order' => 2
        ]);

        $this->call(StateContentSeeder::class);
    }
}
