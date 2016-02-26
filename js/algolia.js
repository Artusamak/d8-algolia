var hitTemplate =
  '<div class="hit col-sm-3">' +
  '<div class="infos">' +
  '<h4 class="media-heading">{{{_highlightResult.title.value}}}</h4>' +
  '<p>Par {{_highlightResult.author.value}} - {{#_highlightResult.tags}}{{value}}, {{/_highlightResult.tags}}</p>' +
  '</div>' +
  '</div>';

var noResultsTemplate = '<div class="text-center">No results found matching <strong>{{query}}</strong>.</div>';

var search = instantsearch({
  appId: '6T7TAEXYR7',
  apiKey: '8d3a8620d5d5f9acbbd5c503a2038900', // search only API key, no ADMIN key
  indexName: 'nodes',
  urlSync: true
});

var widgets = [
  instantsearch.widgets.searchBox({
    container: '#edit-keys',
    placeholder: 'Search for articles'
  }),
  instantsearch.widgets.hits({
    container: '#hits',
    hitsPerPage: 10,
    templates: {
      item: hitTemplate,
      empty: noResultsTemplate
    }
  }),
  instantsearch.widgets.stats({
    container: '#stats'
  }),
  instantsearch.widgets.pagination({
    container: '#pagination'
  }),
  instantsearch.widgets.refinementList({
    container: '#algolia-categories',
    attributeName: 'tags',
    limit: 10,
    operator: 'or'
  })
];

widgets.forEach(search.addWidget, search);

search.start();