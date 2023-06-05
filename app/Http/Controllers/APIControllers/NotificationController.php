<?php

namespace App\Http\Controllers\APIControllers;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\User;
use App\Services\Logics\NotificationService;
use App\Traits\DBTransactionTrait;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;

class NotificationController extends Controller
{
    use DBTransactionTrait, ResponseTrait;

    /**
     *  Fetch
     *
     *  @param User $user
     *  @return JsonResponse
     */
    public function fetch(User $user): JsonResponse
    {
        return $this->wrapTransaction(function () use ($user) {
            return $this->responseSuccess(NotificationService::fetchNotifications($user), 'Successfully get user\'s notification data');
        });
    }

    /**
     *  Update
     *
     *  @param User $user
     *  @param Notification $notification
     *  @return JsonResponse
     */
    public function update(User $user, Notification $notification): JsonResponse
    {
        return $this->wrapTransaction(function () use ($user, $notification) {
            return $this->responseSuccess(NotificationService::updateNotification($user, $notification), 'Notification has been updated.');
        });
    }

    /**
     *  Destroy
     *
     *  @param User $user
     *  @param Notification $notification
     *  @return JsonResponse
     */
    public function destroy(User $user, Notification $notification): JsonResponse
    {
        return $this->wrapTransaction(function () use ($user, $notification) {
            return $this->responseSuccess(NotificationService::deleteNotification($user, $notification), 'Notification has been deleted.');
        });
    }
}
