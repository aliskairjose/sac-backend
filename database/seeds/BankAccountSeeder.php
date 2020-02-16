<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BankAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('bank_accounts')->insert(
            [
                'bank_id' => '3',
                'building_id' => '1',
                'account_number' => '01050012560012425515',
                'type' => 'Corriente',
                'name' => 'Numidia Ugueto',
                'rif' => '12345678',
                'pago_movil' => true,
            ]
        );
    }
}
