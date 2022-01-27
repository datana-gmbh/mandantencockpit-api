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

final class NotificationsApi implements NotificationsApiInterface
{
    private MandantencockpitClient $client;
    private LoggerInterface $logger;

    public function __construct(MandantencockpitClient $client, ?LoggerInterface $logger = null)
    {
        $this->client = $client;
        $this->logger = $logger ?? new NullLogger();
    }

    public function notifyDateneingabe(array $dateneingabe): ResponseInterface
    {
        Assert::notEmpty($dateneingabe);

        try {
            $response = $this->client->request(
                'POST',
                'api/dateneingaben/notification',
                [
                    'json' => $dateneingabe,
                    'query' => [
                        'signature' => $this->generateSignature($dateneingabe),
                    ],
                ]
            );

            $this->logger->debug('Response', $response->toArray(false));

            return $response;
        } catch (\Throwable $e) {
            $this->logger->error($e->getMessage());

            throw $e;
        }
    }

    public function remindDateneingabe(array $dateneingabe): ResponseInterface
    {
        Assert::notEmpty($dateneingabe);

        try {
            $response = $this->client->request(
                'POST',
                '/api/dateneingaben/reminder',
                [
                    'json' => $dateneingabe,
                    'query' => [
                        'signature' => $this->generateSignature($dateneingabe),
                    ],
                ]
            );

            $this->logger->debug('Response', $response->toArray(false));

            return $response;
        } catch (\Throwable $e) {
            $this->logger->error($e->getMessage());

            throw $e;
        }
    }

    private function generateSignature(array $values): string
    {
        return hash(
            'sha256',
            sprintf(
                '%s-%s',
                \Safe\json_encode($values),
                $this->client->secret,
            ),
        );
    }
}
