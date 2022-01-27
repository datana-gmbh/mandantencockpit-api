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

use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;
use function Safe\sprintf;
use Symfony\Contracts\HttpClient\ResponseInterface;
use Webmozart\Assert\Assert;

final class NullNotificationsApi implements NotificationsApiInterface
{
    public function notifyDateneingabe(array $dateneingabe): bool
    {
        return true;
    }

    public function remindDateneingabe(array $dateneingabe): bool
    {
        return true;
    }
}
