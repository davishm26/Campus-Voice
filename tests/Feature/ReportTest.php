<?php

namespace Tests\Feature;

use App\Models\Report;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ReportTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_is_redirected_to_login_when_accessing_create_report(): void
    {
        $response = $this->get('/laporan/buat');

        $response->assertRedirect('/login');
    }

    public function test_authenticated_user_can_view_create_report_screen(): void
    {
        $user = User::factory()->create([
            'name' => 'Max Verstappen',
        ]);

        $response = $this->actingAs($user)->get('/laporan/buat');

        $response->assertStatus(200);
        $response->assertSee('Buat Pengaduan / Aspirasi');
        $response->assertSee('Detail Laporan');
        $response->assertSee('Kategori');
        $response->assertSee('Judul Laporan');
        $response->assertSee('Deskripsi');
        $response->assertSee('Lokasi');
        $response->assertSee('Bukti Pendukung');
        $response->assertSee('Kirim laporan secara anonim');
        $response->assertSee('Max Verstappen');
        $response->assertSee('MV');
    }

    public function test_user_can_submit_report_successfully(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/laporan', [
            'category' => 'Fasilitas Kampus',
            'title' => 'AC Ruang 2.18 Tidak Dingin',
            'description' => 'Pendingin ruangan di kelas 2.18 mati sejak pagi tadi sehingga mengganggu perkuliahan.',
            'location' => 'Kelas 2.18',
            'is_anonymous' => '0',
        ]);

        $response->assertRedirect('/laporan/buat');
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('reports', [
            'user_id' => $user->id,
            'category' => 'Fasilitas Kampus',
            'title' => 'AC Ruang 2.18 Tidak Dingin',
            'location' => 'Kelas 2.18',
            'is_anonymous' => false,
            'status' => 'pending',
        ]);
    }

    public function test_user_can_submit_anonymous_report_with_attachment(): void
    {
        Storage::fake('public');

        $user = User::factory()->create();
        $file = UploadedFile::fake()->create('foto_bukti.jpg', 500, 'image/jpeg');

        $response = $this->actingAs($user)->post('/laporan', [
            'category' => 'Kebersihan Lingkungan',
            'title' => 'Sampah Menumpuk di Koridor Gedung B',
            'description' => 'Tempat sampah penuh dan berserakan di depan lab.',
            'location' => 'Gedung B Lt. 2',
            'is_anonymous' => '1',
            'attachment' => $file,
        ]);

        $response->assertRedirect('/laporan/buat');

        $report = Report::first();
        $this->assertNotNull($report);
        $this->assertTrue($report->is_anonymous);
        $this->assertEquals('Anonim', $report->reporter_name);
        $this->assertNotNull($report->attachment_path);
        Storage::disk('public')->assertExists($report->attachment_path);
    }

    public function test_validation_errors_when_required_fields_are_missing(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/laporan', []);

        $response->assertSessionHasErrors(['category', 'title', 'description']);
    }

    public function test_user_can_view_their_submitted_reports(): void
    {
        $user = User::factory()->create();
        $report = Report::factory()->create([
            'user_id' => $user->id,
            'title' => 'Proyektor Ruang Kuliah Rusak',
        ]);

        $response = $this->actingAs($user)->get('/laporan-saya');

        $response->assertStatus(200);
        $response->assertSee('Proyektor Ruang Kuliah Rusak');
    }

    public function test_user_can_view_single_report_detail(): void
    {
        $user = User::factory()->create();
        $report = Report::factory()->create([
            'user_id' => $user->id,
            'title' => 'Lampu Parkiran Mati',
            'description' => 'Lampu di area parkiran barat mati sehingga gelap di malam hari.',
        ]);

        $response = $this->actingAs($user)->get("/laporan/{$report->id}");

        $response->assertStatus(200);
        $response->assertSee('Lampu Parkiran Mati');
        $response->assertSee('Lampu di area parkiran barat mati');
    }
}
