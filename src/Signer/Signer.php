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
use Fan\OSS\Kernel\Config;

class Signer
{
    protected $config;

    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    public function sign(string $bucket, string $object, $method = Client::HTTP_GET, array $headers = []): array
    {
        $bucket = ltrim($bucket, '/');
        $hostname = $this->getHostname($bucket);
        $headers = $this->getHeaders($hostname, $headers);
        $object = $this->generateResourceUri($object);

        $body = $method . "\n" . $this->generateHeaders($headers) . '/' . $bucket . $object;

        $signature = base64_encode(hash_hmac('sha1', $body, $this->config->getSecret(), true));

        return [$hostname, $object, $signature];
    }

    public function signUrl(string $bucket, string $object, float $timeout = 60, $method = Client::HTTP_GET)
    {
        $timeout = strval(time() + $timeout);
        [$hostname, $object, $signature] = $this->sign($bucket, $object, $method, [
            Client::OSS_CONTENT_TYPE => '',
            Client::OSS_DATE => $timeout,
        ]);

        $query = [
            Client::OSS_URL_ACCESS_KEY_ID => $this->config->getKey(),
            Client::OSS_URL_EXPIRES => $timeout,
            Client::OSS_URL_SIGNATURE => $signature,
        ];

        return $this->getSchema() . '://' . $hostname . $object . '?' . http_build_query($query);
    }

    public function getSchema(): string
    {
        return $this->config->get('schema', 'http');
    }

    public function getHostname(string $bucket)
    {
        if (empty($bucket)) {
            return $this->config->getEndpoint();
        }

        return $bucket . '.' . $this->config->getEndpoint();
    }

    public function generateResourceUri(string $object): string
    {
        return '/' . str_replace(['%2F', '%25'], ['/', '%'], rawurldecode($object));
    }

    public function generateHeaders(array $headers): string
    {
        uksort($headers, 'strnatcasecmp');

        $result = '';
        foreach ($headers as $key => $value) {
            $value = str_replace(["\r", "\n"], '', $value);
            $key = strtolower($key);

            if (in_array($key, ['content-md5', 'content-type', 'date'])) {
                $result .= $value . "\n";
            } elseif (substr($key, 0, 6) === Client::OSS_DEFAULT_PREFIX) {
                $result .= $key . ':' . $value . "\n";
            }
        }

        return $result;
    }

    public function getHeaders(string $hostname, array $headers = []): array
    {
        return array_merge([
            Client::OSS_CONTENT_MD5 => '',
            Client::OSS_CONTENT_TYPE => Client::DEFAULT_CONTENT_TYPE,
            Client::OSS_DATE => gmdate('D, d M Y H:i:s \G\M\T'),
            Client::OSS_HOST => $hostname,
        ], $headers);
    }
}
