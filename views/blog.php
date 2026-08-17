<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta content="All thoughtful tech articles for the AaronWattsDev website" name="description"/>

    <title>AWD - <?= $blog ?></title>

    <link href="/images/apple-touch-icon.png" rel="apple-touch-icon" sizes="180x180"/>
    <link href="/images/favicon-32x32.png" rel="icon" sizes="32x32" type="image/png"/>
    <link href="/images/favicon-16x16.png" rel="icon" sizes="16x16" type="image/png"/>
    <link href="/site.webmanifest" rel="manifest"/>

    <link href="https://aaronwatts.dev/<?= $blog ?>/" rel="canonical"/>
    <link href="https://aaronwatts.dev/feed.xml" rel="alternate" title="AaronWattsDev RSS Feed - All" type="application/rss+xml"/>
    <link href="https://aaronwatts.dev/blog/feed.xml" rel="alternate" title="AaronWattsDev RSS Feed - Blog" type="application/rss+xml"/>
    <link href="https://aaronwatts.dev/guides/feed.xml" rel="alternate" title="AaronWattsDev RSS Feed - Guides" type="application/rss+xml"/>
    <link href="https://aaronwatts.dev/tech/feed.xml" rel="alternate" title="AaronWattsDev RSS Feed - Tech" type="application/rss+xml"/>

    <link href="/assets/styles/style.css" rel="stylesheet"/>
  </head>
  <body>
    <header>
      <nav aria-label="Breadcrumb">
       <ol>
          <li><a href="/">aaronwatts@dev</a></li><span aria-hidden="true" class="term-dir"></span><li><span aria-hidden="true" class="breadcrumb--seperator"></span><a aria-current="page" href=""><?= $blog ?></a></li><span aria-hidden="true" class="term-priv"></span>
        </ol>
      </nav>
<?php require PARTIALS_PATH . 'rss.php'; ?>
    </header>

    <main>
      <header>
        <h1><?= ucfirst($blog) ?></h1>
        <p><?= $blogDesc ?></p>
      </header>
    
      <search class="noscript" id="topics">
        <header>
          <h2>Filter by Topic</h2>
          <p aria-live="polite" id="usr-msg--filter" role="status"><small>Select a topic to filter articles.</small></p>
          <button disabled id="filter-remove">Remove filters</button>
        </header>
        <ul aria-describedby="usr-msg--filter" class="topic-container"></ul>
        <p aria-live="polite" id="usr-msg--truncated" role="status"><small></small></p>
        <button aria-describedby="usr-msg--truncated" id="showBtn">Show all topics</button>
        <noscript>
          <p><small>This page has a filter search feature to make finding stuff easier if you were to enable script ... no pressure.</small></p>
        </noscript>

        <template id="topicBtn">
          <li>
            <button class="topic" aria-pressed="false"></button>
          </li>
        </template>
      </search>
    
      <nav id="articles">
<?php foreach($posts as $path => $post):

  $postInfo = getPostInfo($post['dom']);
  [
  'title' => $title,
  'description' => $description,
  'date' => $date,
  'topics' => $topics
  ] = $postInfo;

  $url = '/' . $path;
?>

        <article>
          <header>
            <h3><a href="<?= $url ?>"><?= $title ?></a></h3>
            <time datetime="<?= $date ?>"><?= formatDate($date); ?></time>
            <ul class="topic-container">
<?php foreach($topics as $topic): ?>
              <li class="topic"><?= $topic->textContent ?></li>
<?php endforeach ?>
            </ul>
          </header>
          <p class="description"><?= $description ?></p>
          <a href="<?= $url ?>">Read More</a>
        </article>
<?php endforeach ?>
      </nav>
    </main>

<?php require PARTIALS_PATH . 'footer.php'; ?>

    <script src="/assets/scripts/filter.js"></script>
  </body>
</html>

