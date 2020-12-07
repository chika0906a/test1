<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InfoareasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'info_num' => '1',
            'station_id' => 'S0001',
        ];
        DB::table('Infoareas')->insert($param);

        $param = [
            'info_num' => '2',
            'station_id' => 'S0002',
        ];
        DB::table('Infoareas')->insert($param);
    }
}
