<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AreasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'area_id' => 'A0001',
            'area_name' => '神奈川県横浜市西区',
        ];
        DB::table('areas')->insert($param);

        $param = [
            'area_id' => 'A0002',
            'area_name' => '東京都渋谷区',
        ];
        DB::table('areas')->insert($param);
    }
}
