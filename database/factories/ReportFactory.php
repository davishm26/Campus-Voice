<?php

namespace Database\Factories;

use App\Models\Report;
use App\Models\User;
use App\ReportStatus;
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
            'ticket_number' => 'CV-'.fake()->unique()->numerify('######'),
            'title' => fake()->sentence(4),
            'description' => fake()->paragraph(),
            'status' => ReportStatus::Pending,
        ];
    }

    /**
     * Indicate that the report is being processed.
     */
    public function inProgress(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => ReportStatus::InProgress,
        ]);
    }

    /**
     * Indicate that the report has been completed.
     */
    public function completed(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => ReportStatus::Completed,
        ]);
    }
}
