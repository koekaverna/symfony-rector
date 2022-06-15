Symfony Demo Application
========================
Make this steps to reproduce the issue:
```
docker-compose up -d
docker-compose exec php composer install
docker-compose exec php vendor/bin/rector process --debug --dry-run
```