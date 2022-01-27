<?php

declare(strict_types=1);

/*
 * This file is part of mandantencockpit-api.
 *
 * (c) Datana GmbH <info@datana.rocks>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Datana\Mandantencockpit\Api;

final class NullNotificationsApi implements NotificationsApiInterface
{
    public function sendNotificationForDateneingabe(array $dateneingabe): bool
    {
        return true;
    }

    public function sendReminderForDateneingabe(array $dateneingabe): bool
    {
        return true;
    }
}
