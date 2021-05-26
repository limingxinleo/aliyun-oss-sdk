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
namespace Fan\OSS;

use Psr\Container\ContainerInterface;

interface ServiceProviderInterface
{
    /**
     * @return mixed
     */
    public function __invoke(ContainerInterface $container, Client $client);
}
