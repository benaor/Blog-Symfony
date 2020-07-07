# First project with Symfony
After clone git :  <br>
composer install <br>
composer require symfony/web-server-bundle --dev ^4.4.2 <br>
edit .env <br>
doctine:database:create <br>
make:migration <br>
doctrine:migrations:migrate <br>
doctrine:fixtures:load <br>
<br>
for start server : <br>
php bin/console server:start<br>
