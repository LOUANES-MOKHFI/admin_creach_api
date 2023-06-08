<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\Admin;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
  

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /* $user = Admin::create([
            'name' => 'louanes mokhfi',
            'email' => 'louanes.mokhfi@gmail.com',
            'password' => bcrypt(123456789)
        ]); */
        $user = Admin::find(1);
        //$role = Role::create(['name' => 'Admin']);
        $role = Role::find(1);
        $permissions = Permission::pluck('id','id')->all();
       
        $role->syncPermissions($permissions);
         
        $user->assignRole([$role->id]);
    }
}
