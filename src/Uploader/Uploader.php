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

use Fan\OSS\Client as OSSClient;
use Fan\OSS\Kernel\Config;
use Fan\OSS\Signer\Signer;
use Fan\OSS\Util\MimeTypes;
use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;

class Uploader
{
    protected Config $config;

    protected Signer $signer;

    public function __construct(Config $config, Signer $signer)
    {
        $this->config = $config;
        $this->signer = $signer;
    }

    /**
     * @param mixed $content 待上传的内容
     */
    public function put(string $bucket, string $object, $content, array $options = []): ResponseInterface
    {
        if (! isset($options['headers']['Content-Length']) && is_string($content)) {
            $options['headers']['Content-Length'] = strlen($content);
        }

        if (! isset($options['Content-Type'])) {
            $options['headers']['Content-Type'] = $this->getMimeType($object);
        }

        [$hostname, $object, $signature, $headers] = $this->signer->sign($bucket, $object, 'PUT', $options['headers'] ?? []);

        $headers[OSSClient::OSS_AUTHORIZATION] = 'OSS ' . $this->config->getKey() . ':' . $signature;

        $uri = $this->signer->getSchema() . '://' . $hostname . $object;

        return $this->client()->request('PUT', $uri, array_merge($options, [
            'headers' => $headers,
            'body' => $content,
        ]));
    }

    protected function getMimeType(string $object)
    {
        return MimeTypes::getMimetype($object) ?? 'application/octet-stream';
    }

    protected function client()
    {
        return new Client();
    }
}
