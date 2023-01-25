cd /home/forge/Caddy
git pull origin master

# Only install dependencies if there are newly added ones
# Compare composer.json in the latest commit against the previous commit
git diff --name-only HEAD HEAD~1 | grep composer.json && composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader

( flock -w 10 9 || exit 1
    echo 'Restarting FPM...'; sudo -S service php8.1-fpm reload ) 9>/tmp/fpmlock

if [ -f artisan ]; then
    php artisan migrate --force
    # Force recreating the storage symlink
    php artisan storage:link --force
    # Publish nova assets
    php artisan nova:publish
    php artisan optimize
fi
