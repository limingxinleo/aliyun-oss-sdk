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

use Fan\OSS\Client;
use HyperfTest\ContainerStub;

/**
 * @internal
 * @coversNothing
 */
class ClientTest extends AbstractTestCase
{
    public function testClientConstructor()
    {
        $container = ContainerStub::mockContainer();
        $client = new Client($container, [
            'key' => 'xxxx',
            'secret' => 'yyyy',
            'endpoint' => 'zzzz',
        ]);

        $this->assertSame('xxxx', $client->config->get('key'));
        $this->assertSame('yyyy', $client->config->get('secret'));
        $this->assertSame('zzzz', $client->config->get('endpoint'));
    }

    public function testSigner()
    {
        $container = ContainerStub::mockContainer();
        $client = new Client($container, [
            'key' => 'xxxx',
            'secret' => 'yyyy',
            'endpoint' => 'zzzz',
        ]);

        $res = $client->signer->sign('test', 'abc/efg.jpg');

        $this->assertIsString($res);
    }
}
