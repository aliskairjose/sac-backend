<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->updateOrInsert(
            [
                'name' => 'soot',
                'guard_name' => 'soor'
            ]
        );
        DB::table('roles')->updateOrInsert(
            [
                'name' => 'admin',
                'guard_name' => 'admin'
            ]
        );
        DB::table('roles')->updateOrInsert(
            [
                'name' => 'aowner',
                'guard_name' => 'owner'
            ]
        );
    }
}
