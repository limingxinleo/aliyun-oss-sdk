<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
namespace HyperfTest\Cases;

use Fan\OSS\Util\MimeTypes;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 * @coversNothing
 */
class UtilTest extends TestCase
{
    public function testGetMimeType()
    {
        $res = MimeTypes::getMimetype('xxx.jpg');

        $this->assertSame('image/jpeg', $res);
    }
}
