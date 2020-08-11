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
        $type1->name = "Физическое лицо";
        $type1->url = "individual";
        $type1->save();

        $type2 = new Type();
        $type2->name = "Юридическое лицо";
        $type2->url = "entity";
        $type2->save();

        $type3 = new Type();
        $type3->name = "Индивидуальный предприниматель";
        $type3->url = "individual-entrepreneur";
        $type3->save();
    }
}
