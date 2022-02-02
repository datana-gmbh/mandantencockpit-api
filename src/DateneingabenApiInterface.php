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

/**
 * @author Oskar Stark <oskar.stark@googlemail.de>
 */
interface DateneingabenApiInterface
{
    public function sendNotificationForDateneingabe(int $dateneingabeId): bool;

    public function sendReminderForDateneingabe(int $dateneingabeId): bool;

    public function purgeCache(): bool;
}
