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

use Hyperf\Collection\Collection;
use InvalidArgumentException;

class Config extends Collection
{
    public function __construct($items = [])
    {
        if (! isset($items['key'], $items['secret'], $items['endpoint'])) {
            throw new InvalidArgumentException();
        }
        parent::__construct($items);
    }

    public function getKey(): string
    {
        return (string) $this->get('key');
    }

    public function getSecret(): string
    {
        return (string) $this->get('secret');
    }

    public function getEndpoint(): string
    {
        return (string) $this->get('endpoint');
    }
}
