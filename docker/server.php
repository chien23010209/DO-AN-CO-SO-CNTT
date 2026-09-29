<?php

$publicPath = dirname(__DIR__).'/public';
$storagePath = dirname(__DIR__).'/storage/app/public';

$uri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?? '');

if (str_starts_with($uri, '/storage/')) {
    $relativePath = ltrim(substr($uri, strlen('/storage/')), '/');
    $storageRoot = realpath($storagePath);
    $filePath = $storageRoot ? realpath($storageRoot.'/'.$relativePath) : false;

    if ($storageRoot && $filePath && str_starts_with($filePath, $storageRoot.DIRECTORY_SEPARATOR) && is_file($filePath)) {
        header('Content-Type: '.(mime_content_type($filePath) ?: 'application/octet-stream'));
        header('Content-Length: '.filesize($filePath));

        if ($_SERVER['REQUEST_METHOD'] !== 'HEAD') {
            readfile($filePath);
        }

        exit;
    }

    http_response_code(404);
    exit;
}

if ($uri !== '/' && file_exists($publicPath.$uri)) {
    return false;
}

require_once $publicPath.'/index.php';
