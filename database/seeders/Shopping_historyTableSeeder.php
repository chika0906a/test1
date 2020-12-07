<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Shopping_historyTableSeeder extends Seeder
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
            'day' => '20201030',
            'ingredients_id' => '1',
            'quantity' => '100',
        ];
        DB::table('Shopping_history')->insert($param);

        $param = [
            'mail' => 'aiueo@mail.com',
            'day' => '20201031',
            'ingredients_id' => '1',
            'quantity' => '50',
        ];
        DB::table('Shopping_history')->insert($param);
    }
}
