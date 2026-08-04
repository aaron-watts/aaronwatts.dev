<?php

declare(strict_types=1);

function formatDate(string $date): string
{
    return date('jS F, Y', strtotime($date));
}

function preIsUsed(object $dom): bool
{
    $pre = $dom->querySelector('pre');
    
    return $pre !== null ? true : false;
}

function getPostInfo(object $dom): array
{
    $title = $dom->querySelector('h1')->textContent;
    $description = $dom->querySelector('p#description')->textContent;
    $img = $dom->querySelector('img');
    $imgUrl = $img !== null ? $img->getAttribute('src') : "";
    $date = $dom->querySelector('time')->getAttribute('datetime');
    $topics = $dom->querySelectorAll('li.topic');
    $sections = $dom->querySelectorAll('section');
    $prismRequired = preIsUsed($dom);

    return array(
        'title' => $title,
        'description' => $description,
        'imgUrl' => $imgUrl !== null ? $imgUrl : "",
        'date' => $date,
        'topics' => $topics,
        'sections' => $sections,
        'prismRequired' => $prismRequired
    );
}

function getJsonLd(string $post, string $blog, array $postInfo): string
{
    [
        'title' => $title,
        'description' => $description,
        'imgUrl' => $imgUrl,
        'date' => $date,
        'topics' => $topics
    ] = $postInfo;

    return '{
  "@context": "http://schema.org",
  "@type": "Article",
  "mainEntityOfPage": {
    "@type": "WebPage",
    "@id": "https://aaronwatts.dev/' . $blog . '/' . $post . '/"
  },
  "headline": "' . $title . '"
  "datePublished": "' . $date . '",
  "description": "' . $description . '",
  "image": [
      https://aaronwatts.dev' . $imgUrl . '
  ],
  "author": {
    "@type": "Person",
    "name": "aaronwatts@dev"
  }
}'; 
}

function newestPost(array $a, array $b): int
{
    $ad = $a['dom']->querySelector('time')->getAttribute('datetime');
    $bd = $b['dom']->querySelector('time')->getAttribute('datetime');

    if ($ad === $bd) {
        return 0;
    }

    return ($ad > $bd) ? -1 : 1;
}

function getNewestPost(array $posts): array {
    $x = 0;
    foreach ($posts as $postName => $post) {
        $name = $postName;
        $latest = $post;
        $x++;
        if ($x > 0) {
            break;
        }
    }
    return [
        'name' => $name,
        'latest' => $latest
    ];
}

function getPost(string $blog, string $post): string
{
    $src = SRC_PATH . $blog . DIRECTORY_SEPARATOR .$post . '.html';

    if (file_exists($src)) {
        $file = fopen($src, 'r') or die("Unable to open file");
        $content = fread($file, filesize($src));
        fclose($file);
        return $content;
    } else {
        return 'Error loading ' . $src;
    }
}

function getBlogPosts(string $blog): array
{
    $dir = SRC_PATH . $blog . DIRECTORY_SEPARATOR; 
    $files = scandir($dir);
    $posts = array();

    foreach ($files as $file) {
        $path = $dir . $file;

        if (is_file($path) && substr($file, -5) === '.html') {
            $dom = Dom\HTMLDocument::createFromFile($path);
            $postName = str_replace('.html', '', $file);
            $posts[$postName] = [
                'dom' => $dom,
                'blog' => $blog
            ];
        }
    }

    return $posts;
}


