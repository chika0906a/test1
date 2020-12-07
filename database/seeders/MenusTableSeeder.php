<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'mail' => 'aiueo@mail.com',
            'day' => '20201101',
            'recipe' => 'R0001',
        ];
        DB::table('Menus')->insert($param);

        $param = [
            'mail' => 'aiueo@mail.com',
            'day' => '20201102',
            'recipe' => 'R0002',
        ];
        DB::table('Menus')->insert($param);
    }
}
