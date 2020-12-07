<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'companyuser_id' => 1,
            'password' => 'kkk123',
            'company_name' => 'イトーヨーカドー川崎店',
            'company_mail' => 'itoyo@mail.com'
        ];
        DB::table('companies')->insert($param);

        $param = [
            'companyuser_id' => 2,
            'password' => 'aiu356',
            'company_name' => 'セブンイレブン横浜店',
            'company_mail' => 'seven@mail.com'
        ];
        DB::table('companies')->insert($param);


    }
}
