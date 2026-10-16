# Posts set `thumbnail` (the blog card image); jekyll-seo-tag and jekyll-feed read `image`.
# Map one onto the other so a post's share image never drifts from its card. The alt text is the title.
Jekyll::Hooks.register :posts, :pre_render do |post|
  thumbnail = post.data["thumbnail"]
  post.data["image"] ||= { "path" => thumbnail, "alt" => post.data["title"] } if thumbnail
end
