<?php

use Illuminate\Database\Seeder;

class LevelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('levels')->insert([
            'name' => 'Administrator',
            'description' => 'All ACCESS',
        ]);

        DB::table('levels')->insert([
            'name' => 'Level 1',
            'description' => 'Director',
        ]);

        DB::table('levels')->insert([
            'name' => 'Level 2',
            'description' => 'General Manager',
        ]);

        DB::table('levels')->insert([
            'name' => 'Level 3',
            'description' => 'Leader',
        ]);

        DB::table('levels')->insert([
            'name' => 'Level 4',
            'description' => 'Staff',
        ]);
    }
}
