<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="description" content="<?= $description ?>"/>
    <meta name="keywords" content="<?php
    for ($x = 0; $x < sizeof($topics); $x++) {
        if($x > 0) {
            echo ', ';
        }
        echo $topics[$x]->textContent;
    }
    ?>"/>

    <title>AWD - <?= $title ?></title>

    <link rel="apple-touch-icon" sizes="180x180" href="/images/apple-touch-icon.png"/>
    <link rel="icon" type="image/png" sizes="32x32" href="/images/favicon-32x32.png"/>
    <link rel="icon" type="image/png" sizes="16x16" href="/images/favicon-16x16.png"/>
    <link rel="manifest" href="/site.webmanifest"/>

    <link rel="canonical" href="https://aaronwatts.dev/<?= $blog . '/' . $post ?>"/>
    <link href="https://aaronwatts.dev/feed.xml" rel="alternate" title="AaronWattsDev RSS Feed - All" type="application/rss+xml"/>
    <link href="https://aaronwatts.dev/blog/feed.xml" rel="alternate" title="AaronWattsDev RSS Feed - Blog" type="application/rss+xml"/>
    <link href="https://aaronwatts.dev/guides/feed.xml" rel="alternate" title="AaronWattsDev RSS Feed - Guides" type="application/rss+xml"/>
    <link href="https://aaronwatts.dev/tech/feed.xml" rel="alternate" title="AaronWattsDev RSS Feed - Tech" type="application/rss+xml"/>

    <meta property="og:title" content="<?= $title ?>"/>
    <meta property="og:site_name" content="aaronwatts@dev"/>
    <meta property="og:description" content="<?= $description ?>"/>
    <meta property="og:url" content="https://aaronwatts.dev/<?= $blog . '/' . $post ?>"/>
<?php if ($imgUrl !== ""): ?>
    <meta property="og:image" content="<?= $imgUrl ?>"/>
<?php endif; ?>
    <meta property="og:type" content="article"/>
    <meta property="og:article:published_time" content="<?= $date ?>"/>

    <link rel="preload" href="/assets/fonts/JetBrainsMono.woff2" as="font" type="font/woff2" crossorigin />
    <?php
        if ($prismRequired === true) {
            echo '<link rel="stylesheet" href="/assets/styles/prism.css">';
        }
    ?>

    <link rel="stylesheet" href="/assets/styles/style.css">
    <link rel="stylesheet" href="/assets/styles/comments.css">

        <script type="application/ld+json"><?= $jsonLd ?></script>
  </head>
  <body>
    <header>
      <nav aria-label="Breadcrumb">
        <ol>
          <li><a 
              href="/">aaronwatts@dev</a></li><span
              aria-hidden="true" class="term-dir"></span><li><span
              aria-hidden="true" class="breadcrumb--seperator"></span><a 
              href="/<?= $blog ?>/"><?= $blog ?></a></li><li><span
              aria-hidden="true" class="breadcrumb--seperator"></span><a
              href="" aria-current="page"><?= $post ?></a></li><span
              aria-hidden="true" class="term-priv"></span>
        </ol>
      </nav>
<?php require PARTIALS_PATH . 'rss.php'; ?>
    </header>

<?php if ($sections->length > 0): ?>
    <nav aria-labelledby="page-nav">
      <header>
        <h2 id="page-nav">On This Page</h2>
      </header>
      <ol>
  <?php foreach ($sections as $section): ?>
      <li><a href="#<?= $section->getAttribute('id') ?>"><?= $section->getAttribute('title') ?></a></li>
  <?php endforeach; ?>
    </ol>
    </nav>
<?php endif; ?>

    <aside class="wpm"><p><small>Estimated reading time: <?= ceil(str_word_count($content) / 200); ?> minutes</small></p></aside>

    <main>
      <article>
        <?= $content; ?>
      </article>
    </main>

    <div id="comments" class="noscript"></div>
    <script src="https://comments.aaronwatts.dev/public/embed.js" defer></script>

    <nav aria-labelledby="to-top">
      <a href="#top" id="to-top">Back to Top</a>
    </nav>

    <script>
      window.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.noscript').forEach(function(i) {
          i.classList.remove('noscript');
        });
      });
    </script>
<?php require PARTIALS_PATH . 'footer.php'; ?>
    <?php
        if ($prismRequired === true) {
            echo '<script src="/assets/scripts/prism.js"></script>';
        }
    ?>
  </body>
</html>

