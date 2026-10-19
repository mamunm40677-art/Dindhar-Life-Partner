<?php

namespace Tests\Feature;

use App\Models\Biodata;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BiodataFlowTest extends TestCase
{
    use RefreshDatabase;

    public function test_language_choice_changes_homepage_copy(): void
    {
        $this->get('/')->assertOk()->assertSee('জীবনসঙ্গী খোঁজার পথে');

        $this->post('/language', ['locale' => 'en'])->assertRedirect();

        $this->get('/')->assertOk()->assertSee('Find your life partner');
    }

    public function test_registration_creates_account_and_starts_authenticated_session(): void
    {
        $this->post('/register', [
            'name' => 'Amina Rahman',
            'email' => 'amina@example.test',
            'password' => 'secure-password-123',
            'password_confirmation' => 'secure-password-123',
        ])->assertRedirectToRoute('dashboard');

        $this->assertAuthenticated();
        $this->assertDatabaseHas('users', ['email' => 'amina@example.test']);
    }

    public function test_authenticated_user_can_create_a_published_biodata(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)->post('/my-biodata', $this->validBiodata())
            ->assertRedirectToRoute('biodatas.show', 1);

        $this->assertDatabaseHas('biodatas', [
            'user_id' => $user->id,
            'display_name' => 'Amina Rahman',
            'published' => true,
        ]);
    }

    public function test_public_search_only_returns_matching_published_profiles(): void
    {
        $matching = Biodata::factory()->for(User::factory())->create([
            'display_name' => 'Amina Public',
            'gender' => 'bride',
            'city' => 'Dhaka',
            'published' => true,
        ]);
        Biodata::factory()->for(User::factory())->create([
            'display_name' => 'Private Draft',
            'gender' => 'bride',
            'city' => 'Dhaka',
            'published' => false,
        ]);
        Biodata::factory()->for(User::factory())->create([
            'display_name' => 'Other City',
            'gender' => 'groom',
            'city' => 'Chattogram',
            'published' => true,
        ]);

        $this->get('/biodatas?gender=bride&city=Dhaka')->assertOk()
            ->assertSee('Amina Public')
            ->assertDontSee('Private Draft')
            ->assertDontSee('Other City')
            ->assertSee('/biodatas/'.$matching->id);
    }

    public function test_another_user_cannot_update_or_view_a_private_biodata(): void
    {
        $owner = User::factory()->create();
        $biodata = Biodata::factory()->for($owner)->create([
            'display_name' => 'Private Profile',
            'published' => false,
        ]);
        $otherUser = User::factory()->create();

        $this->get('/biodatas/'.$biodata->id)->assertNotFound();

        $this->actingAs($otherUser)->put('/my-biodata/'.$biodata->id, $this->validBiodata())
            ->assertForbidden();

        $this->assertDatabaseHas('biodatas', [
            'id' => $biodata->id,
            'user_id' => $owner->id,
            'display_name' => 'Private Profile',
        ]);
    }

    public function test_guest_is_redirected_to_login_from_dashboard(): void
    {
        $this->get('/dashboard')->assertRedirect('/login');
    }

    public function test_dashboard_uses_the_saved_english_language(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)->post('/language', ['locale' => 'en'])->assertRedirect();

        $this->get('/dashboard')->assertOk()
            ->assertSee('Account overview')
            ->assertSee('Profile visibility')
            ->assertSee('Browse profiles');
    }

    public function test_login_authenticates_an_existing_user(): void
    {
        $user = User::factory()->create(['password' => 'secure-password-123']);

        $this->post('/login', [
            'email' => $user->email,
            'password' => 'secure-password-123',
        ])->assertRedirectToRoute('dashboard');

        $this->assertAuthenticatedAs($user);
    }

    public function test_profile_views_render_and_owner_can_update_and_delete_biodata(): void
    {
        $user = User::factory()->create();
        $this->get('/register')->assertOk();
        $this->get('/login')->assertOk();
        $this->actingAs($user)->get('/dashboard')->assertOk()
            ->assertSee($user->email)
            ->assertSee(__('site.profile_missing'));
        $this->get('/my-biodata/create')->assertOk();
        $this->post('/my-biodata', $this->validBiodata())->assertRedirect();

        $this->get('/dashboard')->assertOk()
            ->assertSee('Amina Rahman')
            ->assertSee(__('site.published'));

        $biodata = $user->fresh()->biodata;
        $this->get('/biodatas/'.$biodata->id)->assertOk();
        $this->get('/my-biodata/'.$biodata->id.'/edit')->assertOk();

        $this->put('/my-biodata/'.$biodata->id, array_merge($this->validBiodata(), [
            'display_name' => 'Updated Name',
        ]))->assertRedirect();
        $this->assertDatabaseHas('biodatas', ['id' => $biodata->id, 'display_name' => 'Updated Name']);

        $this->delete('/my-biodata/'.$biodata->id)->assertRedirectToRoute('dashboard');
        $this->assertDatabaseMissing('biodatas', ['id' => $biodata->id]);
    }

    /** @return array<string, mixed> */
    private function validBiodata(): array
    {
        return [
            'display_name' => 'Amina Rahman',
            'gender' => 'bride',
            'age' => 26,
            'marital_status' => 'never_married',
            'city' => 'Dhaka',
            'education' => 'Masters in Education',
            'occupation' => 'Teacher',
            'about' => 'I value faith, kindness, and family.',
            'published' => '1',
        ];
    }
}
