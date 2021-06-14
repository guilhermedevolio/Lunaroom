<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    protected $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function getUsers()
    {
        $model = $this->model->all();

        $users = [];
        $admins = [];

        foreach ($model as $user) {
            if ($user->admin) {
                array_push($admins, $user);
            }
            if (!$user->admin) {
                array_push($users, $user);
            }
        }

        return ["users" => $users, "admins" => $admins];
    }

    public function getUserById(int $userId)
    {
        return $this->model->with('wallet')->findOrFail($userId);
    }

    public function updateUser(int $userId, array $payload): bool
    {
        $user = $this->getUserById($userId);
        return $user->update($payload);
    }

    public function deleteUser(int $userId): bool
    {
        $user = $this->getUserById($userId);
        return $user->delete();
    }
}
