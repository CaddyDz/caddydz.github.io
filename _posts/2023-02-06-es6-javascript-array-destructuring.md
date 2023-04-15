---
layout: blog
title: "Array destructuring in ES6+ JavaScript"
date: 2023-02-06
thumbnail: "/assets/img/js-destructuring.webp"
categories: javascript
---
Assign values to multiple variables in an array by the result of evaluation

```js
[firstName, lastName] = fullName.split(' ')
```

Example
```js
let firstName = '';
let lastName = '';
[firstName, lastName] = 'John Doe'.split(' ')
console.log(firstName) // John
console.log(lastName) // Doe
```