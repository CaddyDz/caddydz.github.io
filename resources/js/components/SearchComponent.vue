<template>
  <div class="main-search" id="search" @keyup.esc="close">
    <input v-model="query" type="search" name="s" :placeholder="$t('Enter your query...')" ref="search">
    <button type="submit">
      <i class="fa fa-search"></i>
    </button>
    <div class="button brand-1 search-close" @click="close">
      <i class="fa fa-times"></i>
    </div>
    <ais-instant-search :search-client="searchClient" index-name="users">
      <ais-configure :query="query" :restrictSearchableAttributes="['name']" :hitsPerPage="8"/>
      <ais-hits :class-names="{'ais-Hits': 'hits'}">
        <template slot-scope="{ items }">
          <li v-for="item in items" :key="item.objectID">
            {{ $t('Articles by User:') }} 
            <a :href="link(item.name)">{{ item.name }}</a>
          </li>
        </template>
      </ais-hits>
    </ais-instant-search>
    <ais-instant-search :search-client="searchClient" index-name="articles">
      <ais-configure :query="query" :hitsPerPage="8"/>
      <ais-hits :class-names="{'ais-Hits': 'hits'}">
        <template slot-scope="{ items }">
          <p v-if="items.length">{{ $t('Articles:') }}</p>
          <li v-for="article in items" :key="article.objectID">
            <a :href="article.slug">{{ article.title }}</a>
          </li>
        </template>
      </ais-hits>
    </ais-instant-search>
  </div>
</template>

<script>
import { AisInstantSearch, AisHits, AisConfigure } from "vue-instantsearch";
import algoliasearch from "algoliasearch/lite";

// Build up an Algolia Client
const algoliaClient = algoliasearch(
  "PFPLEPJMOV",
  "0b94c06c323aa2aaeac3d8f6b4df2dd7"
);

// Proxy the client to prevent sending requests on page load
const searchClient = {
  search(requests) {
    if (requests.every(({ params }) => !params.query)) {
      // If there's no query, return empty hits by intercepting the API call
      return Promise.resolve({
        results: requests.map(() => ({
          hits: [],
          nbHits: 0,
          processingTimeMS: 0
        }))
      });
    }
    return algoliaClient.search(requests);
  }
};

export default {
  // Tree shaking to optimize the build
  components: {
    AisInstantSearch,
    AisHits,
    AisConfigure
  },
  data() {
    return {
      searchClient,
      query: ""
    };
  },
  methods: {
    close() {
      // Close the search bar when the user hits escape
      document.body.classList.remove('search-active');
    },
    link(name) {
      return '/articles?by=' + name;
    }
  },
  mounted() {
    this.$root.$on('focus-search-input', () => {
      this.$refs.search.focus();
    });
  }
};
</script>

<style scoped>
/* Make the search box input placeholder more visible */
input {
  font-weight: 600;
}
/* Prevent results from showing as a list */
li {
  display: -webkit-box;
  padding-left: 5%;
  border: #5457b3 1px solid;
  padding-bottom: 1%;
  padding-top: 1%;
}

.hits {
  margin-left: 25%;
  width: 50%;
  background: #043040;
  color: silver;
  text-align: center;
  -webkit-transition: color 0.3s, background-color 0.3s;
  transition: color 0.3s, background-color 0.3s;
}
button {
  margin-top: 2%;
}

a {
  color: #4ec9f7
}

p {
    margin-bottom: unset;
    display: flex;
    padding: 2%;
    font-size: x-large;
    color: white;
    background-color: #1895c6;
}
</style>

<i18n>
{
  "en": {
    "Enter your query...": "Enter your query..."
  },
  "fr": {
    "Enter your query...": "Entrez votre requête..."
  },
  "ar": {
    "Enter your query...": "أدخل استفسارك ..."
  }
}
</i18n>
