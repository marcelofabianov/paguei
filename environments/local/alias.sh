alias pg.help="cat alias.sh"
alias pg.info="docker container ls -a"
alias pg.ls="docker compose ls"
alias pg.lg="docker compose logs"
alias pg.rest="docker compose restart"
alias pg.ref="docker compose down && docker compose up -d"
alias pg.wat="docker compose up"
alias pg.up="docker compose up -d"
alias pg.dw="docker compose down"
alias pg.ip='docker inspect app_http | grep "IPAddress"'
alias pg.prune="docker container prune && docker volume prune && docker network prune"
alias pg.bash="docker exec -it app bash"
alias pg.exec="docker exec -it app"
alias pg.php="pg.exec php"
alias pg.composer="pg.exec composer"
alias pg.art="pg.php artisan"
alias pg.init="cp docker/.env.example .env && pg.composer install && pg.art key:generate"
alias pg.cache-clear="pg.art view:clear && pg.art route:clear && pg.art config:clear"
alias pg.cache="pg.art view:cache && pg.art config:cache && pg.art route:cache"
alias pg.cache-refresh="pg.cache-clear && pg.cache"
alias pg.redis-clear="docker exec -it app_cache_db redis-cli FLUSHALL"
alias pg.migrate="pg.art migrate"
alias pg.seed="pg.art db:seed"
alias pg.test="pg.art test --env=testing"
alias pg.coverage="pg.php vendor/bin/pest --coverage --coverage-html=public/tests/coverage"
alias pg.lint="pg.php ./vendor/bin/pint"
alias pg.captainhook="pg.php ./vendor/bin/captainhook"
alias pg.psalm="pg.php ./vendor/bin/psalm --no-cache"
alias pg.psalm-show="pg.php ./vendor/bin/psalm --show-info=true --no-cache"
alias pg.tinker="pg.art tinker"
alias pg.fake="pg.art appurno:fake"
alias pg.route="pg.art route:list"
alias pg.oauth="pg.art app:oauth"
alias pg.git="pg.lint && git add . && git status"
