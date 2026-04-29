<?php

namespace Database\Factories;

use App\Enums\ServiceRequestBudgetRange;
use App\Enums\ServiceRequestProjectType;
use App\Enums\ServiceRequestStatus;
use App\Models\ServiceRequest;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ServiceRequest>
 */
class ServiceRequestFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->safeEmail(),
            'company' => fake()->boolean(65) ? fake()->company() : null,
            'project_type' => fake()->randomElement(ServiceRequestProjectType::cases())->value,
            'budget_range' => fake()->randomElement(ServiceRequestBudgetRange::cases())->value,
            'description' => fake()->paragraph(),
            'status' => ServiceRequestStatus::New->value,
            'ip_address' => fake()->ipv4(),
        ];
    }

    public function inReview(): static
    {
        return $this->state(fn () => ['status' => ServiceRequestStatus::InReview->value]);
    }

    public function replied(): static
    {
        return $this->state(fn () => ['status' => ServiceRequestStatus::Replied->value]);
    }

    public function closed(): static
    {
        return $this->state(fn () => ['status' => ServiceRequestStatus::Closed->value]);
    }
}
