<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name'      => $this->faker->unique()->company(),
            'email'     => $this->faker->unique()->safeEmail(),
            'logo'      => $this->faker->imageUrl(100, 100, 'companies', true),
            'web_page'  => $this->faker->url
        ];
    }
}
