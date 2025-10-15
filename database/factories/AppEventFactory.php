<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Location;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AppEvent>
 */
class AppEventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $start = fake()->dateTime(); // random start time
        $minEnd = (clone $start)->modify('+1 hour'); // minimum +1 hour
        $maxEnd = (clone $start)->modify('+1 week'); // maximum +1 week

        $end = fake()->dateTimeBetween($minEnd, $maxEnd);

        return [
            'title' => $this->faker->sentence(),
            'start_at' => $start,
            'end_at' => $end,
            'location_id' =>  Location::factory()->create()
            
        ];
    }
}
