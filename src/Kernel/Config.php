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
namespace Fan\OSS\Kernel;

use Hyperf\Utils\Collection;

/**
 * @property $items = [
 *     'key' => '',
 *     'secret' => '',
 *     'endpoint' => '',
 * ]
 */
class Config extends Collection
{
    public function getKey(): string
    {
        return $this->get('key');
    }

    public function getSecret(): string
    {
        return $this->get('secret');
    }

    public function getEndpoint(): string
    {
        return $this->get('endpoint');
    }
}
