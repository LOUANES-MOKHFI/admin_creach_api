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
           'role-create',
           'role-edit',
           'role-delete',
           'admin-list',
           'admin-create',
           'admin-edit',
           'admin-delete',
           'creche-list',
           'creche-create',
           'creche-edit',
           'creche-delete',
           'vendeur-list',
           'vendeur-create',
           'vendeur-edit',
           'vendeur-delete',
           'user-list',
           'user-create',
           'user-edit',
           'user-delete',
           'blog-list',
           'blog-create',
           'blog-edit',
           'blog-delete',
           'product-list',
           'product-create',
           'product-edit',
           'product-delete',
           'offre-list',
           'offre-create',
           'offre-edit',
           'offre-delete',
           'setting-list',
           'setting-create',
           'setting-edit',
           'setting-delete',
           'contribution-list',
           'contribution-create',
           'contribution-edit',
           'contribution-delete'
        ];
        
        foreach ($permissions as $permission) {
             Permission::create(['name' => $permission]);
        }
    }
}
