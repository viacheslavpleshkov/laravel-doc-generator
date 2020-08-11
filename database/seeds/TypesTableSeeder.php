<?php

use Illuminate\Database\Seeder;
use App\Models\Type;

class TypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $type1 = new Type();
        $type1->name = "Юридическое лицо";
        $type1->url = "entity";
        $type1->save();

        $type2 = new Type();
        $type2->name = "Индивидуальный предприниматель";
        $type2->url = "individual-entrepreneur";
        $type2->save();

        $type3 = new Type();
        $type3->name = "Физическое лицо";
        $type3->url = "individual";
        $type3->save();
    }
}
