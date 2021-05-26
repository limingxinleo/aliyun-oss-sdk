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

interface ClientInterface
{
    // HTTP METHOD
    public const HTTP_GET = 'GET';

    public const HTTP_PUT = 'PUT';

    public const HTTP_HEAD = 'HEAD';

    public const HTTP_POST = 'POST';

    public const HTTP_DELETE = 'DELETE';

    public const HTTP_OPTIONS = 'OPTIONS';

    public const OSS_BUCKET = 'bucket';

    public const OSS_OBJECT = 'object';

    public const OSS_HEADERS = 'headers';

    public const OSS_METHOD = 'method';

    public const OSS_QUERY = 'query';

    public const OSS_BASENAME = 'basename';

    public const OSS_MAX_KEYS = 'max-keys';

    public const OSS_UPLOAD_ID = 'uploadId';

    public const OSS_PART_NUM = 'partNumber';

    public const OSS_COMP = 'comp';

    public const OSS_LIVE_CHANNEL_STATUS = 'status';

    public const OSS_LIVE_CHANNEL_START_TIME = 'startTime';

    public const OSS_LIVE_CHANNEL_END_TIME = 'endTime';

    public const OSS_POSITION = 'position';

    public const OSS_MAX_KEYS_VALUE = 100;

    public const OSS_MAX_OBJECT_GROUP_VALUE = 1000;

    public const OSS_MAX_PART_SIZE = 5368709120; // 5GB

    public const OSS_MID_PART_SIZE = 10485760; // 10MB

    public const OSS_MIN_PART_SIZE = 102400; // 100KB

    public const OSS_FILE_SLICE_SIZE = 8192;

    public const OSS_PREFIX = 'prefix';

    public const OSS_DELIMITER = 'delimiter';

    public const OSS_MARKER = 'marker';

    public const OSS_ACCEPT_ENCODING = 'Accept-Encoding';

    public const OSS_CONTENT_MD5 = 'Content-Md5';

    public const OSS_SELF_CONTENT_MD5 = 'x-oss-meta-md5';

    public const OSS_CONTENT_TYPE = 'Content-Type';

    public const OSS_CONTENT_LENGTH = 'Content-Length';

    public const OSS_IF_MODIFIED_SINCE = 'If-Modified-Since';

    public const OSS_IF_UNMODIFIED_SINCE = 'If-Unmodified-Since';

    public const OSS_IF_MATCH = 'If-Match';

    public const OSS_IF_NONE_MATCH = 'If-None-Match';

    public const OSS_CACHE_CONTROL = 'Cache-Control';

    public const OSS_EXPIRES = 'Expires';

    public const OSS_PREAUTH = 'preauth';

    public const OSS_CONTENT_COING = 'Content-Coding';

    public const OSS_CONTENT_DISPOSTION = 'Content-Disposition';

    public const OSS_RANGE = 'range';

    public const OSS_ETAG = 'etag';

    public const OSS_LAST_MODIFIED = 'lastmodified';

    public const OS_CONTENT_RANGE = 'Content-Range';

    public const OSS_CONTENT = 'content';

    public const OSS_BODY = 'body';

    public const OSS_LENGTH = 'length';

    public const OSS_HOST = 'Host';

    public const OSS_DATE = 'Date';

    public const OSS_AUTHORIZATION = 'Authorization';

    public const OSS_FILE_DOWNLOAD = 'fileDownload';

    public const OSS_FILE_UPLOAD = 'fileUpload';

    public const OSS_PART_SIZE = 'partSize';

    public const OSS_SEEK_TO = 'seekTo';

    public const OSS_SIZE = 'size';

    public const OSS_QUERY_STRING = 'query_string';

    public const OSS_SUB_RESOURCE = 'sub_resource';

    public const OSS_DEFAULT_PREFIX = 'x-oss-';

    public const OSS_CHECK_MD5 = 'checkmd5';

    public const DEFAULT_CONTENT_TYPE = 'application/octet-stream';

    public const OSS_SYMLINK_TARGET = 'x-oss-symlink-target';

    public const OSS_SYMLINK = 'symlink';

    public const OSS_HTTP_CODE = 'http_code';

    public const OSS_REQUEST_ID = 'x-oss-request-id';

    public const OSS_INFO = 'info';

    public const OSS_STORAGE = 'storage';

    public const OSS_RESTORE = 'restore';

    public const OSS_STORAGE_STANDARD = 'Standard';

    public const OSS_STORAGE_IA = 'IA';

    public const OSS_STORAGE_ARCHIVE = 'Archive';

    public const OSS_STORAGE_COLDARCHIVE = 'ColdArchive';

    public const OSS_TAGGING = 'tagging';

    public const OSS_WORM_ID = 'wormId';

    public const OSS_RESTORE_CONFIG = 'restore-config';

    public const OSS_KEY_MARKER = 'key-marker';

    public const OSS_VERSION_ID_MARKER = 'version-id-marker';

    public const OSS_VERSION_ID = 'versionId';

    public const OSS_HEADER_VERSION_ID = 'x-oss-version-id';

    // private URLs
    public const OSS_URL_ACCESS_KEY_ID = 'OSSAccessKeyId';

    public const OSS_URL_EXPIRES = 'Expires';

    public const OSS_URL_SIGNATURE = 'Signature';
}
