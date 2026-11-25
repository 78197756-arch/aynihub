<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/** @extends Factory<User> */
class UserFactory extends Factory
{
    protected $model = User::class;
    private static ?string $password = null;

    public function definition(): array
    {
        $contact = fake()->unique()->safeEmail();

        return [
            'name'     => fake()->name(),
            'contact'  => $contact,
            'email'    => $contact,
            'password' => self::$password ??= Hash::make('Clave1234'),
            'role'     => 'comprador',
            'location' => null,
        ];
    }

    public function productor(): static
    {
        return $this->state(fn () => ['role' => 'productor', 'location' => 'Chinchero, Cusco']);
    }

    public function gestor(): static
    {
        return $this->state(fn () => ['role' => 'gestor']);
    }
}
