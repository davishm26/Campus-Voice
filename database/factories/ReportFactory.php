<?php

namespace Database\Factories;

use App\Models\Report;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Report>
 */
class ReportFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'category' => fake()->randomElement([
                'Fasilitas Kampus',
                'Akademik & Perkuliahan',
                'Kebersihan Lingkungan',
                'Keamanan & Ketertiban',
                'Layanan Administrasi',
            ]),
            'title' => fake()->sentence(4),
            'description' => fake()->paragraphs(2, true),
            'location' => fake()->randomElement(['Kelas 2.18', 'Perpustakaan Lt. 2', 'Kantin', 'Laboratorium Komputer']),
            'attachment_path' => null,
            'attachment_original_name' => null,
            'is_anonymous' => false,
            'status' => 'pending',
            'admin_response' => null,
        ];
    }

    /**
     * Indicate that the report is anonymous.
     */
    public function anonymous(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_anonymous' => true,
        ]);
    }

    /**
     * Indicate that the report is resolved.
     */
    public function resolved(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'resolved',
            'admin_response' => 'Terima kasih atas laporannya. Masalah telah diselesaikan oleh tim teknis sarana & prasarana.',
        ]);
    }
}
