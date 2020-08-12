<?php

use Illuminate\Database\Seeder;
use App\Models\DocumentKey;

class DocumentKeyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i < 5; $i++) {
            $article1 = new DocumentKey();
            $article1->title = "Имя поля $i";
            $article1->key = "name$i";
            $article1->document_file_id = 1;
            $article1->save();
        }

        for ($i = 1; $i < 5; $i++) {
            $article1 = new DocumentKey();
            $article1->title = "Имя поля $i";
            $article1->key = "name$i";
            $article1->document_file_id = 2;
            $article1->save();
        }

        for ($i = 1; $i < 5; $i++) {
            $article1 = new DocumentKey();
            $article1->title = "Имя поля $i";
            $article1->key = "name$i";
            $article1->document_file_id = 3;
            $article1->save();
        }
    }
}
