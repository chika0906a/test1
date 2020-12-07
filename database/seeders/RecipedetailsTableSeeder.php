<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RecipedetailsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param=[
            'recipe'=>'R0001',
            'ingredients_id'=>1,
            'quantity'=>100,
        ];
        DB::table('recipedetails')->insert($param);
        $param=[
            'recipe'=>'R0001',
            'ingredients_id'=>2,
            'quantity'=>150,
        ];
        DB::table('recipedetails')->insert($param);
    }
}
