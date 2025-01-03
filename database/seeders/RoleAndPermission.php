<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class RoleAndPermission extends Seeder
{
    /**
     * Run the database seeds.
     */    
    public function run(): void
    {
        $roles = ['admin', 'user', 'company'];
        foreach($roles as $role)
        {
            if($role == 'company')
            {
                DB::table('roles')->insert([
                    'name'=>$role,
                    'guard_name'=>'companies',
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                ]);
            }
            else{
                DB::table('roles')->insert([
                    'name'=>$role,
                    'guard_name'=>'web',
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                ]);
            }
        }
        
        // $permissions = [
        //     //for company
        //     'create-job','delete-job','edit-job','create-interview',
        //     // for admin
        //     'create-category','delete-category','edit-category','view-category','delete-user','delete-company',
        //     // for user
        //     'create-application','delete-application','edit-application','create-profile','edit-profile',
        // ];
        // foreach($permissions as $permission)
        // {
        //     // permissions for company
        //     if($permission.contains('job')|| $permission.contains('interview'))
        //     {
        //         DB::table('permissions')->insert([
        //             'name'=>$permission,
        //             'guard_name' => 'companies',
        //             'created_at' => date("Y-m-d H:i:s"),
        //             'updated_at' => date("Y-m-d H:i:s"),
        //         ]);
        //     }
        //     // permissions for admin
        //     elseif($permission.contains('category') || $permission.contains('user') || $permission.contains('company'))
        //     {
        //         DB::table('permissions')->insert([
        //             'name'=>$permission,
        //             'guard_name' => 'web',
        //             'created_at' => date("Y-m-d H:i:s"),
        //             'updated_at' => date("Y-m-d H:i:s"),
        //         ]);
        //     }
        //     // permissions for user
        //     else{
        //         DB::table('permissions')->insert([
        //             'name'=>$permission,
        //             'guard_name' => 'web',
        //             'created_at' => date("Y-m-d H:i:s"),
        //             'updated_at' => date("Y-m-d H:i:s"),
        //         ]);
        //     }

        // }
        
    }
}
