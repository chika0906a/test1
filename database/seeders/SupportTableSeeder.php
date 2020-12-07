<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SupportTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'support_num' => 1,
            'mail' => 'aiueo@mail.com',
            'support_mail' => 'itoyo123@mail',
            'day' => 20201031,
            'support_text' => 'あいうえお',
        ];
        DB::table('support')->insert($param);

        $param = [
            'support_num' => 2,
            'mail' => 'aiueo@mail.com',
            'support_mail' => 'aiueo999@mail.com',
            'day' => 20201101,
            'support_text' => 'かきくけこ',
        ];
        DB::table('support')->insert($param);


    }
}
