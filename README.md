Partie API du projet STUR codé avec Symfony

documentation de symfony : https://symfony.com/doc/current/index.html
Application nécessaire : MariaDB (WAMP de preference), visual studio code, Postman.

Pour mettre en place la partie API du projet STUR, installer les applications ci-dessous :
https://www.postman.com/downloads/
https://www.wampserver.com
https://code.visualstudio.com/download

Lancer WAMP et se connecter sur MariaDB via PHPMyAdmin (identifiant: root & pas de mdp) 
Ouvrir le dossier dans VS code (via git clone https://github.com/HugoMngn/Chaos_auto.git ou telecharger le fichier .zip)
Installer composer, symfony et doctrine sur votre pc via la documentation officiel.
Taper les commandes suivantes dans un terminal pour mettre en place la base de donnée:
  php bin/console d:d:c 
  php bin/console make:migration
  php bin/console d:m:m
  php bin/console d:f:l

Lancer le serveur avec cette commande:
  symfony server:start

Sur postman, faire les différentes requetes sur l'url suivante : http://127.0.0.1:8000/api/{route voulu}
Par exemple: http://127.0.0.1:8000/api/categories/23
