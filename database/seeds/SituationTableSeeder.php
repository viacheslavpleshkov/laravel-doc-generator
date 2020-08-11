<?php

use Illuminate\Database\Seeder;
use App\Models\Situation;
use Faker\Factory;

class SituationTableSeeder extends Seeder
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
            $situation1 = new Situation();
            $situation1->name = "Ситуация $i";
            $situation1->description = $faker->text(30);
            $situation1->price = $faker->numberBetween(1, 100);
            $situation1->type_id = 1;
            $situation1->document_file_id = 1;
            $situation1->save();
        }

        for ($i = 1; $i < 10; $i++) {
            $situation2 = new Situation();
            $situation2->name = "Ситуация $i";
            $situation2->description = $faker->text(30);
            $situation2->price = $faker->numberBetween(1, 100);
            $situation2->type_id = 2;
            $situation2->document_file_id = 2;
            $situation2->save();
        }

        for ($i = 1; $i < 10; $i++) {
            $situation3 = new Situation();
            $situation3->name = "Ситуация $i";
            $situation3->description = $faker->text(30);
            $situation3->price = $faker->numberBetween(1, 100);
            $situation3->type_id = 3;
            $situation3->document_file_id = 3;
            $situation3->save();
        }
    }
}
