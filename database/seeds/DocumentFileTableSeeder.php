<?php

use Illuminate\Database\Seeder;
use App\Models\DocumentFile;
use Faker\Factory;

class DocumentFileTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        for ($i = 1; $i < 3; $i++) {
            $article1 = new DocumentFile();
            $article1->title = "example$i.docx";
            $article1->file_path = "example$i.docx";
            $article1->price = $faker->numberBetween(1, 100);
            $article1->situation_id = 1;
            $article1->save();
        }
        for ($i = 2; $i < 3; $i++) {
            $article2 = new DocumentFile();
            $article2->title = "example$i.docx";
            $article2->file_path = "example$i.docx";
            $article2->price = $faker->numberBetween(1, 100);
            $article2->situation_id = 3;
            $article2->save();
        }
    }
}
