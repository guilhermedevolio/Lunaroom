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
        return $this->model->limit(3)->orderBy('id', 'DESC')->get();
    }

    public function getUserById(int $userId)
    {
        return $this->model->with(['courses'])->findOrFail($userId);
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
