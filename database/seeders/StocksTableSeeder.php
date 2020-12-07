<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StocksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param=[
            'mail'=>'aiueo@mail.com',
            'ingredients_id'=>1,
            'quantity'=>0,
        ];
        DB::table('stocks')->insert($param);
        $param=[
            'mail'=>'aiueo@mail.com',
            'ingredients_id'=>2,
            'quantity'=>300,
        ];
        DB::table('stocks')->insert($param);
        }
}
