#!/usr/bin/env bash
# Guards the hard invariants of the built site. Usage: tests/check-site.sh [_site]
# - every URL in tests/expected-pages.txt still exists (subset check: new pages are fine)
# - CNAME survives the build
# - tooling files are not published
set -euo pipefail
site=${1:-_site}
cd "$(dirname "$0")/.."

actual=$(cd "$site" && find . -path ./assets -prune -o -name '*.html' -print | sed 's#^\./##' | sort)
missing=$(comm -23 <(sort tests/expected-pages.txt) <(printf '%s\n' "$actual") || true)
[ -z "$missing" ] || { echo "MISSING PAGES (URL invariant broken):"; echo "$missing"; exit 1; }

[ "$(cat "$site/CNAME")" = "dsalim.dev" ] || { echo "CNAME missing or wrong"; exit 1; }

for leak in node_modules package.json package-lock.json tailwind.config.js input.css Gemfile Gemfile.lock \
            Dockerfile docker-compose.yml tests vitest.config.js playwright.config.js; do
  [ ! -e "$site/$leak" ] || { echo "LEAK: $leak was published to $site"; exit 1; }
done

# Built assets the new layouts depend on
grep -q 'navbar-fixed' "$site/css/style.css" || { echo "css/style.css missing or not built from input.css"; exit 1; }
[ -f "$site/js/app.js" ] && [ -f "$site/js/theme.js" ] || { echo "js/app.js or js/theme.js missing"; exit 1; }
[ -f "$site/img/decor-1.webp" ] || { echo "img/decor-*.webp missing"; exit 1; }

echo "site check OK: $(printf '%s\n' "$actual" | wc -l | tr -d ' ') pages, CNAME present, no leaks"
