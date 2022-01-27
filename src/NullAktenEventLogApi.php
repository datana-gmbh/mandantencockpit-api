<?php

declare(strict_types=1);

/*
 * This file is part of Datapool-Api.
 *
 * (c) Datana GmbH <info@datana.rocks>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Datana\Datapool\Api;

use Webmozart\Assert\Assert;

/**
 * @author Oskar Stark <oskarstark@googlemail.com>
 */
final class NullAktenEventLogApi implements AktenEventLogApiInterface
{
    public function log(string $aktenzeichen, string $info, \DateTimeInterface $timestamp, string $creator, ?string $text = null, ?string $html = null, ?array $context = null, ?string $foreignId = null, ?string $foreignType = null): bool
    {
        Assert::stringNotEmpty($aktenzeichen);
        Assert::stringNotEmpty($info);
        Assert::stringNotEmpty($creator);

        if (null !== $text) {
            Assert::stringNotEmpty($text);
        }

        if (null !== $html) {
            Assert::stringNotEmpty($html);
        }

        if (null !== $foreignId) {
            Assert::stringNotEmpty($foreignId);
        }

        if (null !== $foreignType) {
            Assert::stringNotEmpty($foreignType);
        }

        return true;
    }
}
