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

use Flarum\User\User;

class DeleteAllNotifications
{
    /**
     * The user performing the action.
     *
     * @var User
     */
    public $actor;

    /**
     * @param User $actor The user performing the action.
     */
    public function __construct(User $actor)
    {
        $this->actor = $actor;
    }
}
