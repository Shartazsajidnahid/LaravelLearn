<?php

use Illuminate\Database\Seeder;

class OtherAccessRules extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $path = 'database/seeds/raw/other_access_rules.sql';
        DB::unprepared(file_get_contents($path));
    }
}
