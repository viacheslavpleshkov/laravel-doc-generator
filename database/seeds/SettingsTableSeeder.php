<?php

use Illuminate\Database\Seeder;
use App\Models\Setting;

/**
 * Class SettingsTableSeeder
 */
class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $setting = new Setting();
        $setting->paginate_admin = 50;
        $setting->save();
    }
}