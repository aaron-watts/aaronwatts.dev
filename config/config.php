<?php

$blogDesc = fn (): string => "Here I talk about things that don't fit in with the topics of my other blog reels. Topics will likely fall into the realm of nerdery, with hobbyist programming and web development,  tech gadgets, and maybe video games and books.";
$guidesDesc = fn (): string => "Some guides on things that I have worked on where resources are either hard to find or scattered. You might save yourself some time or learn something new if you're working on anything that comes up in this section.";
$techDesc = fn (): string => "Technology that I consider to be <em>thoughtful</em>, where there are more meaningful priorities than exponential growth and high profit margins.";

return array(
    'baseUrl' => 'https://aaronwatts.dev',
    'blogs' => [
        'blog' => $blogDesc(),
        'guides' => $guidesDesc(),
        'tech' => $techDesc()
    ],
    'blogOrder' => [
        'blog',
        'guides',
        'tech'
    ],
);
