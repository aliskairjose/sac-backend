<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('banks')->updateOrInsert(
            [
                'name' => 'Banco de Venezuela',
            ]
        );
        DB::table('banks')->updateOrInsert(
            [
                'name' => 'Banco Provincial',
            ]
        );
        DB::table('banks')->updateOrInsert(
            [
                'name' => 'Banco Mercantil',
            ]
        );
        DB::table('banks')->updateOrInsert(
            [
                'name' => 'Banco del Tesoro',
            ]
        );
        DB::table('banks')->updateOrInsert(
            [
                'name' => 'Banco Occidental de Descuento - BOD',
            ]
        );
        DB::table('banks')->updateOrInsert(
            [
                'name' => 'Banco Fondo Común - BFC',
            ]
        );
        DB::table('banks')->updateOrInsert(
            [
                'name' => 'Banco Nacional de Crédido - BNC',
            ]
        );
        DB::table('banks')->updateOrInsert(
            [
                'name' => 'Banesco',
            ]
        );
        DB::table('banks')->updateOrInsert(
            [
                'name' => 'Banplus',
            ]
        );
        DB::table('banks')->updateOrInsert(
            [
                'name' => '100% Banco',
            ]
        );
        DB::table('banks')->updateOrInsert(
            [
                'name' => 'Banco Industrial de Venezuela',
            ]
        );
        DB::table('banks')->updateOrInsert(
            [
                'name' => 'Banco Bicentenario',
            ]
        );
        DB::table('banks')->updateOrInsert(
            [
                'name' => 'Banco Bicentenario',
            ]
        );
    }
}
