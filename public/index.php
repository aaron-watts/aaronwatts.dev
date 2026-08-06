<?php

declare(strict_types=1);

$root = dirname(__DIR__) . DIRECTORY_SEPARATOR;

define('CONFIG_PATH', $root . 'config' . DIRECTORY_SEPARATOR);
define('APP_PATH', $root . 'app' . DIRECTORY_SEPARATOR);
define('SRC_PATH', $root . 'src' . DIRECTORY_SEPARATOR);
define('VIEWS_PATH', $root . 'views' . DIRECTORY_SEPARATOR);
define('PARTIALS_PATH', $root . 'partials' . DIRECTORY_SEPARATOR);

require APP_PATH . 'App.php';

if (php_sapi_name() === 'cli') {
    $path = sizeof($argv) > 1 ? $argv[1] : null;
    $url = resolveUrl($path);
} else {
    $url = resolveUrl($_SERVER['PATH_INFO']);
}

if ($url['isFeed']) {
    feedController($url);
} else if ($url['isPost']) {
    postController($url);
} else if ($url['isBlog']) {
    blogController($url);
} else if ($url['path'] === 'rss') {
    rssController();
} else if ($url['path'] === 'sitemap') {
    sitemapController();
} else if ($url['path'] === '/') {
    homePageController();
} else {
    pageNotFoundController();
}

