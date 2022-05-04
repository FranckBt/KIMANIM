## Etapes à suivre pour lancer le site KIMANIM

Depuis le terminal lancer les commandes suivantes: 
- composer install
- php bin/console d:d:d --force
- php bin/console d:d:c
(supprimer aussi les migrations si existantes dans ses fichiers)
- php bin/console make:migration
- php bin/console doctrine:migrations:migrate (d:m:m)
- php bin/console doctrine:fixtures:load (d:f:l)


- php -S localhost:4000 -t public

Dans un second terminal
- npm run dev-server

## Comptes utilisateurs
Parent [
login: parent@gmail.com
mdp: 123456]

Animateur [
login: animateur@gmail.com
mdp: 123456]

Admin [
login: admin@gmail.com
mdp: 123456]
