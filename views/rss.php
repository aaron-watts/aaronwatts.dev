<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta content="Home page for the AaronWattsDev website." name="description" />
  
    <title>AWD - RSS</title>
    
    <link href="/images/apple-touch-icon.png" rel="apple-touch-icon" sizes="180x180" />
    <link href="/images/favicon-32x32.png" rel="icon" sizes="32x32" type="image/png" />
    <link href="/images/favicon-16x16.png" rel="icon" sizes="16x16" type="image/png" />
    <link href="/site.webmanifest" rel="manifest" />
    
    <link href="https://aaronwatts.dev/feed.xml" rel="alternate" title="AaronWattsDev RSS Feed - All" type="application/rss+xml"/>
    <link href="https://aaronwatts.dev/blog/feed.xml" rel="alternate" title="AaronWattsDev RSS Feed - Blog" type="application/rss+xml"/>
    <link href="https://aaronwatts.dev/guides/feed.xml" rel="alternate" title="AaronWattsDev RSS Feed - Guides" type="application/rss+xml"/>
    <link href="https://aaronwatts.dev/tech/feed.xml" rel="alternate" title="AaronWattsDev RSS Feed - Tech" type="application/rss+xml"/>

    <link as="font" crossorigin="" href="/assets/fonts/JetBrainsMono.woff2" rel="preload" type="font/woff2"/>
    <link href="/assets/styles/style.css" rel="stylesheet" />
  </head>

  <body>
    <header>
      <nav aria-label="Breadcrumb">
        <ol>
          <li><a href="/">aaronwatts@dev</a></li><span aria-hidden="true" class="term-dir"></span><li><span aria-hidden="true" class="breadcrumb--seperator"></span><a aria-current="page" href="">rss</a></li><span aria-hidden="true" class="term-priv"></span>
        </ol>
      </nav>
    </header>

    <main>
      <header>
        <h1>RSS Feeds</h1>
        <p>If you found your way here, then it's likely you know what you're doing. But in case you're new to RSS feeds, or you stumbled here by mistake, you just need to copy the url for the feed you want to subscribe to, and paste it into your favourite feed reader to get new articles sent to you as soon as they get published!</p>
      </header>

      <h2>Latest</h2>
      <a href="/feed">https://aaronwatts.dev/feed</a>
      <button class="noscript copy">
        <svg class="content-copy">
          <use href="/assets/svg/svg-map.svg#content-copy" />
        </svg>
      </button>
      <p>Latest articles from all categories.</p>
<?php foreach($blogOrder as $blogName): ?>

      <h2><?= ucfirst($blogName) ?></h2>
      <a href="/<?= $blogName ?>/feed">https://aaronwatts.dev/<?= $blogName ?>/feed</a>
      <button class="noscript copy">
        <svg class="content-copy">
          <use href="/assets/svg/svg-map.svg#content-copy" />
        </svg>
      </button>
      <p><?= $blogs[$blogName] ?></p>
<?php endforeach; ?>
    </main>

<?php require PARTIALS_PATH . 'footer.php'; ?>

    <script>
       document.addEventListener('DOMContentLoaded', init);

        function init() {
            const noscript = document.querySelectorAll('.noscript');
            noscript.forEach(i => {
                i.classList.remove('noscript');
                const feedLink = i.previousElementSibling.innerText;
                i.addEventListener('click', () => {
                    navigator.clipboard.writeText(feedLink);
                });
            });
        } 
    </script>

  </body>
</html>
