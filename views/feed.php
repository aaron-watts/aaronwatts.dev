<?php
header('Content-Type: application/xml; charset=utf-8');
echo '<?xml version="1.0" encoding="utf-8"?>' . PHP_EOL;
?>
<rss xmlns:atom="http://www.w3.org/2005/Atom" xmlns:media="http://search.yahoo.com/mrss/" xmlns:content="http://purl.org/rss/1.0/modules/content/" version="2.0">
  <channel>
  <atom:link href="https://aaronwatts.dev/<?= $url['isBlog'] ? $blog . '/' : '' ?>feed.xml" rel="self" type="applications/rss+xml" />
    <title>AaronWattsDev <?= $url['isBlog'] ? ucfirst($blog) : 'Latest'  ?></title>
    <link>https://aaronwatts.dev<?= $url['isBlog'] ? '/' . $blog : '' ?>/</link>
    <description><?= $blogDesc ?></description>
    <category>Technology</category>
<?php
$x = 0;
foreach($posts as $postName => $post):
    $x++;
    if ($x > 10) {
        break;
    }

    $postInfo = getPostInfo($post['dom']);
    [
        'title' => $title,
        'description' => $description,
        'imgUrl' => $imgUrl,
        'date' => $date,
        'topics' => $topics,
        'sections' => $sections,
        'prismRequired' => $prismRequired
    ] = $postInfo;

    $src = SRC_PATH . $post['blog'] . DIRECTORY_SEPARATOR .$postName . '.html';
    
    if (file_exists($src)) {
        $file = fopen($src, 'r') or die("Unable to open file!");
        $content = fread($file, filesize($src));
        fclose($file);
        $content = preg_replace('/<header>(.|\n)*?<\/header>/', '', $content);
        $content = str_replace(['<', '>'], ['&lt;', '&gt;'], $content);
    }
    
    $baseUrl = 'https://aaronwatts.dev';
    $url = $baseUrl . '/' . $post['blog'] . '/' . $postName;
?>
    <item>
      <title><?= $title ?></title>
      <link><?= $url ?></link>
      <pubDate><?= date('r', strtotime($date)); ?></pubDate>
      <description><?= $description ?></description>
      <guid><?= $url ?></guid>
      <content:encoded><?= trim($content) ?></content:encoded>
      <enclosure url="<?= $imgUrl ?>" type="image/jpeg" length="0" />
      <media:thumbnail url="<?= $imgUrl ?>" width="1920" height="1080" />
      <media:content url="<?= $imgUrl ?>" type="image/jpeg" />
    </item>
<?php endforeach; ?>
  </channel>
</rss>
