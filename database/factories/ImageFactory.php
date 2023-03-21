<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
class ImageFactory extends Factory
{
    // /**
    //  * Define the model's default state.
    //  *
    //  * @return array<string, mixed>
    //  */
    public function definition()
    {
        var_dump(date('Y-m-d H:i:s'));
        // dd(date('Y-m-d H:i:s'));
        return [
            "alt" => $this->faker->words(),
            "title" => $this->faker->words(),
            "file_name" => $this->faker->words(),
            "file_size" => [random_int(1, 5242880)],
            // "file_type" => $type[$type_key],
            "image_link" => [$this->faker->imageUrl()],
        ];
    }
}
