<?php

namespace Database\Seeders;

use App\Models\User;
use App\ReportStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReportSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::query()->firstOrFail();

        $reports = [
            ['CV-001', 'Fasilitas WiFi Kampus', ReportStatus::InProgress, '2026-10-02'],
            ['CV-002', 'Lampu Ruang Kelas Mati', ReportStatus::Completed, '2026-09-29'],
            ['CV-003', 'Aspirasi Area Parkir', ReportStatus::Pending, '2026-09-27'],
        ];

        foreach ($reports as [$ticketNumber, $title, $status, $date]) {
            $user->reports()->create([
                'ticket_number' => $ticketNumber,
                'title' => $title,
                'description' => "Laporan terkait {$title}.",
                'status' => $status,
            ])->forceFill(['created_at' => $date, 'updated_at' => $date])->save();
        }
    }
}
