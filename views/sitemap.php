<?php
header('Content-Type: application/xml; charset=utf-8');
echo '<?xml version="1.0" encoding="utf-8"?>' . PHP_EOL;
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
  <url>
    <loc><?= $baseUrl . '/' ?></loc>
  </url>
  <url>
    <loc><?= $baseUrl . '/rss/' ?></loc>
  </url>
<?php foreach($configs['blogOrder'] as $blog): ?>
  <url>
    <loc><?= $baseUrl . '/' . $blog . '/' ?></loc>
  </url>
  <?php $posts = array();
  $posts = [...getBlogPosts($blog)];
  foreach($posts as $path => $post):
      [ 'date' => $date ] = getPostInfo($post['dom']);
  ?><url>
    <loc><?= $baseUrl . '/' . $path . '/' ?></loc>
    <lastmod><?= date('Y-m-d', strtotime($date)); ?></lastmod>
  </url>
  <?php endforeach; 
endforeach; ?>
</urlset>
