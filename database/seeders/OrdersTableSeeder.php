<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrdersTableSeeder extends Seeder
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
            'ingredients_id' => '1',
            'quantity' => '100',
        ];
        DB::table('Orders')->insert($param);

        $param = [
            'mail' => 'aiueo@mail.com',
            'ingredients_id' => '2',
            'quantity' => '150',
        ];
        DB::table('Orders')->insert($param);
    }
}
