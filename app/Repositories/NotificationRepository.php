<?php

namespace App\Repositories;

use App\Models\Notification\Notification;
use App\Models\User;

class NotificationRepository
{
    protected Notification $model;

    public function __construct(Notification $model)
    {
        $this->model = $model;
    }

    public function create($user_id, $message)
    {
        return $this->model->create(['user_id' => $user_id, 'message' => $message]);
    }

    public function getNotificationsByUserId($userId)
    {
        return $this->model->where('user_id', $userId)->paginate(5);
    }
}
