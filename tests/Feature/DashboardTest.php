<?php

namespace Tests\Feature;

use App\Models\Report;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_guests_are_redirected_to_the_login_page(): void
    {
        $response = $this->get(route('dashboard'));

        $response->assertRedirect(route('login'));
    }

    public function test_user_is_redirected_to_dashboard_after_login_and_sees_their_name(): void
    {
        $user = User::factory()->create(['name' => 'Max Verstappen']);

        $this->post(route('login'), [
            'email' => $user->email,
            'password' => 'password',
        ])->assertRedirect(route('dashboard', absolute: false));

        $this->get(route('dashboard'))
            ->assertOk()
            ->assertSee('Max Verstappen')
            ->assertSee('MV')
            ->assertSee('Selamat datang kembali di CampusVoice');
    }

    public function test_dashboard_shows_report_statistics_for_the_authenticated_user_only(): void
    {
        $user = User::factory()->create();
        Report::factory()->for($user)->count(2)->create();
        Report::factory()->for($user)->inProgress()->count(4)->create();
        Report::factory()->for($user)->completed()->count(3)->create();
        Report::factory()->completed()->count(5)->create();

        $response = $this->actingAs($user)->get(route('dashboard'));

        $response->assertOk()
            ->assertViewHas('totalReports', 9)
            ->assertViewHas('inProgressReports', 4)
            ->assertViewHas('completedReports', 3);
    }

    public function test_dashboard_lists_the_three_latest_reports_of_the_user(): void
    {
        $user = User::factory()->create();
        Report::factory()->for($user)->create(['ticket_number' => 'CV-OLD', 'created_at' => now()->subDays(10)]);
        Report::factory()->for($user)->inProgress()->create(['ticket_number' => 'CV-001', 'title' => 'Fasilitas WiFi Kampus', 'created_at' => now()]);
        Report::factory()->for($user)->completed()->create(['ticket_number' => 'CV-002', 'created_at' => now()->subDays(3)]);
        Report::factory()->for($user)->create(['ticket_number' => 'CV-003', 'created_at' => now()->subDays(5)]);
        Report::factory()->create(['ticket_number' => 'CV-OTHER']);

        $response = $this->actingAs($user)->get(route('dashboard'));

        $response->assertOk()
            ->assertSeeInOrder(['CV-001', 'CV-002', 'CV-003'])
            ->assertSee('Fasilitas WiFi Kampus')
            ->assertSee('Diproses')
            ->assertDontSee('CV-OLD')
            ->assertDontSee('CV-OTHER');
    }

    public function test_dashboard_shows_empty_state_when_user_has_no_reports(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get(route('dashboard'))
            ->assertOk()
            ->assertViewHas('totalReports', 0)
            ->assertSee('Belum ada laporan');
    }
}
