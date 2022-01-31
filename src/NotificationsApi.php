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
use function Safe\json_encode;
use function Safe\sprintf;
use Webmozart\Assert\Assert;

final class NotificationsApi implements NotificationsApiInterface
{
    private MandantencockpitClient $client;
    private LoggerInterface $logger;

    public function __construct(MandantencockpitClient $client, ?LoggerInterface $logger = null)
    {
        $this->client = $client;
        $this->logger = $logger ?? new NullLogger();
    }

    public function sendNotificationForDateneingabe(array $dateneingabe): bool
    {
        Assert::notEmpty($dateneingabe);

        try {
            $response = $this->client->request(
                'POST',
                '/api/dateneingaben/send-notification',
                [
                    'headers' => [
                        'Accept' => 'application/ld+json',
                        'Content-Type' => 'application/ld+json',
                    ],
                    'json' => $dateneingabe,
                    'query' => [
                        'signature' => $this->generateSignature($dateneingabe),
                    ],
                ]
            );

            $this->logger->debug('Response', $response->toArray(false));

            if (!\in_array($response->getStatusCode(), [200, 201], true)) {
                return false;
            }

            return true;
        } catch (\Throwable $e) {
            $this->logger->error($e->getMessage());

            throw $e;
        }
    }

    public function sendReminderForDateneingabe(array $dateneingabe): bool
    {
        Assert::notEmpty($dateneingabe);

        try {
            $response = $this->client->request(
                'POST',
                '/api/dateneingaben/send-reminder',
                [
                    'headers' => [
                        'Accept' => 'application/ld+json',
                        'Content-Type' => 'application/ld+json',
                    ],
                    'json' => $dateneingabe,
                    'query' => [
                        'signature' => $this->generateSignature($dateneingabe),
                    ],
                ]
            );

            $this->logger->debug('Response', $response->toArray(false));

            if (!\in_array($response->getStatusCode(), [200, 201], true)) {
                return false;
            }

            return true;
        } catch (\Throwable $e) {
            $this->logger->error($e->getMessage());

            throw $e;
        }
    }

    /**
     * @param array<mixed> $values
     */
    private function generateSignature(array $values): string
    {
        return hash(
            'sha256',
            sprintf(
                '%s-%s',
                json_encode($values),
                $this->client->secret,
            ),
        );
    }
}
