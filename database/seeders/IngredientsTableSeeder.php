<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IngredientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param=[
            'ingredients_id'=>'1',
            'ingredients_name'=>'鶏肉',
            'ingredients_category'=>'肉',
        ];
        DB::table('ingredients')->insert($param);
        $param=[
            'ingredients_id'=>'2',
            'ingredients_name'=>'米',
            'ingredients_category'=>'その他',
        ];
        DB::table('ingredients')->insert($param);
    }
}
