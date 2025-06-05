<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $gender = fake()->randomElement(['ذكر', 'أنثى']);
        $role = fake()->randomElement(['خادم', 'مخدوم']);
        return [
            'full_name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
            'phone' => fake()->phoneNumber(),
            'whatsapp' => '010' . fake()->numberBetween(10000000, 99999999),
            'relative_phone' => '010' . fake()->numberBetween(10000000, 99999999),
            'address' => fake()->address(),
            'confession_father' => fake()->name(),
            'dob' => fake()->date('Y-m-d', '-10 years'),
            'gender' => $gender,
            'role' => $role,
            'serving_classes' => null,
            'my_class_id' => null,
            'is_deacon' => fake()->boolean(),
            'ordination_date' => null,
            'ordination_bishop' => null,
            'deacon_rank' => null,
            'code' => Str::random(8),
            'profile_image' => null,
            'is_admin' => false,
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
