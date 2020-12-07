<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InfoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param=[
            'info_num'=>1,
            'companyuser_id'=>1,
            'day'=>20201105,
            'info_title'=>'割引のご案内',
            'info_text'=>'キャベツ100円',
        ];
        DB::table('info')->insert($param);
        $param=[
            'info_num'=>2,
            'companyuser_id'=>2,
            'day'=>20201106,
            'info_title'=>'お得情報',
            'info_text'=>'レタス150円',
        ];
        DB::table('info')->insert($param);
    }
}