<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;

class TaskPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function edit(User $user, Task $task)
{
    return $user->hasRole(['admin', 'manager']);
}

public function delete(User $user, Task $task)
{
    return $user->hasRole('admin');
}

}
