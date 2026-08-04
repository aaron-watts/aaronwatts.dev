<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta content="Home page for the AaronWattsDev website." name="description"/>
   
    <title>AWD - Home</title>
    
    <link href="/images/apple-touch-icon.png" rel="apple-touch-icon" sizes="180x180"/>
    <link href="/images/favicon-32x32.png" rel="icon" sizes="32x32" type="image/png"/>
    <link href="/images/favicon-16x16.png" rel="icon" sizes="16x16" type="image/png"/>
    <link href="/site.webmanifest" rel="manifest"/>
    
    <link href="https://aaronwatts.dev/" rel="canonical"/>
    <link href="https://aaronwatts.dev/feed.xml" rel="alternate" title="AaronWattsDev RSS Feed - All" type="application/rss+xml"/>
    <link href="https://aaronwatts.dev/guides/feed.xml" rel="alternate" title="AaronWattsDev RSS Feed - Guides" type="application/rss+xml"/>
    <link href="https://aaronwatts.dev/tech/feed.xml" rel="alternate" title="AaronWattsDev RSS Feed - Tech" type="application/rss+xml"/>
   
    <link as="font" crossorigin="" href="/assets/fonts/JetBrainsMono.woff2" rel="preload" type="font/woff2"/>
    <link href="/assets/styles/style.css" rel="stylesheet"/>
    <style>
      header > nav {
        display: flex;
        align-items: center;
      }

      header > nav > div:not(div:first-of-type) {
        margin-inline: .6em .4em;
      }

      header > nav > a {
        margin-inline-start: .8em;
      } 

      .svg-container {
        display: inline-block;
      }

      .hero {
        font-family: JetBrainsMono;
        font-weight: 400;
        font-size: 2.6vw;
        letter-spacing: .4vw;
        font-weight: bold;
        margin-block: 8rem 10rem;
        text-shadow:
          0 0 .0357vw currentColor,
          0 0 .15vw currentColor;
      }

      @media (prefers-color-scheme: dark) {
        .hero {
          text-shadow:
            0 0 .23vw currentColor,
            0 0 1.2vw currentColor;
        }
      }

      @media only screen and (max-width: 720px) {
        .hero {
          font-size: 5vw;
        }
      }

      .hero h1 {
        font-size: 1em;
        display: inline;
        font-weight: 400;
      }

      .hero span.term-cursor::after {
        content: ' █';
      }

      .hero span.term-cursor {
        -webkit-animation: flash-cursor 2.6s 2;
        animation: flash-cursor 2.6s 2;
        opacity: 0;
      }

      @-webkit-keyframes flash-cursor {
        0% { opacity: 0 }
        50% { opacity: 1 }
        100% { opacity: 0 }
      }

      @keyframes flash-cursor {
        0% { opacity: 0 }
        50% { opacity: 1 }
        100% { opacity: 0 }
      }
    </style>
  </head>
  <body>
    <header>
      <nav>
        <div class="svg-container">
        <a href="/rss">
          <svg class="rss">
            <use href="/assets/svg/svg-map.svg#rss-feed" />
          </svg>
        </a>
        </div>
        <a href="https://sites.aaronwatts.dev">More by aaronwatts@dev</a>
      </nav>
      <div class="hero">
        <span class="hero-text">
          <h1><span class="host">aaronwatts@dev</span></h1><span aria-hidden="true" class="term-dir"></span></span><span aria-hidden="true" class="term-priv"></span><span aria-hidden="true" class="term-cursor"></span>
      </div>
    </header>

    <main>
      <nav>
        <h2>Latest</h2>
        <article>
          <header>
          <h3><a href="/<?= $latest['blog'] ?>/<?= $name ?>"><?= $title ?></a></h3>
          <time datetime="<?= $date ?>"><?= formatDate($date); ?></time>
            <ul class="topic-container">
              <li class="topic">computing</li>
              <li class="topic">diy</li>
              <li class="topic">cloud</li>
            </ul>
          </header>
          <p class="description"><?= $description ?></p>
          <a href="/<?= $latest['blog'] ?>/<?= $name ?>">Read More</a>
        </article>
      </nav>

<?php foreach($blogOrder as $blogName): ?>
        <h2><a href="/<?= $blogName ?>"><?= ucfirst($blogName) ?></a></h2>
        <p><?= $blogs[$blogName] ?></p>
        <a href="/<?= $blogName ?>">Go to <?= $blogName ?></a>
<?php endforeach ?>

    </main>

    <footer>
      <div>Made by Hand. Powered by</div>
      <a href="https://pages.github.com/" target="_blank">
        <img alt="https://pages.github.com/" src="/assets/svg/githubpages.svg"/>
      </a>
    </footer>
  </body>
</html>
