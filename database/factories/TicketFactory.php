<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Ticket;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ticket>
 */
class TicketFactory extends Factory
{
    protected $model = Ticket::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        //Defino opciones válidas para el campo de estatus
        $status_options = [
            'open',
            'closed'
        ];

        return [
            'username' => fake()->name(),
            'description' => fake()->sentence(45),
            'status' => $status_options[array_rand($status_options)]
        ];
    }
}
