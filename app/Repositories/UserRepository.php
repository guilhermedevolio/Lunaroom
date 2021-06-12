<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    protected $model;

    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function getUsers()
    {
        return $this->model->all();
    }

    public function getUserById(int $userId)
    {
        return $this->model->findOrFail($userId);
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
