<template>
  <div class="main-search" id="search" @keyup.esc="close">
    <input v-model="query" type="search" name="s" placeholder="Enter your query...">
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
            <small>
              <a href="#">{{ item.name }}</a>
            </small>
          </li>
        </template>
      </ais-hits>
    </ais-instant-search>
    <ais-instant-search :search-client="searchClient" index-name="posts">
      <ais-configure :query="query" :hitsPerPage="8"/>
      <ais-hits :class-names="{'ais-Hits': 'hits'}">
        <template slot-scope="{ items }">
          <li v-for="item in items" :key="item.objectID">
            <small>
              <a href="#">{{ item.title }}</a>
            </small>
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
				$('body').removeClass('search-active');
		},
  }
};
</script>

<style scoped>
/* Prevent results from showing as a list */
li {
  display: unset;
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
</style>
