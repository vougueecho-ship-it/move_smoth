<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Company;
use App\Models\State;
use App\Models\City;
use App\Models\QuoteRequest;
use App\Models\Lead;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use App\Mail\LeadDispatched;
use Tests\TestCase;

class LeadDispatchTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Create base country
        $this->country = \App\Models\Country::create([
            'name' => 'United States',
            'iso2' => 'US',
        ]);

        // Create base state and city for testing autocomplete and route calculations
        $this->state = State::create([
            'country_id' => $this->country->id,
            'name' => 'California',
            'code' => 'CA',
            'slug' => 'california',
            'is_active' => true,
        ]);

        $this->cityFrom = City::create([
            'state_id' => $this->state->id,
            'name' => 'Los Angeles',
            'zip_code' => '90001',
            'latitude' => 34.0522,
            'longitude' => -118.2437,
        ]);

        $this->cityTo = City::create([
            'state_id' => $this->state->id,
            'name' => 'San Francisco',
            'zip_code' => '94101',
            'latitude' => 37.7749,
            'longitude' => -122.4194,
        ]);

        // Create an Admin user
        $this->admin = User::create([
            'name' => 'Admin User',
            'email' => 'contact@movesmooth.com',
            'password' => bcrypt('password123'),
            'is_admin' => true,
        ]);

        // Create a Company User and associated Company
        $this->companyUser = User::create([
            'name' => 'Company Owner',
            'email' => 'owner@fastmovers.com',
            'password' => bcrypt('password123'),
            'is_admin' => false,
            'role' => 'company',
        ]);

        $this->company = Company::create([
            'user_id' => $this->companyUser->id,
            'name' => 'Fast Movers LLC',
            'slug' => 'fast-movers-llc',
            'email' => 'dispatch@fastmovers.com',
            'phone' => '800-555-0199',
            'city' => 'Los Angeles',
            'state_id' => $this->state->id,
            'is_active' => true,
            'status' => 'active',
        ]);
    }

    /**
     * Test ZIP autocomplete search suggestions.
     */
    public function test_zip_autocomplete_suggestions(): void
    {
        $response = $this->getJson(route('front.api.zip-search', ['q' => '900']));

        $response->assertStatus(200);
        $response->assertJsonFragment([
            'zip_code' => '90001',
            'city' => 'Los Angeles',
            'state' => 'CA',
        ]);
    }

    /**
     * Test frontend quote submit with Haversine distance and price calculations.
     */
    public function test_frontend_quote_submission_calculates_correct_distance_and_price(): void
    {
        $response = $this->postJson(route('front.quote.submit'), [
            'zip_from' => '90001 - Los Angeles, CA',
            'zip_to' => '94101 - San Francisco, CA',
            'move_date' => now()->addDays(7)->format('Y-m-d'),
            'move_size' => 'Studio / 1BR',
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
            'phone' => '123-456-7890',
        ], [
            'HTTP_X-Requested-With' => 'XMLHttpRequest'
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'success',
            'quote',
            'min_price',
            'max_price',
            'distance',
        ]);

        $this->assertDatabaseHas('quote_requests', [
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
            'move_size' => 'Studio / 1BR',
        ]);

        $quote = QuoteRequest::first();
        $this->assertNotNull($quote->calculated_distance);
        $this->assertGreaterThan(0, $quote->calculated_distance);
        $this->assertNotNull($quote->min_price);
        $this->assertNotNull($quote->max_price);
    }

    /**
     * Test admin lead dispatching to a company, duplicate prevention, and mail dispatch.
     */
    public function test_admin_can_dispatch_quote_request_to_active_company(): void
    {
        Mail::fake();

        // Create a Quote Request first
        $quote = QuoteRequest::create([
            'name' => 'Jane Smith',
            'email' => 'janesmith@example.com',
            'phone' => '987-654-3210',
            'zip_from' => '90001',
            'zip_to' => '94101',
            'move_date' => now()->addDays(14)->format('Y-m-d'),
            'move_size' => '2 - 3 Bedroom',
            'calculated_distance' => 350,
            'min_price' => 1400,
            'max_price' => 2000,
            'status' => 'Delivered',
        ]);

        // Access route as non-admin should be forbidden/redirected
        $response = $this->actingAs($this->companyUser)
            ->post(route('admin.revenue.dispatch', ['id' => $quote->id]), [
                'company_ids' => [$this->company->id],
            ]);
        $response->assertRedirect(); // Middleware redirects to dashboard or login

        // Dispatch lead as Admin
        $response = $this->actingAs($this->admin)
            ->post(route('admin.revenue.dispatch', ['id' => $quote->id]), [
                'company_ids' => [$this->company->id],
            ]);

        $response->assertSessionHas('success');

        // Verify lead is copied to leads table
        $this->assertDatabaseHas('leads', [
            'company_id' => $this->company->id,
            'quote_request_id' => $quote->id,
            'name' => 'Jane Smith',
            'email' => 'janesmith@example.com',
            'status' => 'new',
        ]);

        // Verify email was sent to the company
        Mail::assertSent(LeadDispatched::class, function ($mail) {
            return $mail->hasTo($this->company->email) && $mail->lead->name === 'Jane Smith';
        });

        // Test duplicate prevention - dispatching again should not add a duplicate or resend mail
        Mail::fake();

        $response = $this->actingAs($this->admin)
            ->post(route('admin.revenue.dispatch', ['id' => $quote->id]), [
                'company_ids' => [$this->company->id],
            ]);

        // Total count in leads table for this assignment should still be 1
        $this->assertEquals(1, Lead::where('quote_request_id', $quote->id)->where('company_id', $this->company->id)->count());
        Mail::assertNothingSent();
    }

    /**
     * Test quote submission supports fuzzy, city-state, and other raw input formats.
     */
    public function test_frontend_quote_submission_supports_various_input_formats(): void
    {
        $response = $this->postJson(route('front.quote.submit'), [
            'zip_from' => 'Los Angeles, CA',
            'zip_to' => 'San Francisco, CA',
            'move_date' => now()->addDays(7)->format('Y-m-d'),
            'move_size' => 'Studio / 1BR',
            'name' => 'John Doe Fuzzy',
            'email' => 'fuzzy@example.com',
            'phone' => '123-456-7890',
        ], [
            'HTTP_X-Requested-With' => 'XMLHttpRequest'
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'success',
            'quote',
            'min_price',
            'max_price',
            'distance',
        ]);

        $quote = QuoteRequest::where('email', 'fuzzy@example.com')->first();
        $this->assertNotNull($quote);
        $this->assertNotNull($quote->calculated_distance);
        $this->assertGreaterThan(0, $quote->calculated_distance);
    }

    /**
     * Test chatbot API lead capture endpoint saves quote request with correct calculations.
     */
    public function test_chatbot_secure_lead_capture_saves_correctly(): void
    {
        Mail::fake();

        $response = $this->postJson(route('front.api.chatbot.lead'), [
            'name' => 'Chatty Customer',
            'email' => 'chatty@example.com',
            'phone' => '111-222-3333',
            'from_city' => '90001',
            'to_city' => '94101',
            'move_date' => now()->addDays(10)->format('Y-m-d'),
            'home_size' => 'Studio / 1BR',
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true
        ]);

        $this->assertDatabaseHas('quote_requests', [
            'name' => 'Chatty Customer',
            'email' => 'chatty@example.com',
            'phone' => '111-222-3333',
            'move_size' => 'Studio / 1BR',
            'status' => 'Delivered'
        ]);

        $quote = QuoteRequest::where('email', 'chatty@example.com')->first();
        $this->assertNotNull($quote->calculated_distance);
        $this->assertGreaterThan(0, $quote->calculated_distance);
        $this->assertNotNull($quote->min_price);
        $this->assertNotNull($quote->max_price);
    }
}
