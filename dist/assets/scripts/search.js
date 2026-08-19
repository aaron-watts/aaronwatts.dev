document.addEventListener('DOMContentLoaded', async function() {
  const feedUrl = '/search/feed.json';
  const feed = await Search.getFeed(feedUrl);

  if (feed !== null) {
    const idx = Search.getIdx(feed);
    const search = new Search(feed, idx);
    search.init();

    const searchParams = new URLSearchParams(window.location.search);
    
    if (searchParams.size > 0) {
      const query = searchParams.get('query');
      search.handleSearch(query);
    }
  } else {
    document.querySelector('#results h2').textContent = 'Something went wrong, try reloading...';
  }

  document.querySelectorAll('.noscript').forEach(i => {
    i.classList.remove('noscript');
  });
});

class Search {
  constructor(feed, idx) {
    this.feed = feed;
    this.idx = idx;
    this.searchElem = document.querySelector('search');
    this.resultsElem = document.querySelector('#results');
    this.bash = document.querySelector('span.bash');

    this.form = this.searchElem.querySelector('form');
    this.template = results.querySelector('template#result');

    this.domMap = new WeakMap();
  }

  init() {
    this.form.addEventListener('submit', evt => {
      evt.preventDefault();
      
      if (this.form.query.value.length > 0) {
        const url = new URL(window.location);
        const query = this.form.query.value;
        url.searchParams.set('query', query);
        history.pushState(null, '', url);
        this.form.query.value = '';
        document.activeElement.blur();
        this.results = this.handleSearch(query);
      }
    });
  }
  
  handleSearch(query) {
    this.removeResults();
    const results = this.search(query);
    this.populate = this.populateResults(results);
    this.bash.textContent = `grep -lr "${query}" ~/*`;
    this.resultsElem.querySelector('h2').textContent = `Showing ${results.length} results for "${query}"`;
  }
  
  search(query) {
    return this.idx.search(query);
  }

  populateResults(results) {
    for (const result of results) {
      const post = this.feed[result['ref']];
      const url = post['url'] + '/';
      const clone = document.importNode(this.template.content, true);
      this.domMap.set(clone);
      const h3 = clone.querySelector('h3 > a');
      h3.textContent = `${post['title']} [${post['blog']}]`;
      h3.href = url;
      const timeEl = clone.querySelector('time');
      timeEl.textContent = post['dateString'];
      timeEl.dateTime = post['date'];
      clone.querySelector('p.description').textContent = post['description'];
      clone.querySelector('article > a').href = url;

      const fragment = document.createDocumentFragment();
      for (const topic of post['topics']) {
        const li = document.createElement('li');
        li.textContent = topic;
        li.classList.add('topic');
        fragment.appendChild(li);
      }
      clone.querySelector('ul.topic-container').appendChild(fragment);

      this.resultsElem.appendChild(clone);
    }
  }
  
  removeResults() {
    const results = this.resultsElem.querySelectorAll('article');
    results.forEach(i => i.remove());
  }

  static getIdx(feed) {
    const idx = lunr(function () {
      this.ref('url');
      this.field('title');
      this.field('textContent');
      
      for (const item in feed) {
        this.add(feed[item]);
      }
    })

    return idx;
  }

  static async getFeed(url) {
    try {
      const response = await fetch(url);
      if (!response.ok) {
        throw new Error(`Response status: ${response.status}`);
      }

      const result = await response.json();

      return result;
    } catch (error) {
      console.log(error.message);
      return null;
    }
  }
}

