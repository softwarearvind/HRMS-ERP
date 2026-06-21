<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         Role::create(['name' => 'Super Admin']);
    Role::create(['name' => 'HR Manager']);
    Role::create(['name' => 'Manager']);
    Role::create(['name' => 'Employee']);
    }
}
