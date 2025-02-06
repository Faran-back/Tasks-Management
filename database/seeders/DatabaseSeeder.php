<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Laratrust\Models\Role;
use Illuminate\Database\Seeder;
use Laratrust\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //  Task::factory(1)->create();

        $admin = Role::create([
            'name' => 'admin',
            'display_name' => 'Admin'
        ]);

        $manager = Role::create([
            'name' => 'manager',
            'display_name' => 'Manager'
        ]);

        $user = Role::create([
            'name' => 'user',
            'display_name' => 'User'
        ]);

        $allActionOnTasks = Permission::create([
            'name' => 'all actions',
            'display_name' => 'All Actions'
        ]);

        $onlyEditTasks = Permission::create([
            'name' => 'edit tasks',
            'display_name' => 'Edit Tasks'
        ]);

        $viewTasks = Permission::create([
            'name' => 'view tasks',
            'display_name' => 'View Tasks'
        ]);
    }
}
