# Projet Médiathèque

## Description
Dépôt du projet Médiathèque. Les documents annexes sont disponibles dans le dossier ANNEXES de ce dépôt

## Récupération du projet

Utiliser GIT Clone pour récupérer le dépôt

```bash
git clone https://github.com/codeBlooming/mediatheque.git
```

## Installation

```bash
# Déplacement dans le dossier
cd mediatheque

# Installation des dépendances
composer install

# Création de la base de données
php bin/console doctrine:database:create

# Création des tables (migrations)
php bin/console doctrine:migrations:migrate

# Insertions des jeux de données (fixtures)
php bin/console doctrine:fixtures:load --no-interaction
```


## Utilisation
Deux options pour lancer le serveur de développement PHP :
- Si vous avez installé **Symfony** :
```bash
symfony server:start
```
- Si vous utilisez **Composer**, il faut installer le **Web Server Bundle** :
```bash
composer require symfony/web-server-bundle --dev
php bin/console server:start
```

## Copies
Certains documents demandés sont aussi accessibles sur Google
[Drive](https://drive.google.com/drive/folders/1HOqJ9BdoCrocTIP_uzNLjyzJKpUWQuUs?usp=sharing)