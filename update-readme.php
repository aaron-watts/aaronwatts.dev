<?php

$rss = simplexml_load_file('dist/feed.xml') or die('Error: Cannot create object');

$item = $rss->channel->item[0];

$title = $item->title;
$link = $item->link;
$pubDate = date_create($item->pubDate);

$file = 'readme.md';

$content = file_get_contents($file);

$pattern = '/(<div\s+id="latest"[^>]*>).*?(<\/div>)/s';

$newContent = '<a href="' . $link . '">' . date_format($pubDate, 'Y-m-d') . ' | ' . $title . '</a>';

$content = preg_replace(
  $pattern,
  '$1' . "\n    " . $newContent . "\n" . '$2',
  $content,
  1
);

file_put_contents($file, $content);
