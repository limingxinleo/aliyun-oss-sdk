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
namespace Fan\OSS\Signer;

use Fan\OSS\Client;
use Fan\OSS\ServiceProviderInterface;
use Psr\Container\ContainerInterface;

class SignerProvider implements ServiceProviderInterface
{
    public function __invoke(ContainerInterface $container, Client $client)
    {
        return new Signer($client->config);
    }
}
