<?php

namespace Database\Seeders;
use App\Models\Role;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::firstOrCreate([ 
        //' id' => 1, 
        'role' => 'مدير'
    ]);
        Role::firstOrCreate([ 
           // 'id' => 2,
             'role' => 'مستخدم جديد'
            ]);
        Role::firstOrCreate([
           // 'id' => 3,
             'role' => 'مستخدم فعال'
            ]);


    }
}
