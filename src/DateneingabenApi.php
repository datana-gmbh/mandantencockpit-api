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

final class DateneingabenApi implements DateneingabenApiInterface
{
    private MandantencockpitClient $client;
    private LoggerInterface $logger;

    public function __construct(MandantencockpitClient $client, ?LoggerInterface $logger = null)
    {
        $this->client = $client;
        $this->logger = $logger ?? new NullLogger();
    }

    public function sendNotificationForDateneingabe(int $dateneingabeId): bool
    {
        Assert::greaterThan($dateneingabeId, 0);

        $parameters = [
            'id' => $dateneingabeId,
        ];

        try {
            $response = $this->client->request(
                'POST',
                sprintf('/api/dateneingaben/%s/send-notification', $dateneingabeId),
                [
                    'headers' => [
                        'Accept' => 'application/ld+json',
                        'Content-Type' => 'application/ld+json',
                    ],
                    'query' => array_merge($parameters, [
                        'signature' => $this->generateSignature($parameters),
                    ]),
                ]
            );

            $this->logger->debug('Response', $response->toArray(false));

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 300) {
                return false;
            }

            return true;
        } catch (\Throwable $e) {
            $this->logger->error($e->getMessage());

            throw $e;
        }
    }

    public function sendReminderForDateneingabe(int $dateneingabeId): bool
    {
        Assert::greaterThan($dateneingabeId, 0);

        $parameters = [
            'id' => $dateneingabeId,
        ];

        try {
            $response = $this->client->request(
                'POST',
                sprintf('/api/dateneingaben/%s/send-reminder', $dateneingabeId),
                [
                    'headers' => [
                        'Accept' => 'application/ld+json',
                        'Content-Type' => 'application/ld+json',
                    ],
                    'query' => array_merge($parameters, [
                        'signature' => $this->generateSignature($parameters),
                    ]),
                ]
            );

            $this->logger->debug('Response', $response->toArray(false));

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 300) {
                return false;
            }

            return true;
        } catch (\Throwable $e) {
            $this->logger->error($e->getMessage());

            throw $e;
        }
    }

    public function purgeCache(): bool
    {
        $parameters = [];

        try {
            $response = $this->client->request(
                'DELETE',
                '/api/dateneingaben/purge-cache',
                [
                    'headers' => [
                        'Accept' => 'application/ld+json',
                        'Content-Type' => 'application/ld+json',
                    ],
                    'query' => array_merge($parameters, [
                        'signature' => $this->generateSignature($parameters),
                    ]),
                ]
            );

            $this->logger->debug('Response', $response->toArray(false));

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 300) {
                return false;
            }

            return true;
        } catch (\Throwable $e) {
            $this->logger->error($e->getMessage());

            throw $e;
        }
    }

    public function dateneingabeHasChanged(int $dateneingabeId): bool
    {
        Assert::greaterThan($dateneingabeId, 0);

        $parameters = [
            'id' => $dateneingabeId,
        ];

        try {
            $response = $this->client->request(
                'PUT',
                sprintf('/api/dateneingaben/%s/changed', $dateneingabeId),
                [
                    'headers' => [
                        'Accept' => 'application/ld+json',
                        'Content-Type' => 'application/ld+json',
                    ],
                    'query' => array_merge($parameters, [
                        'signature' => $this->generateSignature($parameters),
                    ]),
                ]
            );

            $this->logger->debug('Response', $response->toArray(false));

            if (!\in_array($response->getStatusCode(), [200, 201, 204], true)) {
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
