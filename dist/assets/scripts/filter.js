'use strict';

document.addEventListener('DOMContentLoaded', function() {
  const searchElem = document.querySelector('search#topics');
  const filterSearch = new FilterSearch(searchElem);
  filterSearch.init();
});

class FilterSearch {
  constructor(searchElem) {
    this.articles = [...document.querySelectorAll('article')].map(article => {
      return {
        dom: article, 
        topics: [...article.querySelectorAll('.topic')].map(topic => topic.textContent.trim())
      }
    });
   
    this.filters = [];
    this.searchElem = searchElem;
    this.topicList = this.searchElem.querySelector('ul.topic-container');
    this.topics = FilterSearch.getTopics();
    this.truncIndex = FilterSearch.getTruncIndex();
    this.truncMsg = this.searchElem.querySelector('#usr-msg--truncated small');
    this.filterMsg = this.searchElem.querySelector('#usr-msg--filter small');
    this.showBtn = this.searchElem.querySelector('button#showBtn');
    this.removeFiltersBtn = this.searchElem.querySelector('button#filter-remove');
    this.filterBtns;
  }

  init() {
    this.populate();
    this.truncate();
    this.filterBtns = this.searchElem.querySelectorAll('button.topic');
    this.searchElem.classList.remove('noscript');
    
    this.searchElem.addEventListener('click', (evt) => {
      if (evt.target.classList.contains('topic')) {
        this.filterTopic(evt.target);
      } else if (evt.target.id === 'filter-remove') {
        this.removeFilters();
      } else if (evt.target.id === 'showBtn') {
        this.showTopicsList();
      }
    });
  }

  populate() {
    this.topics.forEach(topicName => {
      this.topicList.appendChild(
        FilterSearch.makeTopicBtn(topicName)
      );
    });
  }

  truncate() {
    if (this.topics.length > this.truncIndex - 1) {
      this.topicList.classList.add('truncated');
    }
   
    this.updateTruncMsg();
  }

  updateTruncMsg() {
    const filter = this.topicList.querySelector('button[aria-pressed="true"]');
    const slice = ( 
      filter && 
      this.topics.indexOf(filter.textContent) > this.truncIndex - 2 
    ) ? this.truncIndex : this.truncIndex - 1;
    
    if (this.topicList.classList.contains('truncated')) {
      this.truncMsg.textContent =
        `Showing ${slice} of ${this.topics.length} topics`;
    } else {
      this.truncMsg.textContent =
        `Showing ${this.topics.length} of ${this.topics.length} topics`;
    }
  }

  updateFilterMsg(filterSet=false) {
    if (filterSet) {
      this.filterMsg.textContent = `Filtering ${this.filters.length} topics.`;
    } else {
      this.filterMsg.textContent = 'Select a topic to filter articles.';
    }
  }

  filterTopic(filterBtn) {
    const filter = filterBtn.textContent.trim();
    const filterIndex = this.filters.indexOf(filter);

    if (filterIndex < 0) {
      this.filters.push(filter);
      filterBtn.classList.add('filterTopic');
      filterBtn.ariaPressed = 'true';
    } else {
      this.filters = this.filters.filter(i => i !== filter);
      filterBtn.classList.remove('filterTopic');
      filterBtn.ariaPressed = 'false';
    }

    if (this.filters.length) {
      this.removeFiltersBtn.removeAttribute('disabled');
      this.updateFilterMsg(true);
    } else {
      this.removeFiltersBtn.setAttribute('disabled', 'disabled');
      this.updateFilterMsg(false);
    }

    this.articles.forEach(article => {
      if (this.filters.length > 0) {
        article.dom.classList.add('hidden');
    
        for (let topic of article.topics) {
          if (this.filters.includes(topic)) {
            article.dom.classList.remove('hidden');
            break;
          }
        }
      } else {
        article.dom.classList.remove('hidden');
      }
    });
  }

  removeFilters() {
    this.filters = [];
    this.removeFiltersBtn.setAttribute('disabled', 'disabled');

    this.filterBtns.forEach(btn => {
      btn.classList.remove('filterTopic');
      btn.ariaPressed = 'false';
    });

    this.articles.forEach(article => {
      article.dom.classList.remove('hidden');
    });

    this.updateFilterMsg(false);
  }

  showTopicsList() {
    this.topicList.classList.toggle('truncated');

    if (this.topicList.classList.contains('truncated')) {
      this.showBtn.textContent = "Show all topics";
    } else {
      this.showBtn.textContent = "Show fewer topics";
    }
    
    this.updateTruncMsg();
  }

  static makeTopicBtn(topicName) {
    const template = document.querySelector('template#topicBtn');
    const clone = document.importNode(template.content, true);
    clone.querySelector('button').textContent = topicName;
    return clone;
  }

  static getTopics() {
    const topics = [
      ...new Set(
        [...document.querySelectorAll('li.topic')].map(i => i.textContent)
      )
    ].sort();
    
    return topics;
  }

  static getTruncIndex() {
    const rules = document.styleSheets[0].cssRules;
    
    for (let rule of rules) {
      if (rule.selectorText === 'search#topics') {
        return FilterSearch.getNumberAfterSubstring('nth-of-type', rule.cssText);
      }
    }
  }

  static getNumberAfterSubstring(substring, text) {
    let re = new RegExp(substring + '.*?(\\d\)'), match = re.exec(text);
    
    if (match === null) {
      return '';
    }
    
    return parseInt(match[1]);
  }
}
