<?php

namespace App\Services\Logics;

use App\Models\Notification;
use App\Models\User;
use App\Traits\DatatableTrait;

class NotificationService
{
    use DatatableTrait;

    /**
     *  Fetch notifications
     *
     *  @param User $user
     *  @return array
     */
    public static function fetchNotifications(User $user): array
    {
        //  Fetch notifications
        $notifications = Notification::query()
            ->where('users_id', $user->id)
            ->get();

        //  Return notifications
        return $notifications->toArray();
    }

    /**
     *  Update notification
     *
     *  @param User $user
     *  @param Notification $notification
     *  @return array
     */
    public static function updateNotification(User $user, Notification $notification): array
    {
        //  Update notification
        $notification->update([
            'is_read'   => true
        ]);

        //  Return notification
        return $notification->toArray();
    }

    /**
     *  Delete notification
     *
     *  @param User $user
     *  @param Notification $notification
     *  @return array
     */
    public static function deleteNotification(User $user, Notification $notification): array
    {
        //  Delete notification
        $notification->delete();

        //  Return notification
        return $notification->toArray();
    }
}
