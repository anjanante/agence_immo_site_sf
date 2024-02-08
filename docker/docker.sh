php bin/console doctrine:fixtures:load --append
php bin/console doctrine:migrations:diff --formatted
php bin/console d:m:m --no-interaction
exec apache2-foreground