<?php

## Config
const BASE_URL = "http://localhost/php-project/";

function sanitize_base_url(string $baseUrl)
{
    return rtrim($baseUrl, '/ ') . '/';
}

function redirect(string $url): void
{
    header("Location: " . sanitize_base_url(BASE_URL) . trim($url, '/ '));
    exit;
}

function asset(string $relative_path)
{
    return sanitize_base_url(BASE_URL) . trim($relative_path, '/ ');
}

function url(string $url)
{
    return sanitize_base_url(BASE_URL) . trim($url, '/ ');
}

function dd(mixed $var)
{
    echo '<pre>';
    var_dump($var);
    echo '</pre>';
    exit;
}
