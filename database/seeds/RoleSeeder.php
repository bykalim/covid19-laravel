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
        $roles = ['admin', 'editor', 'citizen'];
        DB::table('roles')->truncate();
        foreach ($roles as $role) {
            DB::table('roles')->insert([
                'name' => $role
            ]);
        }
    }
}
