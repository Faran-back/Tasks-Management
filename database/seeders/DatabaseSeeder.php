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
         User::factory(5)->create();

  {

        // // Create Roles
        // $admin = Role::create(['name' => 'admin', 'display_name' => 'Administrator']);
        // $manager = Role::create(['name' => 'manager', 'display_name' => 'Manager']);
        // $user = Role::create(['name' => 'user', 'display_name' => 'User']);

        // // Create Permissions
        // $allActionsOnTasks = Permission::create(['name' => 'all-actions', 'display_name' => 'All Actions']);
        // $editTasks = Permission::create(['name' => 'edit-tasks', 'display_name' => 'Edit Tasks']);
        // $viewTasks = Permission::create(['name' => 'view-tasks', 'display_name' => 'View Tasks']);

        // // Assign Permissions to Roles
        // $admin->givePermission([$allActionsOnTasks]); // Admin has all permissions
        // $manager->givePermission([$editTasks]); // Manager can view and edit
        // $user->givePermission([$viewTasks]); // User can only view

        // // Assign Roles to Users (example users)
        // $adminUser = User::find(1); // Replace with actual user ID
        // $managerUser = User::find(2);
        // $normalUser = User::find(3);

        // $adminUser?->assignRole('admin');
        // $managerUser?->assignRole('manager');
        // $normalUser?->assignRole('user');
    }
}

    }

