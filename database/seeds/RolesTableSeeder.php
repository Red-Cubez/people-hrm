<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use People\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
        	 [
        	 // 'id'=>1
            'name' => 'super-admin',
            'display_name' => 'Super Admin',
            'description'  => 'This is super Admin',
          ],
          [
          	// 'id'=>2,
            'name' => 'admin',
            'display_name' => 'Admin',
            'description'  => 'This is Admin',
          ],

          [
            'name' => 'manager',
            'display_name' => 'Manager',
            'description'  => 'This is manager',
          ],

          [
            'name' => 'hr-manager',
            'display_name' => 'Hr manager',
            'description'  => 'This is hr-manager',
          ],

          [
            'name' => 'client-manager',
            'display_name' => 'Client Manager',
            'description'  => 'This is client-manager',
          ],
          [
            'name' => 'employee',
            'display_name' => 'Employee',
            'description'  => 'This is employee',
          ]
        ];

        foreach ($roles as $role) {
          Role::create($role);
        }
    }
}
