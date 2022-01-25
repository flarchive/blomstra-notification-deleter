<?php

/*
 * This file is part of blomstra/notification-deleter.
 *
 * Copyright (c) 2021 Blomstra Ltd.
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Blomstra\NotificationDeleter\Event;

use DateTime;
use Flarum\User\User;

class DeletedAll
{
    /**
     * @var User
     */
    public $actor;

    /**
     * @var DateTime
     */
    public $timestamp;

    public function __construct(User $user, DateTime $timestamp)
    {
        $this->user = $user;
        $this->timestamp = $timestamp;
    }
}
