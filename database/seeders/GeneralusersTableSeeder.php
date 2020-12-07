<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GeneralusersTableSeeder extends Seeder
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
            'password' => '12345',
            'gender' => 'man',
            'date' => '20000101',
            'area_id' => 'A0001',
            'station_id' => 'S0002',
            'people_ind' => '2',
            'nickname' => 'あいうえお',
            
        ];
        DB::table('generalusers')->insert($param);
        $param = [
            'mail' => 'nnnnn@mail.com',
            'password' => '9999',
            'gender' => 'woman',
            'date' => '20001031',
            'area_id' => 'A0002',
            'station_id' => 'S0002',
            'people_ind' => '1',
            'nickname' => 'やまだ',
        ];
        DB::table('generalusers')->insert($param);
    }
}
