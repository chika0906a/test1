<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'station_id' => 'S0001',
            'station_name' => '横浜駅',
        ];
        DB::table('stations')->insert($param);

        $param = [
            'station_id' => 'S0002',
            'station_name' => '東神奈川駅',
        ];
        DB::table('stations')->insert($param);
    }
}
