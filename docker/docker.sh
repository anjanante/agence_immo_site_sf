php bin/console doctrine:migrations:diff --formatted
php bin/console d:m:m --no-interaction
php bin/console doctrine:fixtures:load --append
exec apache2-foreground