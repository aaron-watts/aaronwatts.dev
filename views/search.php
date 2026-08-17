<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>AWD - Search</title>
  <link href="/images/apple-touch-icon.png" rel="apple-touch-icon" sizes="180x180"/>
  <link href="/images/favicon-32x32.png" rel="icon" sizes="32x32" type="image/png"/>
  <link href="/images/favicon-16x16.png" rel="icon" sizes="16x16" type="image/png"/>
  <link href="/site.webmanifest" rel="manifest"/>
  <link href="https://aaronwatts.dev/feed.xml" rel="alternate" title="AaronWattsDev RSS Feed - All" type="application/rss+xml"/>
    <link href="https://aaronwatts.dev/blog/feed.xml" rel="alternate" title="AaronWattsDev RSS Feed - Blog" type="application/rss+xml"/>
  <link href="https://aaronwatts.dev/guides/feed.xml" rel="alternate" title="AaronWattsDev RSS Feed - Guides" type="application/rss+xml"/>
  <link href="https://aaronwatts.dev/tech/feed.xml" rel="alternate" title="AaronWattsDev RSS Feed - Tech" type="application/rss+xml"/>
  <link href="/assets/styles/style.css" rel="stylesheet"/>
  </style>
</head>
<body>
    <header>
      <nav aria-label="Breadcrumb">
       <ol>
          <li><a href="/">aaronwatts@dev</a></li><span aria-hidden="true" class="term-dir"></span><li><span aria-hidden="true" class="breadcrumb--seperator"></span><a aria-current="page" href="">search</a></li><span aria-hidden="true" class="term-priv"></span>
        </ol>
      </nav>
<?php require PARTIALS_PATH . 'rss.php'; ?>
    </header>

  <main>
    <h1>Search</h1>
    <search>
      <form>
        <input type="text" name="query">
        <button type="submit">Search</button>
      </form>
    </search>
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
