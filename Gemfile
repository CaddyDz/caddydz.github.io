source "https://rubygems.org"

# Jekyll 4 for the GitHub Actions Pages build (and the local Docker image).
# Regenerate Gemfile.lock inside the same image CI uses, never with host Ruby:
#   docker run --rm -v "$PWD":/srv -w /srv ruby:3.3-slim sh -c \
#     "apt-get update -qq && apt-get install -y -qq build-essential >/dev/null && bundle lock --add-platform x86_64-linux aarch64-linux"
gem "jekyll", "~> 4.3"
gem "webrick" # jekyll serve on Ruby >= 3

group :jekyll_plugins do
  gem "jekyll-seo-tag", "~> 2.8"   # OG/Twitter/canonical/JSON-LD in head.html ({% seo %})
  gem "jekyll-feed", "~> 0.17"     # /feed.xml
  gem "jekyll-sitemap", "~> 1.4"   # /sitemap.xml + robots.txt
end
