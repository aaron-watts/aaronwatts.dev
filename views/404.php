<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>AWD - Page Not Found</title>
  <link href="/images/apple-touch-icon.png" rel="apple-touch-icon" sizes="180x180"/>
  <link href="/images/favicon-32x32.png" rel="icon" sizes="32x32" type="image/png"/>
  <link href="/images/favicon-16x16.png" rel="icon" sizes="16x16" type="image/png"/>
  <link href="/site.webmanifest" rel="manifest"/>
  <link href="https://aaronwatts.dev/feed.xml" rel="alternate" title="AaronWattsDev RSS Feed - All" type="application/rss+xml"/>
  <link href="https://aaronwatts.dev/blog/feed.xml" rel="alternate" title="AaronWattsDev RSS Feed - Blog" type="application/rss+xml"/>
  <link href="https://aaronwatts.dev/guides/feed.xml" rel="alternate" title="AaronWattsDev RSS Feed - Guides" type="application/rss+xml"/>
  <link href="https://aaronwatts.dev/tech/feed.xml" rel="alternate" title="AaronWattsDev RSS Feed - Tech" type="application/rss+xml"/>

  <link as="font" crossorigin="" href="/assets/fonts/JetBrainsMono.woff2" rel="preload" type="font/woff2"/>
  <link href="/assets/styles/style.css" rel="stylesheet"/>
  <style>
    .bash::before {
      content: ' $ ';
    }
  </style>
</head>
<body>
  <header>
    <nav aria-label="Breadcrumb">
      <ol>
        <li><a 
            href="/">aaronwatts@dev</a></li><span
            aria-hidden="true" class="term-dir"></span><li><span
            aria-hidden="true" class="breadcrumb--seperator"></span><a 
            href="" aria-current="page"><span class="screen-reader-text">404</span>
            <span class="bash" aria-hidden="true">cd: no such file or directory:
            </span><span id="pathname">404</span></a></li>
      </ol>
    </nav>
  </header>

  <main>
    <h1>Page Not Found</h1>
    <img src="/images/404.jpg" alt="Missing Image">
    <p>
      It looks like the page you're looking for does not exist.
      Return to the <a href="/">home page</a> or look at the useful
      links below.
    </p>
      <nav aria-label="Site Navigation">
        <h2>Latest</h2>
<?php $url = '/' . $latest['blog'] . '/' . $name; ?>
        <article>
          <header>
          <h3><a href="<?= $url ?>"><?= $title ?></a></h3>
          <time datetime="<?= $date ?>"><?= formatDate($date); ?></time>
            <ul class="topic-container">
<?php foreach($topics as $topic): ?>
              <li class="topic"><?= $topic->textContent ?></li>
<?php endforeach; ?>
            </ul>
          </header>
          <p class="description"><?= $description ?></p>
          <a href="<?= $url ?>" aria-label="Read more about <?= $title ?>">Read More</a>
        </article>

<?php foreach($blogOrder as $blogName): ?>
        <div class="blog--wrapper">
          <h2><a href="/<?= $blogName ?>"><?= ucfirst($blogName) ?></a></h2>
          <p><?= $blogs[$blogName] ?></p>
          <a href="/<?= $blogName ?>">Go to <?= $blogName ?></a>
        </div>
<?php endforeach ?>

      </nav>
  </main>

<?php require PARTIALS_PATH . 'footer.php'; ?>

  <script>
    function getPath(){
      const path = document.querySelector('#pathname');
      path.innerText = location.pathname.substring(1);
    }

    document.addEventListener('DOMContentLoaded', getPath);
  </script>
</body>
</html>
