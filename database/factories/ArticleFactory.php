<?php

namespace Database\Factories;

use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Article::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(), // Quando creo un articolo creerò anche uno user ed una categoria nel database
            'category_id' => Category::factory(),
            'title' => $this->faker->sentence,
            'abstract' => $this->faker->paragraph,
            'contents' => $this->faker->paragraph,
            // 'status' => 'Draft'
        ];
    }
}
