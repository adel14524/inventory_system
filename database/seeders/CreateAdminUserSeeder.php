<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'username' => 'adel1234',
            'first_name' => 'Siti Nur Adilah',
            'last_name' => 'Hasnor',
            'phone' => '0166193668',
            'email' => 'adilah22@gmail.com',
            'password' => bcrypt('zaq1xsw2cde3')
        ]);

        $role = Role::create(['name' => 'Admin']);
        $permissions = Permission::pluck('id','id')->all();
        $role->syncPermissions($permissions);

        $user->assignRole([$role->id]);
    }
}
