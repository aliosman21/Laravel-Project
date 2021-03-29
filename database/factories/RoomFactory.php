<?php

namespace Database\Factories;

use App\Models\Room;
use App\Models\Floor;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class RoomFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Room::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'number' => $this->faker->unique()->numberBetween(1000, 3500),
            'capacity'=>$this->faker->numberBetween($min = 1, $max = 5),
            'price' => $this->faker->numberBetween($min = 1500, $max = 10000),
            'floor_id' => Floor::all()->random()->id,
            'user_id' => User::all()->random()->id,
        ];
    }
}
