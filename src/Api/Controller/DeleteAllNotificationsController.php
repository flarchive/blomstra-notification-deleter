<?php

/*
 * This file is part of blomstra/notification-deleter.
 *
 * Copyright (c) 2021 Blomstra Ltd.
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Blomstra\NotificationDeleter\Api\Controller;

use Blomstra\NotificationDeleter\Command\DeleteAllNotifications;
use Flarum\Api\Controller\AbstractDeleteController;
use Flarum\Http\RequestUtil;
use Illuminate\Contracts\Bus\Dispatcher;
use Psr\Http\Message\ServerRequestInterface;

class DeleteAllNotificationsController extends AbstractDeleteController
{
    /**
     * @var Dispatcher
     */
    protected $bus;

    /**
     * @param Dispatcher $bus
     */
    public function __construct(Dispatcher $bus)
    {
        $this->bus = $bus;
    }

    /**
     * {@inheritdoc}
     */
    protected function delete(ServerRequestInterface $request)
    {
        $this->bus->dispatch(
            new DeleteAllNotifications(RequestUtil::getActor($request))
        );
    }
}
