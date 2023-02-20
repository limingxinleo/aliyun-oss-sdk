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

use Fan\OSS\Exception\NotFoundException;
use Fan\OSS\Kernel\Config;
use Fan\OSS\Signer\Signer;
use Fan\OSS\Signer\SignerProvider;
use Fan\OSS\Uploader\Uploader;
use Psr\Container\ContainerInterface;

/**
 * @property Config $config
 * @property Signer $signer
 * @property Uploader $uploader
 */
class Client implements ClientInterface
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    protected $providers = [];

    /**
     * @param $config = [
     *     'key' => '', // AccessKeyId
     *     'secret' => '', // AccessSecret
     *     'endpoint' => '', // Endpoint
     * ]
     */
    public function __construct(ContainerInterface $container, array $config = [])
    {
        $this->container = $container;

        $this->registerConfig($config);

        $this->registerDefaultProviders();
    }

    public function __get($name)
    {
        if (! $this->providers[$name]) {
            throw new NotFoundException("{$name} is not found.");
        }

        $provider = $this->providers[$name];
        if ($provider instanceof ServiceProviderInterface) {
            return $this->providers[$name] = $provider($this->container, $this);
        }

        return $this->providers[$name];
    }

    public function __set($name, $value)
    {
        $this->providers[$name] = $value;
    }

    public function register($name, ServiceProviderInterface $provider)
    {
        $this->providers[$name] = $provider;
    }

    protected function registerConfig(array $config): void
    {
        if ($endpoint = $config['endpoint'] ?? null) {
            if (strpos($endpoint, 'http://') === 0) {
                $endpoint = substr($endpoint, strlen('http://'));
                $config['schema'] = 'http';
            } elseif (strpos($endpoint, 'https://') === 0) {
                $endpoint = substr($endpoint, strlen('https://'));
                $config['schema'] = 'https';
            }

            $config['endpoint'] = $endpoint;
        }

        $this->providers['config'] = new Config($config);
    }

    protected function registerDefaultProviders(): void
    {
        $providers = [
            'signer' => SignerProvider::class,
        ];

        foreach ($providers as $name => $provider) {
            $this->register($name, new $provider());
        }
    }
}
