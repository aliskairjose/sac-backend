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
                'name' => 'ROOT',
                'guard_name' => 'ROOT'
            ]
        );
        DB::table('roles')->updateOrInsert(
            [
                'name' => 'ADMIN',
                'guard_name' => 'ADMIN'
            ]
        );
        DB::table('roles')->updateOrInsert(
            [
                'name' => 'OWNER',
                'guard_name' => 'OWNER'
            ]
        );
    }
}
