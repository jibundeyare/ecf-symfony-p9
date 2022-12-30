# ECF - Part 2 - Projet bibliothèque - Composants d'accès aux données

Le but de cet exercice est de maîtriser l'utilisation de composants d'accès aux données d'une application web dynamique.

Note : cet exercice prolonge l'exercice de création de BDD.

## Cahier des charges

Vous devez utiliser des composants d'accès aux données qui réalise les requêtes indiquées plus bas.

Attention : l'accès à la BDD doit être effectué via un unique utilisateur ayant été créé à cet effet.

Vous pouvez utiliser les composants d'accès au données de votre choix : PHP vanila, Doctrine (Symfony) ou Eloquent (Laravel) par exemple.
Mais vous êtes vivement encouragé à utiliser Doctrine.

## Livrables

Le code doit être livré sous la forme d'un repository git en ligne sur un site comme github, gitlab ou autre.

Vous avez deux options : soit vous utilisez les composants d'accès aux données d'un framework PHP soit vous n'utilisez aucun framework PHP.

Quelque soit votre choix, le repository doit contenir les fichiers suivants :

- un fichier `README.md` (voir ci-dessous)
- un ou des fichiers PHP contenant des requêtes qui utilisent des composants d'accès aux données

Le fichier `README.md` doit indiquer la procédure à suivre pour :

- si nécessaire, installer les dépendances (avec composer par exemple)
- lancer le serveur web
- montrer l'URL à ouvrir pour tester les requêtes d'accès aux données

Attention : en fonction de vos données de test, il se peut que certaines requêtes ne renvoient aucunes données.
Dans ce cas, ne vous inquiétez pas.
Ce qui est évalué, c'est le fonctionnement correct des requêtes, pas la présence ou l'absence de résultats.

## Prérequis

- MariaDB
- PHPMyAdmin
- la BDD du projet bibliothèque

Si vous utilisez Symfony :

- PHP 7.x ou 8.x
- composer

## Les requêtes

### Les utilisateurs

Requêtes de lecture :

- la liste complète de tous les utilisateurs (de la table `user`)
@todo - la liste complète de tous les utilisateurs (de la table `user`) triée par email en ordre ascendant
- les données de l'utilisateur dont l'id est `1`
- les données de l'utilisateur dont l'email est `foo.foo@example.com`
- les données des utilisateurs dont l'attribut `roles` contient le mot clé `ROLE_EMRUNTEUR`
@todo - les données du profile emprunteur de l'utilisateur dont l'id est `2`

### Les livres

Requêtes de lecture :

- la liste complète de tous les livres
- les données du livre dont l'id est `1`
- la liste des livres dont le titre contient le mot clé `lorem`
- la liste des livres dont l'id de l'auteur est `2`
- la liste des livres dont le genre contient le mot clé `roman`

Requêtes de création :

- ajouter un nouveau livre
  - titre : Totum autem id externum
  - année d'édition : 2020
  - nombre de pages : 300
  - code ISBN : 9790412882714
  - auteur : Hugues Cartier (id `2`)
  - genre : science-fiction (id `6`)

Requêtes de mise à jour :

- modifier le livre dont l'id est `2`
  - titre : Aperiendum est igitur
  - genre : roman d'aventure (id `5`)

Requêtes de suppression :

- supprimer le livre dont l'id est `123`

### Les emprunteurs

Requêtes de lecture :

- la liste complète des emprunteurs
- les données de l'emprunteur dont l'id est `3`
- les données de l'emprunteur qui est relié au user dont l'id est `3`
- la liste des emprunteurs dont le nom ou le prénom contient le mot clé `foo`
- la liste des emprunteurs dont le téléphone contient le mot clé `1234`
- la liste des emprunteurs dont la date de création est antérieure au 01/03/2021 exclu (c-à-d strictement plus petit)
- la liste des emprunteurs inactifs (c-à-d dont l'attribut `actif` est égal à `false`)

### Les emprunts

Requêtes de lecture :

- la liste des 10 derniers emprunts au niveau chronologique
- la liste des emprunts de l'emprunteur dont l'id est `2`
- la liste des emprunts du livre dont l'id est `3`
- la liste des emprunts qui ont été retournés avant le 01/01/2021
- la liste des emprunts qui n'ont pas encore été retournés (c-à-d dont la date de retour est nulle)
- les données de l'emprunt du livre dont l'id est `3` et qui n'a pas encore été retournés (c-à-d dont la date de retour est nulle)

Requêtes de création :

- ajouter un nouvel emprunt
  - date d'emprunt : 01/12/2020 à 16h00
  - date de retour : aucune date
  - emprunteur : foo foo (id `1`)
  - livre : Lorem ipsum dolor sit amet (id `1`)

Requêtes de mise à jour :

- modifier l'emprunt dont l'id est `3`
  - date de retour : 01/05/2020 à 10h00

Requêtes de suppression :

- supprimer l'emprunt dont l'id est `42`

