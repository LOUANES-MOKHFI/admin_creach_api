<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
           'role-list',
           'admin-list',
           'creche-list',
           'vendeur-list',
           'user-list',
           'blog-list',
           'product-list',
           'offre-list',
           'setting-list',
           'contribution-list',
        ];
        
        foreach ($permissions as $permission) {
             Permission::create(['name' => $permission,'guard_name' => 'admins']);
        }
    }
}
