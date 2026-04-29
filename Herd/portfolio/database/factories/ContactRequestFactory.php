<?php

namespace Database\Factories;

use App\Enums\ContactRequestStatus;
use App\Models\ContactRequest;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ContactRequest>
 */
class ContactRequestFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->safeEmail(),
            'phone' => fake()->boolean(70) ? fake()->phoneNumber() : null,
            'message' => fake()->paragraph(),
            'status' => ContactRequestStatus::New->value,
            'ip_address' => fake()->ipv4(),
        ];
    }

    public function read(): static
    {
        return $this->state(fn () => ['status' => ContactRequestStatus::Read->value]);
    }

    public function replied(): static
    {
        return $this->state(fn () => ['status' => ContactRequestStatus::Replied->value]);
    }
}
