---
layout: blog
title: "Harnessing Vue 3's Recursive Component Tree for Dynamic UIs"
date: 2023-01-16
thumbnail: "/assets/img/vue.png"
categories: javascript
---

In situations where a nested UI with unknown depth is needed, a recursive component that can call itself can be handy, think of Reddit comments for example.
{: class="post-cards_description"}

Consider a parent Tree component and a child Branch component, any Branch might have a Branch of its own and so fourth down the line, am using [SFCs](https://vuejs.org/guide/scaling-up/sfc.html) here for easier readability where the name of the recursive component is inferred from the file name by the Vue loader when bundling with WebPack or the Vue plugin for Rollup based Vite bundler.

`Tree.vue`

```vue
<script setup>
import { ref } from "vue";
import Branch from "./Branch.vue";

const data = ref({
  name: "Tree",
  nodes: [
    { name: "Grandfather" },
    { name: "Grandmother" },
    {
      name: "Parents",
      nodes: [
        {
          name: "Father",
          nodes: [{ name: "brother" }, { name: "sister" }],
        },
        { name: "Uncle" },
        { name: "Aunt" },
        {
          name: "Mother",
          nodes: [{ name: "niece" }, { name: "nephew" }],
        },
      ],
    },
  ],
});
</script>

<template>
  <ul>
    <Branch class="item" :node="data" />
  </ul>
</template>
```

Now the branch component can call itself passing the node object as a prop and iterating through its child nodes

`Branch.vue`

```vue
<script setup>
defineProps({
  node: Object,
});
</script>

<template>
  <li>
    {{ node.name }}
    <ul>
      <Branch :node="node" v-for="node in node.nodes" />
    </ul>
  </li>
</template>
```
