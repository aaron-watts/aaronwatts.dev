<?php

declare(strict_types=1);

function getPath(string $uri): string
{
    $path = preg_replace('/\/+/', '/', $uri);
    $path = trim($path, '/');

    return $path;
}

function resolveUrl(string|null $uri): array
{
    $configs = include CONFIG_PATH . 'config.php';
    $url = array();

    if ($uri !== null) {
        $url['path'] = getPath($uri);
        $url['params'] = explode('/', $url['path']);
    } else {
        $url['path'] = '/';
        $url['params'] = array();
    }

    $url['isFeed'] = $url['params'] !== null
        && in_array('feed', $url['params']);
    $url['isBlog'] = $url['params'] !== null
        && in_array($url['params'][0], array_keys($configs['blogs']));
    $url['isPost'] = $url['isBlog']
        && $url['params'] !== null
        && sizeof($url['params']) > 1;

    return $url;
}

function sitemapController(): void
{
    $configs = include CONFIG_PATH . 'config.php';
    require APP_PATH . 'helpers.php';
    $baseUrl = $configs['baseUrl'];

    require VIEWS_PATH . 'sitemap.php';
}

function feedController(array $url): void
{
    $configs = include CONFIG_PATH . 'config.php';
    require APP_PATH . 'helpers.php';
    $posts = array();

    if ($url['isBlog']) {
        $blog = $url['params'][0];
        $posts = [...getBlogPosts($blog)];
        $blogDesc = $configs['blogs'][$blog];
    } else {
        foreach ($configs['blogs'] as $blog => $blogDesc) {
            $posts += [...getBlogPosts($blog)];
        }
        $blogDesc = 'The most recent content on AaronWattsDev';
    }

    uasort($posts, "newestPost");

    require VIEWS_PATH . 'feed.php';
}

function rssController(): void
{
    $configs = include CONFIG_PATH . 'config.php';
    $blogOrder = $configs['blogOrder'];
    $blogs = array();
    foreach ($configs['blogs'] as $blog => $blogDesc) {
        $blogs[$blog] = $blogDesc;
    }

    require VIEWS_PATH . 'rss.php';
}

function blogController(array $url): void
{
    $configs = include CONFIG_PATH . 'config.php';
    require APP_PATH . 'helpers.php';
    $blog = $url['params'][0];
    $blogDesc = $configs['blogs'][$blog];
    $posts = getBlogPosts($blog);
    uasort($posts, "newestPost");

    require VIEWS_PATH . 'blog.php';
}

function postController(array $url): void
{
    require APP_PATH . 'helpers.php';
    $blog = $url['params'][0];
    $post = $url['params'][1];
    $src = SRC_PATH . $blog . DIRECTORY_SEPARATOR . $post . '.html';
    $content = getPost($blog, $post);
    $dom = Dom\HTMLDocument::createFromString($content);
    $postInfo = getPostInfo($dom);
    [
        'title' => $title,
        'description' => $description,
        'imgUrl' => $imgUrl,
        'date' => $date,
        'topics' => $topics,
        'sections' => $sections,
        'prismRequired' => $prismRequired
    ] = $postInfo;
    $jsonLd = getJsonLd($post, $blog, $postInfo);

    require VIEWS_PATH . 'post.php';
}

function homePageController(): void
{
  $configs = include CONFIG_PATH . 'config.php';
  require APP_PATH . 'helpers.php';
  $blogOrder = $configs['blogOrder'];
  
  $blogs = array();
    $posts = array();

    foreach ($configs['blogs'] as $blog => $blogDesc) {
        $posts += [...getBlogPosts($blog)];
        $blogs[$blog] = $blogDesc;
    }
    
    uasort($posts, "newestPost");
    [
        'name' => $name,
        'latest' => $latest
    ] = getNewestPost($posts);

    $postInfo = getPostInfo($latest['dom']);
    [
        'title' => $title,
        'description' => $description,
        'date' => $date,
        'topics' => $topics,
    ] = $postInfo;

    require VIEWS_PATH . 'home.php';

}

function pageNotFoundController(): void
{
    require VIEWS_PATH . '404.php';
}

