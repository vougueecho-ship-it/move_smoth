<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\State;

class StateContentSeeder extends Seeder
{
    public function run(): void
    {
        $statesData = [
            'TX' => [
                'heading' => 'Trusted Moving Company in Texas',
                'meta_title' => 'Top 10 Moving Companies in Texas | Reviews & Quotes',
                'meta_description' => 'Compare licensed moving companies in Texas. View real ratings and request free moving quotes from verified Texas movers.',
                'content' => '<h3>Looking for the Best Movers in Texas?</h3>
<p>Relocating within or out of the Lone Star State? Whether you are transitioning to a metropolitan corporate hub in Dallas, moving a residential family home in Houston, or settling down in a vibrant condo in Austin, <strong>Move Smooth</strong> is your premier gateway to connecting with licensed, insured <strong>moving companies in Texas</strong>.</p>
<h4>Statewide Coverage from El Paso to Houston</h4>
<p>Texas is massive, and crossing its vast state highways demands experienced professionals who hold registered operating authorities. Our network connects you with verified <strong>movers in Texas</strong> who specialize in navigating long-distance state routes. We cover major metropolitan hubs and surrounding suburbs, including:
<ul>
  <li><strong>Houston & Harris County:</strong> Full-service apartment moving and corporate relocations.</li>
  <li><strong>Dallas-Fort Worth Metroplex:</strong> Precision IT server migrations and cubicle installations.</li>
  <li><strong>Austin & Central Texas:</strong> Compassionate senior moving and custom wood crating services.</li>
  <li><strong>San Antonio:</strong> Heavy furniture logistics including safe, pool table, and piano transport.</li>
</ul>
</p>
<h4>Why Choose Our Vetted Texas Partners?</h4>
<p>All residential and commercial relocations coordinated through our platform are handled by state-licensed operators who hold USDOT registrations. We prioritize your cargo safety by enforcing transparent pricing policies, complete transit insurance protections, and drug-tested, background-checked crews for maximum peace of mind. Get a free, no-obligation quote today!</p>',
            ],
            'CA' => [
                'heading' => 'Trusted Moving Company in California',
                'meta_title' => 'Top 10 Moving Companies in California | Reviews & Quotes',
                'meta_description' => 'Compare licensed moving companies in California. View real ratings and request free moving quotes from verified California movers.',
                'content' => '<h3>Looking for the Best Movers in California?</h3>
<p>Planning a relocation across the Golden State? Whether you are coordinating an office transition in Silicon Valley, moving a family home in San Diego, or packing up an apartment in Los Angeles, <strong>Move Smooth</strong> connects you with fully certified <strong>moving companies in California</strong>.</p>
<h4>Serving Southern, Central, and Northern California</h4>
<p>From the narrow streets of San Francisco to the sprawling highway corridors of Southern California, navigating the state demands expert logistics. Our network of premium <strong>movers in California</strong> is equipped to handle:
<ul>
  <li><strong>Los Angeles & Orange County:</strong> Turnkey high-rise apartment relocations and freight elevator bookings.</li>
  <li><strong>San Francisco Bay Area:</strong> Modular cubicle setups and sensitive corporate IT migrations.</li>
  <li><strong>San Diego:</strong> Climate-controlled Storage-in-Transit (SIT) for household goods.</li>
  <li><strong>Sacramento:</strong> Express long-haul interstate moving crossing state borders.</li>
</ul>
</p>
<h4>Maximum Safety & Professional Vetting</h4>
<p>California relocations are fully insured and bonded. Every moving crew in our CA database holds active PUC/DOT certifications and workers\' compensation coverages. We eliminate the risk of hidden fees by providing guaranteed written hourly rates for local moves and weight-based binding tariff quotes for long-distance relocations. Calculate your costs now!</p>',
            ],
            'FL' => [
                'heading' => 'Trusted Moving Company in Florida',
                'meta_title' => 'Top 10 Moving Companies in Florida | Reviews & Quotes',
                'meta_description' => 'Compare licensed moving companies in Florida. View real ratings and request free moving quotes from verified Florida movers.',
                'content' => '<h3>Looking for the Best Movers in Florida?</h3>
<p>Relocating to the Sunshine State? Whether you are downsizing to a retirement community in Tampa, moving a beachfront home in Miami, or shifting corporate assets in Orlando, <strong>Move Smooth</strong> matches you with fully licensed <strong>moving companies in Florida</strong>.</p>
<h4>Statewide Relocations from Jacksonville to Key West</h4>
<p>Spanning thousands of miles of coastal roads and busy metropolitan corridors, Florida moves demand experienced operators who understand hot weather packing standards. Our certified <strong>movers in Florida</strong> offer:
<ul>
  <li><strong>Miami & Fort Lauderdale:</strong> Specialized luxury residential pack-ups and secure records holdings.</li>
  <li><strong>Orlando Metro:</strong> Turnkey business office transitions and heavy asset storage vaults.</li>
  <li><strong>Tampa Bay Area:</strong> Compassionate senior moving and detailed downsizing labeling guides.</li>
  <li><strong>Jacksonville:</strong> Interstate long-distance logistics and GPS delivery tracking.</li>
</ul>
</p>
<h4>Verified Florida Moving Logistics</h4>
<p>Every Florida network partner is fully registered with the FDACS and USDOT. We protect your household items with double-walled boxes, custom padding sheets, and clean furniture blankets. Get binding written estimates and avoid moving day surprises!</p>',
            ],
            'NY' => [
                'heading' => 'Trusted Moving Company in New York',
                'meta_title' => 'Top 10 Moving Companies in New York | Reviews & Quotes',
                'meta_description' => 'Compare licensed moving companies in New York. View real ratings and request free moving quotes from verified New York movers.',
                'content' => '<h3>Looking for the Best Movers in New York?</h3>
<p>Moving within the Empire State? From high-rise apartment staircases in Manhattan to single-family houses in upstate New York, <strong>Move Smooth</strong> connects you with fully certified, experienced <strong>moving companies in New York</strong>.</p>
<h4>Navigating NYC, Long Island, and Upstate Regions</h4>
<p>New York present unique architectural obstacles including walkups, tight elevators, and strict parking guidelines. Our vetted <strong>movers in New York</strong> excel in:
<ul>
  <li><strong>New York City:</strong> Full COI coverage for skyscrapers, walkups, and freight reservations.</li>
  <li><strong>Long Island:</strong> Family house moves, packing services, and heavy furniture handling.</li>
  <li><strong>Albany & Upstate:</strong> Cold weather packing protections and interstate logistics.</li>
  <li><strong>Buffalo & Rochester:</strong> Fast, safe long-distance cross-country relocations.</li>
</ul>
</p>
<h4>Secure & Fully Bonded Logistics</h4>
<p>Our NY moving partners hold active NYSDOT operating credentials. We eliminate standard stress factors by providing transparent billing logs and dedicated move coordinators. Receive a free estimate range today!</p>',
            ],
            'IL' => [
                'heading' => 'Trusted Moving Company in Illinois',
                'meta_title' => 'Top 10 Moving Companies in Illinois | Reviews & Quotes',
                'meta_description' => 'Compare licensed moving companies in Illinois. View real ratings and request free moving quotes from verified Illinois movers.',
                'content' => '<h3>Looking for the Best Movers in Illinois?</h3>
<p>Relocating within the Land of Lincoln? Whether moving an apartment in downtown Chicago or a corporate warehouse in Springfield, <strong>Move Smooth</strong> matches you with certified <strong>moving companies in Illinois</strong>.</p>
<h4>Vetted Services from Chicago to Peoria</h4>
<p>From high-rise loading dock protocols in the Windy City to rural farm estates, our network of experienced <strong>movers in Illinois</strong> covers:
<ul>
  <li><strong>Chicago Metro:</strong> Freight elevator bookings, HOA compliant packing, and building COIs.</li>
  <li><strong>Naperville & Suburbs:</strong> Single-family residential house moving and decluttering guides.</li>
  <li><strong>Springfield:</strong> State-licensed commercial office relocations and modular assembly.</li>
</ul>
</p>
<h4>HIPAA-Compliant Corporate & Home Logistics</h4>
<p>All IL moving crews are thoroughly background-checked, drug-tested, and fully insured. Get binding written price estimates to keep your budget safe!</p>',
            ],
            'GA' => [
                'heading' => 'Trusted Moving Company in Georgia',
                'meta_title' => 'Top 10 Moving Companies in Georgia | Reviews & Quotes',
                'meta_description' => 'Compare licensed moving companies in Georgia. View real ratings and request free moving quotes from verified Georgia movers.',
                'content' => '<h3>Looking for the Best Movers in Georgia?</h3>
<p>Planning a relocation in the Peach State? From bustling corporate office hubs in Atlanta to quiet family suburbs in Savannah, <strong>Move Smooth</strong> connects you with licensed <strong>moving companies in Georgia</strong>.</p>
<h4>Atlanta, Savannah, and Augusta Services</h4>
<p>Our network of professional <strong>movers in Georgia</strong> is fully equipped to handle:
<ul>
  <li><strong>Atlanta Metro:</strong> Turnkey office relocations, IT server setups, and high-rise walkups.</li>
  <li><strong>Savannah:</strong> Historical home moving, packing fragile antiques, and custom wood crating.</li>
  <li><strong>Augusta:</strong> Climate-controlled Storage-in-Transit (SIT) and local loading helpers.</li>
</ul>
</p>
<h4>Fully Insured Georgia Movers</h4>
<p>All GA network partners hold active GPS logistics fleets and standard FMCSA registrations. Secure your flat hourly rates or binding mileage estimates today!</p>',
            ],
            'NC' => [
                'heading' => 'Trusted Moving Company in North Carolina',
                'meta_title' => 'Top 10 Moving Companies in North Carolina | Reviews & Quotes',
                'meta_description' => 'Compare licensed moving companies in North Carolina. View real ratings and request free moving quotes from verified North Carolina movers.',
                'content' => '<h3>Looking for the Best Movers in North Carolina?</h3>
<p>Moving within or out of North Carolina? From the tech hub of the Research Triangle to coastal Wilmington, <strong>Move Smooth</strong> matches you with verified <strong>moving companies in North Carolina</strong>.</p>
<h4>Charlotte, Raleigh-Durham, and Greensboro Coverage</h4>
<p>Our experienced <strong>movers in North Carolina</strong> specialize in:
<ul>
  <li><strong>Charlotte:</strong> Corporate financial headquarters relocations, cubicles, and server migration.</li>
  <li><strong>Raleigh-Durham (Triangle):</strong> Residential house moves, academic apartment shifting, and packing.</li>
  <li><strong>Wilmington & Coast:</strong> Climate-controlled holding vaults and fragile protection wrap.</li>
</ul>
</p>
<h4>Secure Nationwide Written Quotes</h4>
<p>All NC partners are fully insured, USDOT registered, and background-checked for absolute safety. Get a free, no-obligation moving quote now!</p>',
            ],
            'OH' => [
                'heading' => 'Trusted Moving Company in Ohio',
                'meta_title' => 'Top 10 Moving Companies in Ohio | Reviews & Quotes',
                'meta_description' => 'Compare licensed moving companies in Ohio. View real ratings and request free moving quotes from verified Ohio movers.',
                'content' => '<h3>Looking for the Best Movers in Ohio?</h3>
<p>Moving across the Buckeye State? Whether transitioning an apartment in Columbus, a family home in Cleveland, or a commercial office in Cincinnati, <strong>Move Smooth</strong> connects you with certified <strong>moving companies in Ohio</strong>.</p>
<h4>Columbus, Cleveland, and Cincinnati Coverage</h4>
<p>Our vetted network of premium <strong>movers in Ohio</strong> offers:
<ul>
  <li><strong>Columbus:</strong> Fast apartment moves, student relocation guides, and packing services.</li>
  <li><strong>Cleveland:</strong> Single-family house moving, heavy safe loading, and basement cleaning.</li>
  <li><strong>Cincinnati:</strong> Modular office cubicle installation and records warehouse management.</li>
</ul>
</p>
<h4>Top-Tier Security & Safe Transit</h4>
<p>All Ohio movers are fully background-checked, drug-tested, and hold active USDOT credentials. Get binding cost estimates today!</p>',
            ],
            'CO' => [
                'heading' => 'Trusted Moving Company in Colorado',
                'meta_title' => 'Top 10 Moving Companies in Colorado | Reviews & Quotes',
                'meta_description' => 'Compare licensed moving companies in Colorado. View real ratings and request free moving quotes from verified Colorado movers.',
                'content' => '<h3>Looking for the Best Movers in Colorado?</h3>
<p>Relocating to or within the beautiful Centennial State? Whether you are moving a high-rise apartment in downtown Denver, relocating a corporate headquarters in Colorado Springs, or packing up a student condo in Boulder, <strong>Move Smooth</strong> connects you with fully certified <strong>moving companies in Colorado</strong>.</p>
<h4>Serving Denver, Colorado Springs, Boulder, and Beyond</h4>
<p>From the high-altitude mountain passes of the Rockies to busy urban streets, moving in Colorado demands specialized logistics and extreme weather awareness. Our vetted network of <strong>movers in Colorado</strong> excels in:
<ul>
  <li><strong>Denver Metro:</strong> Full-service apartment moving, skyscraper COI compliance, and freight bookings.</li>
  <li><strong>Colorado Springs:</strong> Large residential family moves, military relocations, and secure storage solutions.</li>
  <li><strong>Boulder & Fort Collins:</strong> Student packing services, eco-friendly relocations, and loading assistance.</li>
</ul>
</p>
<h4>Altitude Packing & Complete Transit Safety</h4>
<p>Colorado relocations are managed by fully background-checked, licensed, and bonded professionals. We ensure complete cargo protection using double-walled boxes, custom wood crating, and climate-controlled Storage-in-Transit (SIT) options to handle weather delays. Get your free moving cost estimate now!</p>',
            ],
            'MI' => [
                'heading' => 'Trusted Moving Company in Michigan',
                'meta_title' => 'Top 10 Moving Companies in Michigan | Reviews & Quotes',
                'meta_description' => 'Compare licensed moving companies in Michigan. View real ratings and request free moving quotes from verified Michigan movers.',
                'content' => '<h3>Looking for the Best Movers in Michigan?</h3>
<p>Moving within the Great Lakes State? Whether relocating a loft in Detroit or a house in Grand Rapids, <strong>Move Smooth</strong> connects you with fully vetted <strong>moving companies in Michigan</strong>.</p>
<h4>Detroit, Grand Rapids, and Ann Arbor Services</h4>
<p>Our network of professional <strong>movers in Michigan</strong> covers:
<ul>
  <li><strong>Detroit Metro:</strong> Industrial warehouse relocations, office cubicle assembly, and heavy loading.</li>
  <li><strong>Grand Rapids:</strong> Residential house moving, packing materials supply, and senior moving care.</li>
  <li><strong>Ann Arbor:</strong> Student apartment moves, fragile wrapping, and secure short-term storage.</li>
</ul>
</p>
<h4>Maximum Safety & Transparent Rates</h4>
<p>All MI moving partners hold registered active operating credentials. Protect your valuables with our certified teams. Request a free quote!</p>',
            ],
            'WA' => [
                'heading' => 'Trusted Moving Company in Washington',
                'meta_title' => 'Top 10 Moving Companies in Washington | Reviews & Quotes',
                'meta_description' => 'Compare licensed moving companies in Washington. View real ratings and request free moving quotes from verified Washington movers.',
                'content' => '<h3>Looking for the Best Movers in Washington State?</h3>
<p>Moving in the Pacific Northwest? From metropolitan high-rises in Seattle to quiet suburbs in Spokane, <strong>Move Smooth</strong> matches you with fully licensed <strong>moving companies in Washington</strong>.</p>
<h4>Seattle, Tacoma, and Spokane Coverage</h4>
<p>Our premium network of <strong>movers in Washington</strong> handles:
<ul>
  <li><strong>Seattle & Bellevue:</strong> Full-service corporate IT migrations, modular cubicles, and skyscraper COIs.</li>
  <li><strong>Tacoma:</strong> Turnkey house packing, heavy furniture hoisting, and local loading helpers.</li>
  <li><strong>Spokane:</strong> Climate-controlled storage SIT and long-distance cross-country transport.</li>
</ul>
</p>
<h4>Premium Rain-Protected Packing Standards</h4>
<p>Washington state moves include weather-resistant plastic wraps and double-taped boxes for rainy transit. Secure your binding quote today!</p>',
            ],
            'AZ' => [
                'heading' => 'Trusted Moving Company in Arizona',
                'meta_title' => 'Top 10 Moving Companies in Arizona | Reviews & Quotes',
                'meta_description' => 'Compare licensed moving companies in Arizona. View real ratings and request free moving quotes from verified Arizona movers.',
                'content' => '<h3>Looking for the Best Movers in Arizona?</h3>
<p>Moving in the Grand Canyon State? From hot desert valleys in Phoenix to high altitudes in Flagstaff, <strong>Move Smooth</strong> matches you with fully licensed <strong>moving companies in Arizona</strong>.</p>
<h4>Phoenix, Tucson, and Mesa Services</h4>
<p>Our vetted network of professional <strong>movers in Arizona</strong> specializes in:
<ul>
  <li><strong>Phoenix Metro:</strong> Multi-story apartment moving, heavy appliance setup, and packing.</li>
  <li><strong>Tucson:</strong> Compassionate senior moving, downsizing packing guides, and fragile crating.</li>
  <li><strong>Flagstaff:</strong> Mountain transit logistics and local/long-distance express trucks.</li>
</ul>
</p>
<h4>Heat-Resistant Packing & Transit Safety</h4>
<p>All AZ partners utilize heat-protected, ventilated transit vehicles to secure electronics and delicate wood furniture. Estimate your budget instantly!</p>',
            ],
        ];

        foreach ($statesData as $code => $data) {
            State::updateOrCreate(['code' => $code], [
                'heading' => $data['heading'],
                'meta_title' => $data['meta_title'],
                'meta_description' => $data['meta_description'],
                'content' => $data['content'],
                'is_active' => true,
            ]);
        }

        $this->command->info('State content seeder for 12 major states run successfully!');
    }
}
