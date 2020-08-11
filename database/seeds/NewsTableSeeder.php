<?php

use Illuminate\Database\Seeder;
use App\Models\News;
use Faker\Factory;

class NewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        for ($i = 1; $i < 10; $i++) {
            $article1 = new News();
            $article1->title = $faker->text(9);
            $article1->url = "news$i";
            $article1->text = $faker->text(10000);
            $article1->save();
        }
    }
}
