<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'username' => 'adm',
            'email' => 'support@garditour.co.id',
            'password' => bcrypt('adm123'),
            'fullname' => 'Administrator',
            'phone' => '081806088804',
            'avatar' => '',
            'level' => '1'
        ]);
        DB::table('users')->insert([
            'username' => 'bdo',
            'email' => 'support@garditour.co.id',
            'password' => bcrypt('bdo123'),
            'fullname' => 'BDO',
            'phone' => '081806088804',
            'avatar' => '',
            'level' => '2'
        ]);
        DB::table('users')->insert([
            'username' => 'gm',
            'email' => 'support@garditour.co.id',
            'password' => bcrypt('gm123'),
            'fullname' => 'General Manager',
            'phone' => '081806088804',
            'avatar' => '',
            'level' => '3'
        ]);
        DB::table('users')->insert([
            'username' => 'spvtour',
            'email' => 'support@garditour.co.id',
            'password' => bcrypt('spvtour123'),
            'fullname' => 'Administrator',
            'phone' => '081806088804',
            'avatar' => '',
            'level' => '4'
        ]);
        DB::table('users')->insert([
            'username' => 'tourstaff1',
            'email' => 'support@garditour.co.id',
            'password' => bcrypt('tourstaff123'),
            'fullname' => 'Administrator',
            'phone' => '081806088804',
            'avatar' => '',
            'level' => '5'
        ]);
    }
}
