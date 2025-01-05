<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class UserAccessPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Model $model): bool
    {
        return $user->id === $model->user_id;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Model $model): bool
    {
        return $user->id === $model->user_id;
    }

    public function delete(User $user, Model $model): bool
    {
        return $user->id === $model->user_id;
    }

    public function restore(User $user, Model $model): bool
    {
        return $user->id === $model->user_id;
    }

    public function forceDelete(User $user, Model $model): bool
    {
        return $user->id === $model->user_id;
    }
}
