<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\City;
use App\Models\State;
use App\Models\CityContent;

class CityContentSeeder extends Seeder
{
    public function run(): void
    {
        $citiesData = [
            // ============ TEXAS (TX) ============
            'TX' => [
                [
                    'name' => 'Houston', 'zip_code' => '77001', 'latitude' => 29.7604, 'longitude' => -95.3698,
                    'slug' => 'movers-in-houston',
                    'meta_title' => 'Movers in Houston | Move Smooth Moving Company',
                    'meta_description' => 'Looking for reliable movers in Houston? Move Smooth provides affordable local and long-distance moving services with verified, licensed professionals.',
                    'heading' => 'Professional Movers in Houston',
                    'content' => '<h3>Top-Rated Moving Services in Houston, TX</h3>
<p>Houston is the fourth-largest city in the United States, and its sprawling metropolitan area demands experienced moving professionals who understand I-10 corridors, inner-loop neighborhoods, and suburban developments across Harris County. <strong>Move Smooth</strong> connects you with fully licensed <strong>movers in Houston</strong> who specialize in both residential and commercial relocations.</p>
<h4>Local Moving Services in Houston</h4>
<p>Whether you\'re relocating from a Midtown apartment to a Heights bungalow or moving your family from Katy to Sugar Land, our verified Houston movers offer hourly-rate local moving with transparent pricing. Services include furniture disassembly, appliance disconnection, and same-day delivery.</p>
<h4>Long Distance Moving from Houston</h4>
<p>Planning an interstate move from Houston? Our FMCSA-licensed long-distance carriers handle cross-country relocations with GPS-tracked fleets, guaranteed delivery windows, and binding written estimates. Popular routes include Houston to Dallas, Houston to Austin, and Houston to Atlanta.</p>
<h4>Commercial Moving in Houston</h4>
<p>Houston\'s Energy Corridor and Texas Medical Center house thousands of businesses requiring specialized office relocations. Our commercial movers handle server rooms, cubicle systems, medical equipment, and sensitive document transfers with zero-downtime weekend scheduling.</p>
<h4>Why Choose Move Smooth in Houston?</h4>
<ul>
<li><strong>FMCSA Verified:</strong> Every Houston mover holds active USDOT registration and cargo insurance.</li>
<li><strong>Transparent Pricing:</strong> No hidden fees — receive binding written estimates before your move.</li>
<li><strong>Full-Service Packing:</strong> Professional packers using double-walled boxes and custom crating.</li>
<li><strong>Climate-Controlled Storage:</strong> Secure warehouse vaults for short-term and long-term needs.</li>
</ul>',
                ],
                [
                    'name' => 'Dallas', 'zip_code' => '75201', 'latitude' => 32.7767, 'longitude' => -96.7970,
                    'slug' => 'movers-in-dallas',
                    'meta_title' => 'Movers in Dallas | Move Smooth Moving Company',
                    'meta_description' => 'Looking for reliable movers in Dallas? Move Smooth connects you with licensed, insured Dallas moving companies for local and long-distance moves.',
                    'heading' => 'Professional Movers in Dallas',
                    'content' => '<h3>Trusted Moving Companies in Dallas, TX</h3>
<p>Dallas sits at the heart of the DFW Metroplex, one of the fastest-growing metro areas in America. From luxury Uptown condos to sprawling family estates in Plano and Frisco, <strong>Move Smooth</strong> connects you with top-rated <strong>movers in Dallas</strong> for every type of relocation.</p>
<h4>Local Moving Services in Dallas</h4>
<p>Our Dallas movers handle apartment moves, townhouse relocations, and single-family home transitions with professional loading crews, furniture padding, and floor protection. Hourly rates are locked in advance with no surprise charges.</p>
<h4>Long Distance Moving from Dallas</h4>
<p>Dallas is a major interstate hub. Our licensed carriers coordinate cross-country moves with dedicated trucks, GPS tracking, and guaranteed delivery schedules. Top routes include Dallas to Houston, Dallas to Chicago, and Dallas to Denver.</p>
<h4>Why Choose Move Smooth in Dallas?</h4>
<ul>
<li><strong>Verified Professionals:</strong> Background-checked, drug-tested crews with active USDOT numbers.</li>
<li><strong>Free Estimates:</strong> Use our Moving Cost Calculator for instant price ranges.</li>
<li><strong>Weekend Availability:</strong> Saturday and Sunday moving slots for your convenience.</li>
</ul>',
                ],
                [
                    'name' => 'Austin', 'zip_code' => '78701', 'latitude' => 30.2672, 'longitude' => -97.7431,
                    'slug' => 'movers-in-austin',
                    'meta_title' => 'Movers in Austin | Move Smooth Moving Company',
                    'meta_description' => 'Find the best movers in Austin, TX. Move Smooth connects you with licensed local and long-distance moving companies in Austin.',
                    'heading' => 'Professional Movers in Austin',
                    'content' => '<h3>Best Moving Companies in Austin, TX</h3>
<p>Austin\'s rapid growth and vibrant culture make it one of America\'s hottest relocation destinations. Whether you\'re moving to East Austin, settling in Cedar Park, or relocating a tech startup in the Domain, <strong>Move Smooth</strong> connects you with reliable <strong>movers in Austin</strong>.</p>
<h4>Local Moving in Austin</h4>
<p>Navigate Austin\'s unique neighborhoods with movers who know the city inside out. From narrow South Congress streets to new-build developments in Round Rock, our crews handle loading, transport, and unloading with care.</p>
<h4>Why Choose Move Smooth in Austin?</h4>
<ul>
<li><strong>Eco-Friendly Options:</strong> Reusable moving bins and sustainable packing materials available.</li>
<li><strong>Student Specials:</strong> Affordable rates for UT Austin and ACC student moves.</li>
<li><strong>Tech Company Moves:</strong> Specialized IT equipment handling and server room relocations.</li>
</ul>',
                ],
            ],

            // ============ CALIFORNIA (CA) ============
            'CA' => [
                [
                    'name' => 'Los Angeles', 'zip_code' => '90001', 'latitude' => 34.0522, 'longitude' => -118.2437,
                    'slug' => 'movers-in-los-angeles',
                    'meta_title' => 'Movers in Los Angeles | Move Smooth Moving Company',
                    'meta_description' => 'Looking for reliable movers in Los Angeles? Move Smooth provides affordable local and long-distance moving services across LA County.',
                    'heading' => 'Professional Movers in Los Angeles',
                    'content' => '<h3>Top Moving Companies in Los Angeles, CA</h3>
<p>Los Angeles is the second-largest city in America, and its complex freeway system, high-rise buildings, and diverse neighborhoods demand experienced moving professionals. <strong>Move Smooth</strong> connects you with fully licensed <strong>movers in Los Angeles</strong> who navigate LA\'s unique challenges daily.</p>
<h4>Local Moving in LA</h4>
<p>From Hollywood Hills estates to Santa Monica beachfront apartments, our LA movers handle every type of residential move. Services include high-rise elevator bookings, HOA coordination, and parking permit assistance.</p>
<h4>Long Distance Moving from Los Angeles</h4>
<p>Popular interstate routes from LA include Los Angeles to San Francisco, LA to Phoenix, and LA to Las Vegas. All long-distance moves include GPS tracking and binding estimates.</p>
<h4>Why Choose Move Smooth in Los Angeles?</h4>
<ul>
<li><strong>CA PUC Licensed:</strong> All movers hold active California Public Utilities Commission permits.</li>
<li><strong>High-Rise Specialists:</strong> COI preparation and freight elevator scheduling included.</li>
<li><strong>Climate-Controlled Storage:</strong> Secure facilities across LA County.</li>
</ul>',
                ],
                [
                    'name' => 'San Francisco', 'zip_code' => '94102', 'latitude' => 37.7749, 'longitude' => -122.4194,
                    'slug' => 'movers-in-san-francisco',
                    'meta_title' => 'Movers in San Francisco | Move Smooth Moving Company',
                    'meta_description' => 'Find trusted movers in San Francisco. Move Smooth connects you with verified local and long-distance moving companies in the Bay Area.',
                    'heading' => 'Professional Movers in San Francisco',
                    'content' => '<h3>Reliable Moving Services in San Francisco, CA</h3>
<p>San Francisco\'s iconic hills, narrow Victorian streets, and strict building regulations make moving uniquely challenging. <strong>Move Smooth</strong> connects you with <strong>movers in San Francisco</strong> who specialize in navigating the city\'s architectural quirks.</p>
<h4>Local Moving in San Francisco</h4>
<p>Our SF movers handle walkup apartments, Victorian flats, and SOMA condos with specialized stair-climbing dollies and building-compliant padding. Parking permits and COI documents are arranged in advance.</p>
<h4>Why Choose Move Smooth in San Francisco?</h4>
<ul>
<li><strong>Hill Navigation Experts:</strong> Crews experienced with steep San Francisco grades.</li>
<li><strong>Tech Office Moves:</strong> Specialized SOMA and FiDi corporate relocations.</li>
<li><strong>Eco-Friendly Packing:</strong> Sustainable materials for environmentally conscious Bay Area residents.</li>
</ul>',
                ],
            ],

            // ============ FLORIDA (FL) ============
            'FL' => [
                [
                    'name' => 'Miami', 'zip_code' => '33101', 'latitude' => 25.7617, 'longitude' => -80.1918,
                    'slug' => 'movers-in-miami',
                    'meta_title' => 'Movers in Miami | Move Smooth Moving Company',
                    'meta_description' => 'Looking for reliable movers in Miami? Move Smooth provides affordable local and long-distance moving services across Miami-Dade County.',
                    'heading' => 'Professional Movers in Miami',
                    'content' => '<h3>Best Moving Companies in Miami, FL</h3>
<p>Miami\'s tropical climate, luxury waterfront condos, and diverse neighborhoods demand specialized moving expertise. <strong>Move Smooth</strong> connects you with fully licensed <strong>movers in Miami</strong> who understand the city\'s unique requirements.</p>
<h4>Local Moving in Miami</h4>
<p>From Brickell high-rises to Coral Gables estates, our Miami movers handle luxury furniture, art installations, and high-value electronics with white-glove care. Building COI and elevator reservation services included.</p>
<h4>Long Distance from Miami</h4>
<p>Popular routes include Miami to Orlando, Miami to Tampa, and Miami to Atlanta. All moves include binding estimates and GPS-tracked delivery.</p>
<h4>Why Choose Move Smooth in Miami?</h4>
<ul>
<li><strong>Hurricane-Ready Storage:</strong> Reinforced, climate-controlled facilities.</li>
<li><strong>Luxury Moving:</strong> White-glove service for high-value items.</li>
<li><strong>Bilingual Crews:</strong> English and Spanish-speaking professionals.</li>
</ul>',
                ],
                [
                    'name' => 'Orlando', 'zip_code' => '32801', 'latitude' => 28.5383, 'longitude' => -81.3792,
                    'slug' => 'movers-in-orlando',
                    'meta_title' => 'Movers in Orlando | Move Smooth Moving Company',
                    'meta_description' => 'Find trusted movers in Orlando, FL. Move Smooth connects you with verified local and long-distance moving companies serving Central Florida.',
                    'heading' => 'Professional Movers in Orlando',
                    'content' => '<h3>Trusted Moving Companies in Orlando, FL</h3>
<p>Orlando is one of Florida\'s fastest-growing metros, attracting families, professionals, and businesses alike. <strong>Move Smooth</strong> connects you with licensed <strong>movers in Orlando</strong> for seamless residential and commercial relocations.</p>
<h4>Local Moving in Orlando</h4>
<p>Our Orlando movers serve neighborhoods from Dr. Phillips to Lake Nona, handling apartment moves, family home relocations, and senior downsizing with professional care.</p>
<h4>Why Choose Move Smooth in Orlando?</h4>
<ul>
<li><strong>Theme Park Area Expertise:</strong> Movers familiar with gated communities near Disney and Universal.</li>
<li><strong>Same-Day Service:</strong> Last-minute moving options available.</li>
<li><strong>Full Packing:</strong> Professional wrap, box, and label services.</li>
</ul>',
                ],
                [
                    'name' => 'Tampa', 'zip_code' => '33602', 'latitude' => 27.9506, 'longitude' => -82.4572,
                    'slug' => 'movers-in-tampa',
                    'meta_title' => 'Movers in Tampa | Move Smooth Moving Company',
                    'meta_description' => 'Looking for movers in Tampa? Move Smooth connects you with verified, licensed moving companies serving the Tampa Bay area.',
                    'heading' => 'Professional Movers in Tampa',
                    'content' => '<h3>Top-Rated Movers in Tampa, FL</h3>
<p>Tampa Bay\'s growing population and thriving business district require reliable moving professionals. <strong>Move Smooth</strong> connects you with licensed <strong>movers in Tampa</strong> serving Hillsborough, Pinellas, and Pasco counties.</p>
<h4>Services in Tampa</h4>
<p>From waterfront condos in Channelside to family homes in Wesley Chapel, our Tampa movers deliver full-service residential, commercial, and senior relocations with care.</p>
<h4>Why Choose Move Smooth in Tampa?</h4>
<ul>
<li><strong>Bay Area Coverage:</strong> St. Petersburg, Clearwater, and surrounding counties.</li>
<li><strong>Senior Specialists:</strong> Compassionate crews trained in downsizing and assisted living transitions.</li>
</ul>',
                ],
            ],

            // ============ NEW YORK (NY) ============
            'NY' => [
                [
                    'name' => 'New York City', 'zip_code' => '10001', 'latitude' => 40.7128, 'longitude' => -74.0060,
                    'slug' => 'movers-in-new-york-city',
                    'meta_title' => 'Movers in New York City | Move Smooth Moving Company',
                    'meta_description' => 'Find the best movers in NYC. Move Smooth connects you with licensed, insured moving companies serving Manhattan, Brooklyn, Queens, and all five boroughs.',
                    'heading' => 'Professional Movers in New York City',
                    'content' => '<h3>Licensed Moving Companies in New York City</h3>
<p>Moving in New York City presents unique challenges: narrow walkup staircases, strict building regulations, tight elevator schedules, and limited parking. <strong>Move Smooth</strong> connects you with <strong>movers in New York City</strong> who navigate these obstacles daily across all five boroughs.</p>
<h4>Manhattan, Brooklyn, Queens & More</h4>
<p>Our NYC movers handle everything from Upper East Side luxury apartments to Williamsburg lofts, providing COI documentation, freight elevator bookings, and NYPD parking permits as needed.</p>
<h4>Why Choose Move Smooth in NYC?</h4>
<ul>
<li><strong>Walkup Specialists:</strong> Crews trained for 5th-floor walkup apartment moves.</li>
<li><strong>COI & Building Compliance:</strong> All paperwork handled in advance.</li>
<li><strong>Express Service:</strong> Same-day and next-day availability.</li>
</ul>',
                ],
                [
                    'name' => 'Buffalo', 'zip_code' => '14201', 'latitude' => 42.8864, 'longitude' => -78.8784,
                    'slug' => 'movers-in-buffalo',
                    'meta_title' => 'Movers in Buffalo | Move Smooth Moving Company',
                    'meta_description' => 'Find reliable movers in Buffalo, NY. Move Smooth connects you with verified moving companies for local and long-distance moves in Western New York.',
                    'heading' => 'Professional Movers in Buffalo',
                    'content' => '<h3>Trusted Movers in Buffalo, NY</h3>
<p>Buffalo\'s affordable housing market and revitalized downtown are attracting new residents from across the Northeast. <strong>Move Smooth</strong> connects you with experienced <strong>movers in Buffalo</strong> for hassle-free relocations.</p>
<h4>Services in Buffalo</h4>
<p>From Elmwood Village apartments to Amherst family homes, our Buffalo movers provide full-service packing, heavy furniture handling, and cold-weather protection for winter moves.</p>
<h4>Why Choose Move Smooth in Buffalo?</h4>
<ul>
<li><strong>Winter Moving Experts:</strong> Snow-ready crews with heated trucks and weather-resistant packing.</li>
<li><strong>Affordable Rates:</strong> Competitive hourly pricing for Western NY moves.</li>
</ul>',
                ],
            ],

            // ============ ILLINOIS (IL) ============
            'IL' => [
                [
                    'name' => 'Chicago', 'zip_code' => '60601', 'latitude' => 41.8781, 'longitude' => -87.6298,
                    'slug' => 'movers-in-chicago',
                    'meta_title' => 'Movers in Chicago | Move Smooth Moving Company',
                    'meta_description' => 'Looking for movers in Chicago? Move Smooth connects you with licensed, insured Chicago moving companies for local and interstate moves.',
                    'heading' => 'Professional Movers in Chicago',
                    'content' => '<h3>Best Moving Companies in Chicago, IL</h3>
<p>Chicago\'s mix of high-rise condos, Victorian walkups, and suburban single-family homes requires versatile moving professionals. <strong>Move Smooth</strong> connects you with top-rated <strong>movers in Chicago</strong> serving Cook County and the surrounding suburbs.</p>
<h4>Local Moving in Chicago</h4>
<p>From Lincoln Park to Wicker Park, from the Loop to Naperville, our Chicago movers handle freight elevator protocols, loading dock reservations, and building COI requirements with expertise.</p>
<h4>Why Choose Move Smooth in Chicago?</h4>
<ul>
<li><strong>High-Rise Experience:</strong> COI documentation, elevator scheduling, and loading dock coordination.</li>
<li><strong>Suburban Coverage:</strong> Naperville, Evanston, Schaumburg, and all suburbs.</li>
<li><strong>Winter-Ready:</strong> Heated trucks and weather-resistant packing for Chicago winters.</li>
</ul>',
                ],
                [
                    'name' => 'Springfield', 'zip_code' => '62701', 'latitude' => 39.7817, 'longitude' => -89.6501,
                    'slug' => 'movers-in-springfield-il',
                    'meta_title' => 'Movers in Springfield IL | Move Smooth Moving Company',
                    'meta_description' => 'Find verified movers in Springfield, Illinois. Move Smooth connects you with licensed moving companies for residential and commercial moves.',
                    'heading' => 'Professional Movers in Springfield',
                    'content' => '<h3>Reliable Movers in Springfield, IL</h3>
<p>As Illinois\' state capital, Springfield offers affordable living and a growing economy. <strong>Move Smooth</strong> connects you with trusted <strong>movers in Springfield</strong> for both residential and government office relocations.</p>
<h4>Why Choose Move Smooth in Springfield?</h4>
<ul>
<li><strong>Government & Office Moves:</strong> Experience with state agency relocations.</li>
<li><strong>Affordable Local Rates:</strong> Budget-friendly hourly pricing.</li>
</ul>',
                ],
            ],

            // ============ GEORGIA (GA) ============
            'GA' => [
                [
                    'name' => 'Atlanta', 'zip_code' => '30301', 'latitude' => 33.7490, 'longitude' => -84.3880,
                    'slug' => 'movers-in-atlanta',
                    'meta_title' => 'Movers in Atlanta | Move Smooth Moving Company',
                    'meta_description' => 'Looking for reliable movers in Atlanta? Move Smooth provides affordable local and long-distance moving services across Metro Atlanta.',
                    'heading' => 'Professional Movers in Atlanta',
                    'content' => '<h3>Top-Rated Moving Companies in Atlanta, GA</h3>
<p>Atlanta is the economic hub of the Southeast, with diverse neighborhoods ranging from Buckhead mansions to Old Fourth Ward lofts. <strong>Move Smooth</strong> connects you with fully licensed <strong>movers in Atlanta</strong> who know the city inside out.</p>
<h4>Local Moving in Atlanta</h4>
<p>Our Atlanta movers serve Midtown, Decatur, Marietta, Alpharetta, and all ITP and OTP neighborhoods with professional loading crews and transparent pricing.</p>
<h4>Why Choose Move Smooth in Atlanta?</h4>
<ul>
<li><strong>Metro-Wide Coverage:</strong> All 29 counties in the Atlanta metropolitan area.</li>
<li><strong>Corporate Specialists:</strong> Fortune 500 office relocations and IT migrations.</li>
<li><strong>Storage Solutions:</strong> Climate-controlled facilities across Metro Atlanta.</li>
</ul>',
                ],
                [
                    'name' => 'Savannah', 'zip_code' => '31401', 'latitude' => 32.0809, 'longitude' => -81.0912,
                    'slug' => 'movers-in-savannah',
                    'meta_title' => 'Movers in Savannah | Move Smooth Moving Company',
                    'meta_description' => 'Find trusted movers in Savannah, GA. Move Smooth connects you with verified moving companies for local and long-distance moves in Coastal Georgia.',
                    'heading' => 'Professional Movers in Savannah',
                    'content' => '<h3>Trusted Movers in Savannah, GA</h3>
<p>Savannah\'s historic architecture and coastal charm require moving professionals who handle antiques and period furnishings with care. <strong>Move Smooth</strong> connects you with experienced <strong>movers in Savannah</strong>.</p>
<h4>Why Choose Move Smooth in Savannah?</h4>
<ul>
<li><strong>Historic Home Experts:</strong> Specialized handling for antique furniture and delicate fixtures.</li>
<li><strong>Coastal Climate Packing:</strong> Humidity-resistant materials and sealed wrapping.</li>
</ul>',
                ],
            ],

            // ============ NORTH CAROLINA (NC) ============
            'NC' => [
                [
                    'name' => 'Charlotte', 'zip_code' => '28201', 'latitude' => 35.2271, 'longitude' => -80.8431,
                    'slug' => 'movers-in-charlotte',
                    'meta_title' => 'Movers in Charlotte | Move Smooth Moving Company',
                    'meta_description' => 'Looking for reliable movers in Charlotte? Move Smooth provides affordable local and long-distance moving services across the Charlotte metro area.',
                    'heading' => 'Professional Movers in Charlotte',
                    'content' => '<h3>Best Moving Companies in Charlotte, NC</h3>
<p>Charlotte is the largest city in North Carolina and a major financial hub. From South End condos to Lake Norman estates, <strong>Move Smooth</strong> connects you with licensed <strong>movers in Charlotte</strong>.</p>
<h4>Services in Charlotte</h4>
<p>Our Charlotte movers handle residential, commercial, and corporate relocations across Mecklenburg County, including specialized banking sector office moves.</p>
<h4>Why Choose Move Smooth in Charlotte?</h4>
<ul>
<li><strong>Financial District Moves:</strong> Uptown Charlotte corporate relocation specialists.</li>
<li><strong>Lake Norman Coverage:</strong> Serving Huntersville, Cornelius, and Davidson.</li>
</ul>',
                ],
                [
                    'name' => 'Raleigh', 'zip_code' => '27601', 'latitude' => 35.7796, 'longitude' => -78.6382,
                    'slug' => 'movers-in-raleigh',
                    'meta_title' => 'Movers in Raleigh | Move Smooth Moving Company',
                    'meta_description' => 'Find trusted movers in Raleigh, NC. Move Smooth connects you with verified moving companies serving the Research Triangle area.',
                    'heading' => 'Professional Movers in Raleigh',
                    'content' => '<h3>Trusted Movers in Raleigh, NC</h3>
<p>The Research Triangle is one of America\'s fastest-growing tech hubs. <strong>Move Smooth</strong> connects you with professional <strong>movers in Raleigh</strong> serving Durham, Chapel Hill, and all Triangle communities.</p>
<h4>Why Choose Move Smooth in Raleigh?</h4>
<ul>
<li><strong>University Area Moves:</strong> NC State, Duke, and UNC student and faculty relocations.</li>
<li><strong>Tech Company Specialists:</strong> RTP office moves with IT equipment handling.</li>
</ul>',
                ],
            ],

            // ============ OHIO (OH) ============
            'OH' => [
                [
                    'name' => 'Columbus', 'zip_code' => '43201', 'latitude' => 39.9612, 'longitude' => -82.9988,
                    'slug' => 'movers-in-columbus',
                    'meta_title' => 'Movers in Columbus | Move Smooth Moving Company',
                    'meta_description' => 'Looking for movers in Columbus, OH? Move Smooth connects you with licensed, insured moving companies serving Central Ohio.',
                    'heading' => 'Professional Movers in Columbus',
                    'content' => '<h3>Top Moving Companies in Columbus, OH</h3>
<p>Columbus is Ohio\'s capital and fastest-growing city. From Short North condos to Dublin family homes, <strong>Move Smooth</strong> connects you with reliable <strong>movers in Columbus</strong>.</p>
<h4>Why Choose Move Smooth in Columbus?</h4>
<ul>
<li><strong>OSU Area Moves:</strong> Student apartments and faculty housing transitions.</li>
<li><strong>Suburban Coverage:</strong> Dublin, Westerville, Grove City, and all Franklin County.</li>
</ul>',
                ],
                [
                    'name' => 'Cleveland', 'zip_code' => '44101', 'latitude' => 41.4993, 'longitude' => -81.6944,
                    'slug' => 'movers-in-cleveland',
                    'meta_title' => 'Movers in Cleveland | Move Smooth Moving Company',
                    'meta_description' => 'Find reliable movers in Cleveland, OH. Move Smooth connects you with verified moving companies for local and long-distance moves in Northeast Ohio.',
                    'heading' => 'Professional Movers in Cleveland',
                    'content' => '<h3>Reliable Movers in Cleveland, OH</h3>
<p>Cleveland\'s revitalized downtown and affordable neighborhoods attract new residents year-round. <strong>Move Smooth</strong> connects you with experienced <strong>movers in Cleveland</strong> for hassle-free relocations.</p>
<h4>Why Choose Move Smooth in Cleveland?</h4>
<ul>
<li><strong>Lake Effect Ready:</strong> Winter-proof packing and heated transport vehicles.</li>
<li><strong>Downtown Expertise:</strong> High-rise condo and loft moving specialists.</li>
</ul>',
                ],
            ],

            // ============ COLORADO (CO) ============
            'CO' => [
                [
                    'name' => 'Denver', 'zip_code' => '80201', 'latitude' => 39.7392, 'longitude' => -104.9903,
                    'slug' => 'movers-in-denver',
                    'meta_title' => 'Movers in Denver | Move Smooth Moving Company',
                    'meta_description' => 'Looking for movers in Denver? Move Smooth provides affordable local and long-distance moving services across the Denver metro area.',
                    'heading' => 'Professional Movers in Denver',
                    'content' => '<h3>Best Moving Companies in Denver, CO</h3>
<p>Denver\'s booming real estate market and outdoor lifestyle attract thousands of new residents annually. <strong>Move Smooth</strong> connects you with licensed <strong>movers in Denver</strong> who handle everything from LoDo lofts to Cherry Creek estates.</p>
<h4>Why Choose Move Smooth in Denver?</h4>
<ul>
<li><strong>Altitude Expertise:</strong> Crews trained for high-altitude moving conditions.</li>
<li><strong>Mountain Access:</strong> Service to Evergreen, Golden, and foothill communities.</li>
<li><strong>Military Discounts:</strong> Special rates for military families near Buckley and Peterson bases.</li>
</ul>',
                ],
                [
                    'name' => 'Colorado Springs', 'zip_code' => '80901', 'latitude' => 38.8339, 'longitude' => -104.8214,
                    'slug' => 'movers-in-colorado-springs',
                    'meta_title' => 'Movers in Colorado Springs | Move Smooth Moving Company',
                    'meta_description' => 'Find trusted movers in Colorado Springs, CO. Move Smooth connects you with verified moving companies serving El Paso County.',
                    'heading' => 'Professional Movers in Colorado Springs',
                    'content' => '<h3>Trusted Movers in Colorado Springs, CO</h3>
<p>Colorado Springs is home to multiple military installations and a growing tech sector. <strong>Move Smooth</strong> connects you with reliable <strong>movers in Colorado Springs</strong> experienced with military PCS relocations.</p>
<h4>Why Choose Move Smooth in Colorado Springs?</h4>
<ul>
<li><strong>Military PCS Experts:</strong> Fort Carson, Peterson SFB, and Schriever SFB relocation specialists.</li>
<li><strong>Mountain Moving:</strong> Crews equipped for Manitou Springs and mountain community access.</li>
</ul>',
                ],
            ],

            // ============ MICHIGAN (MI) ============
            'MI' => [
                [
                    'name' => 'Detroit', 'zip_code' => '48201', 'latitude' => 42.3314, 'longitude' => -83.0458,
                    'slug' => 'movers-in-detroit',
                    'meta_title' => 'Movers in Detroit | Move Smooth Moving Company',
                    'meta_description' => 'Looking for reliable movers in Detroit? Move Smooth connects you with licensed moving companies serving Metro Detroit and Southeast Michigan.',
                    'heading' => 'Professional Movers in Detroit',
                    'content' => '<h3>Top Moving Companies in Detroit, MI</h3>
<p>Detroit\'s urban renaissance is bringing new residents and businesses to the city. <strong>Move Smooth</strong> connects you with licensed <strong>movers in Detroit</strong> serving Wayne, Oakland, and Macomb counties.</p>
<h4>Why Choose Move Smooth in Detroit?</h4>
<ul>
<li><strong>Metro-Wide Service:</strong> Troy, Birmingham, Royal Oak, and all Metro Detroit suburbs.</li>
<li><strong>Industrial Moves:</strong> Warehouse and manufacturing equipment relocation specialists.</li>
</ul>',
                ],
                [
                    'name' => 'Grand Rapids', 'zip_code' => '49501', 'latitude' => 42.9634, 'longitude' => -85.6681,
                    'slug' => 'movers-in-grand-rapids',
                    'meta_title' => 'Movers in Grand Rapids | Move Smooth Moving Company',
                    'meta_description' => 'Find trusted movers in Grand Rapids, MI. Move Smooth connects you with verified moving companies for local and long-distance moves in West Michigan.',
                    'heading' => 'Professional Movers in Grand Rapids',
                    'content' => '<h3>Reliable Movers in Grand Rapids, MI</h3>
<p>Grand Rapids is West Michigan\'s largest city and a hub for furniture manufacturing and healthcare. <strong>Move Smooth</strong> connects you with experienced <strong>movers in Grand Rapids</strong>.</p>
<h4>Why Choose Move Smooth in Grand Rapids?</h4>
<ul>
<li><strong>Furniture City Experts:</strong> Specialized handling for high-value furniture pieces.</li>
<li><strong>Lake Michigan Access:</strong> Serving Holland, Muskegon, and lakeshore communities.</li>
</ul>',
                ],
            ],

            // ============ WASHINGTON (WA) ============
            'WA' => [
                [
                    'name' => 'Seattle', 'zip_code' => '98101', 'latitude' => 47.6062, 'longitude' => -122.3321,
                    'slug' => 'movers-in-seattle',
                    'meta_title' => 'Movers in Seattle | Move Smooth Moving Company',
                    'meta_description' => 'Looking for movers in Seattle? Move Smooth connects you with licensed, insured moving companies serving the Greater Seattle area.',
                    'heading' => 'Professional Movers in Seattle',
                    'content' => '<h3>Best Moving Companies in Seattle, WA</h3>
<p>Seattle\'s tech-driven economy and steep hillside neighborhoods require specialized moving expertise. <strong>Move Smooth</strong> connects you with top-rated <strong>movers in Seattle</strong> serving King County and the Eastside.</p>
<h4>Why Choose Move Smooth in Seattle?</h4>
<ul>
<li><strong>Hill Navigation:</strong> Crews experienced with Capitol Hill, Queen Anne, and Magnolia grades.</li>
<li><strong>Rain-Proof Packing:</strong> Water-resistant wrapping and sealed containers for Pacific Northwest weather.</li>
<li><strong>Eastside Coverage:</strong> Bellevue, Kirkland, Redmond, and all Eastside communities.</li>
</ul>',
                ],
                [
                    'name' => 'Tacoma', 'zip_code' => '98401', 'latitude' => 47.2529, 'longitude' => -122.4443,
                    'slug' => 'movers-in-tacoma',
                    'meta_title' => 'Movers in Tacoma | Move Smooth Moving Company',
                    'meta_description' => 'Find reliable movers in Tacoma, WA. Move Smooth connects you with verified moving companies for local and long-distance moves in Pierce County.',
                    'heading' => 'Professional Movers in Tacoma',
                    'content' => '<h3>Trusted Movers in Tacoma, WA</h3>
<p>Tacoma offers affordable waterfront living minutes from Seattle. <strong>Move Smooth</strong> connects you with licensed <strong>movers in Tacoma</strong> serving Pierce County and Joint Base Lewis-McChord families.</p>
<h4>Why Choose Move Smooth in Tacoma?</h4>
<ul>
<li><strong>JBLM Military Moves:</strong> PCS relocation specialists with military discounts.</li>
<li><strong>Port City Expertise:</strong> Heavy freight and industrial equipment handling.</li>
</ul>',
                ],
            ],

            // ============ ARIZONA (AZ) ============
            'AZ' => [
                [
                    'name' => 'Phoenix', 'zip_code' => '85001', 'latitude' => 33.4484, 'longitude' => -112.0740,
                    'slug' => 'movers-in-phoenix',
                    'meta_title' => 'Movers in Phoenix | Move Smooth Moving Company',
                    'meta_description' => 'Looking for reliable movers in Phoenix? Move Smooth provides affordable local and long-distance moving services across the Valley of the Sun.',
                    'heading' => 'Professional Movers in Phoenix',
                    'content' => '<h3>Top Moving Companies in Phoenix, AZ</h3>
<p>Phoenix is America\'s fifth-largest city with year-round sunshine and rapid suburban growth. <strong>Move Smooth</strong> connects you with licensed <strong>movers in Phoenix</strong> who handle heat-sensitive relocations across Maricopa County.</p>
<h4>Why Choose Move Smooth in Phoenix?</h4>
<ul>
<li><strong>Heat-Protected Transit:</strong> Climate-controlled trucks for electronics and temperature-sensitive items.</li>
<li><strong>Valley-Wide Service:</strong> Scottsdale, Tempe, Mesa, Chandler, Gilbert, and all East Valley.</li>
<li><strong>Snowbird Specialists:</strong> Seasonal relocation services for winter residents.</li>
</ul>',
                ],
                [
                    'name' => 'Tucson', 'zip_code' => '85701', 'latitude' => 32.2226, 'longitude' => -110.9747,
                    'slug' => 'movers-in-tucson',
                    'meta_title' => 'Movers in Tucson | Move Smooth Moving Company',
                    'meta_description' => 'Find trusted movers in Tucson, AZ. Move Smooth connects you with verified moving companies for local and long-distance moves in Southern Arizona.',
                    'heading' => 'Professional Movers in Tucson',
                    'content' => '<h3>Reliable Movers in Tucson, AZ</h3>
<p>Tucson\'s university culture, affordable housing, and desert charm make it a popular relocation destination. <strong>Move Smooth</strong> connects you with experienced <strong>movers in Tucson</strong> serving Pima County.</p>
<h4>Why Choose Move Smooth in Tucson?</h4>
<ul>
<li><strong>University Moves:</strong> U of A student and faculty relocation specialists.</li>
<li><strong>Senior Moving:</strong> Compassionate downsizing assistance for retirement communities.</li>
</ul>',
                ],
            ],
        ];

        foreach ($citiesData as $stateCode => $cities) {
            $state = State::where('code', $stateCode)->first();
            if (!$state) {
                $this->command->warn("State {$stateCode} not found, skipping cities.");
                continue;
            }

            foreach ($cities as $cityData) {
                // Create or find the city record
                $city = City::firstOrCreate(
                    ['name' => $cityData['name'], 'state_id' => $state->id],
                    [
                        'zip_code' => $cityData['zip_code'],
                        'latitude' => $cityData['latitude'],
                        'longitude' => $cityData['longitude'],
                    ]
                );

                // Create or update city content
                CityContent::updateOrCreate(
                    ['city_id' => $city->id],
                    [
                        'slug' => $cityData['slug'],
                        'meta_title' => $cityData['meta_title'],
                        'meta_description' => $cityData['meta_description'],
                        'heading' => $cityData['heading'],
                        'content' => $cityData['content'],
                        'is_active' => true,
                    ]
                );

                $this->command->info("Seeded city: {$cityData['name']}, {$stateCode}");
            }
        }

        $this->command->info('City content seeder completed — ' . collect($citiesData)->flatten(1)->count() . ' cities seeded across 12 states.');
    }
}
