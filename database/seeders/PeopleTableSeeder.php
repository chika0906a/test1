<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PeopleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'people_ind' => '1',
            'people_num' => '一人暮らし',
        ];
        DB::table('People')->insert($param);

        $param = [
            'people_ind' => '2',
            'people_num' => '夫婦',
        ];
        DB::table('People')->insert($param);
    }
}
