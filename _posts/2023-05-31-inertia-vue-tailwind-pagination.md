---
layout: blog
title: "Pagination component designed in Tailwind CSS for Inertia's Vue 3 adapter"
date: 2023-05-31
thumbnail: "/assets/img/inertia.png"
categories: javascript
---
The missing pagination component in Laravel Breeze Inertia Vue Tailwind application scaffolding
{: class="post-cards_description"}

```vue
<script setup>
import { Link } from "@inertiajs/vue3";

defineProps({
  links: {
    type: Array,
    required: true,
  },
});

const classes = "mr-1 px-4 py-3 text-sm leading-4 border rounded";
</script>

<template>
  <!-- If more than (prev, 1, next) -->
  <div v-if="links.length > 3">
    <div class="flex flex-wrap mt-4">
      <template v-for="link in links" :key="key">
        <div
          v-if="link.url === null"
          class="text-gray-400 cursor-not-allowed"
          :class="classes"
          v-html="link.label"
          aria-disabled="true"
        />
        <Link
          v-else
          class="hover:bg-black hover:text-white focus:border-indigo-500 focus:text-indigo-500"
          :class="[classes, { 'bg-black text-white': link.active }]"
          :href="link.url"
          v-html="link.label"
          aria-disabled="false"
          preserve-scroll
        />
      </template>
    </div>
  </div>
</template>
```
# Usage:
Render an Inertia page and pass paginated results of your Eloquent model as a prop
```php
return Inertia::render('Index', [
  'results' => YourModel::paginate(15),
]);
```
Use the component in your page like so:
```vue
<script setup>
import Pagination from "@/Components/Pagination.vue";

defineProps({
    results: {
        type: Object,
        required: true,
    },
});
</script>

<template>
  <Pagination :links="results.links" />
</template>
```