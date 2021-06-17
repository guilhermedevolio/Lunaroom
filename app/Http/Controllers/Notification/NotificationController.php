<?php

namespace App\Http\Controllers\Notification;

use App\Http\Controllers\Controller;
use App\Models\Notification\Notification;
use App\Repositories\NotificationRepository;
use Illuminate\Http\Request;
use Illuminate\View\View;

class NotificationController extends Controller
{
    private NotificationRepository $repository;

    public function __construct()
    {
        $this->repository = app(NotificationRepository::class);
    }

    public function new($user_id, $message)
    {
        $this->repository->create($user_id,$message);
    }

    public function getNotificationsByUserId(): View
    {
        $notifications = $this->repository->getNotificationsByUserId(\Auth::user()->id);
        return view('campus.notification.notifications', compact('notifications'));
    }
}
