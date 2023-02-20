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
            'key' => '123',
            'secret' => '123',
            'endpoint' => 'http://oss-cn-shanghai.aliyuncs.com',
        ]);

        $res = $client->signer->signUrl('test', 'user_report_collection/online/101.json');

        $this->assertIsString($res);
    }

    public function testUploaderPut()
    {
        $container = ContainerStub::mockContainer();
        $client = new Client($container, [
            'key' => 'xxx',
            'secret' => 'xxx',
            'endpoint' => 'https://oss-cn-hangzhou.aliyuncs.com',
        ]);

        $fp = fopen(__DIR__ . '/ClientTest.php', 'r+');
        $res = $client->uploader->put('test', 'test.txt', $fp, ['http_errors' => false]);

        $this->assertSame(403, $res->getStatusCode());
    }
}
