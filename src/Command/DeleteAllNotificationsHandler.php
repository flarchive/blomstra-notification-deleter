<?php

/*
 * This file is part of blomstra/notification-deleter.
 *
 * Copyright (c) 2021 Blomstra Ltd.
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Blomstra\NotificationDeleter\Command;

use Blomstra\NotificationDeleter\Event\DeletedAll;
use Flarum\Notification\Notification;
use Flarum\Notification\NotificationRepository;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Support\Carbon;

class DeleteAllNotificationsHandler
{
    /**
     * @var NotificationRepository
     */
    protected $notifications;

    /**
     * @var Dispatcher
     */
    protected $events;

    /**
     * @param NotificationRepository $notifications
     * @param Dispatcher $events
     */
    public function __construct(NotificationRepository $notifications, Dispatcher $events)
    {
        $this->notifications = $notifications;
        $this->events = $events;
    }

    /**
     * @param DeleteAllNotifications $command
     * @throws \Flarum\User\Exception\PermissionDeniedException
     */
    public function handle(DeleteAllNotifications $command)
    {
        $actor = $command->actor;

        $actor->assertRegistered();

        Notification::where('user_id', $actor->id)->delete();

        $this->events->dispatch(new DeletedAll($actor, Carbon::now()));
    }
}
