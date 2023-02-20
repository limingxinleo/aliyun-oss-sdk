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
namespace Fan\OSS\Uploader;

use Fan\OSS\Kernel\Config;
use Fan\OSS\Signer\Signer;

class Uploader
{
    protected Config $config;

    protected Signer $signer;

    public function __construct(Config $config, Signer $signer)
    {
        $this->config = $config;
        $this->signer = $signer;
    }
}
