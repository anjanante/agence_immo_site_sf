php bin/console doctrine:migrations:diff --formatted
php bin/console d:m:m --no-interaction
php bin/console app:create-user demo@demo.com password
exec apache2-foreground