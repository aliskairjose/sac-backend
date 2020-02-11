<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('payment_methods')->updateOrInsert(
            [
                'type' => 'Transferencia',
            ]
        );
        DB::table('payment_methods')->updateOrInsert(
            [
                'type' => 'Depósito Bancario',
            ]
        );
        DB::table('payment_methods')->updateOrInsert(
            [
                'type' => 'Pago Movíl',
            ]
        );
    }
}
