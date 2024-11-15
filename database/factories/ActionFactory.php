<?php

namespace Database\Factories;

use App\Models\Complaint;
use App\Models\ActionStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Action>
 */
class ActionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'description' => fake()->sentence(),
            'complaint_id' => Complaint::pluck('id')->random(),
            'action_status_id' => ActionStatus::pluck('id')->random(),
        ];
    }
}
