<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesTableSeeder::class);
        $this->call(SettingsTableSeeder::class);
        $this->call(TypesTableSeeder::class);
        $this->call(NewsTableSeeder::class);
        $this->call(SituationTableSeeder::class);
        $this->call(DocumentFileTableSeeder::class);
        $this->call(DocumentKeyTableSeeder::class);
    }
}
