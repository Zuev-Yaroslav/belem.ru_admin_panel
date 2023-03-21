<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Possibility>
 */
class PermissionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        // $possibilities = array(
        //     'create_news',
        //     'edit_news',
        //     'delete_news',
        //     'create_post',
        //     'edit_post',
        //     'delete_post',
        //     'add_role_to_users',
        // );
        return [
            // 'possibility_name' => $this->faker->word(),
            'description' => $this->faker->text(),
        ];
    }
}
