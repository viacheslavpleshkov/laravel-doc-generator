<?php

use Illuminate\Database\Seeder;
use App\Models\DocumentFile;

class DocumentFileTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i < 4; $i++) {
            $article1 = new DocumentFile();
            $article1->title = "example$i.docx";
            $article1->file_path = "example$i.docx";
            $article1->save();
        }
    }
}
