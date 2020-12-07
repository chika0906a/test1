<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RecipetitleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'recipe' => 'R0001',
            'recipe_name' => 'オムライス',
            'howto' => 'チキンライスに卵をのせる',
        ];
        DB::table('Recipetitle')->insert($param);

        $param = [
            'recipe' => 'R0002',
            'recipe_name' => '寿司',
            'howto' => '酢飯に魚の切り身をのせる',
        ];
        DB::table('Recipetitle')->insert($param);
    }
}
