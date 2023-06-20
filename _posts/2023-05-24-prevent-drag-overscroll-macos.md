---
layout: blog
title: "Preventing drag overscrolling behavior (Rubber Band) on macOS"
date: 2023-05-24
thumbnail: "/assets/img/elastic.png"
categories: css
---
Elastic (Rubber Band) scrolling in macOS can make your website look quirky if you have a background image or animation with a blurry block on top for example
{: class="post-cards_description"}

The animation will appear at the top when you pull the page down by dragging two fingers on the trackpad for example, not nice at all
> Here's an example from this website (background blob rotating animation behind a blurry block)

<video autoplay muted loop>
  <source src="/assets/img/elastic.webm" type="video/webm">
Your browser does not support the video tag.
</video>

#### Vertical overscroll can be disabled on macOS by running the following command:
```shell
defaults write -g NSScrollViewRubberbanding -int 0
```
> Tested on Monterey and Lion (must restart chrome)

#### But to solve this problem on the web both horizontal & vertical:
hide horizontal overflow and prevent overscroll behavior vertically by using the [overscroll-behavior-y](https://developer.mozilla.org/en-US/docs/Web/CSS/overscroll-behavior-y) `CSS` property on the `HTML` element
```css
html {
  overflow-x: hidden;
  overscroll-behavior-y: none;
}
```
