## commande a executer
# demarrer le serveur
symfony serve
# creer la base de donnee
php bin/console doctrine:database:create
# creer 
php bin/console make:migration
php bin/console doctrine:migrations:migrate

# creer entity
php bin/console make:entity