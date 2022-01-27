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

namespace Datana\Mandantencockpit\Api\Tests\Unit;

use PHPUnit\Framework\TestCase;

final class UnitDummyTest extends TestCase
{
    /**
     * @test
     */
    public function dummy(): void
    {
        self::assertTrue(true);
    }
}
