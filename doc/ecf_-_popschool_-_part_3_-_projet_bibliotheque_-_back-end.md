# ECF - Part 3 - Projet bibliothèque - Back-end

Le but de cet exercice est de maîtriser la création de la partie back-end d'une application web dynamique.

Note : cet exercice prolonge l'exercice d'utilisation de composants d'accès aux données.

## Cahier des charges

Vous devez créer le back-end d'une application web qui affiche les pages indiquées plus bas.

Pour créer le back-end, vous avez le choix des armes : PHP vanila, Symfony, Laravel ou Slim par exemple.
Mais vous êtes vivement encouragé à utiliser Symfony.

## Livrables

Le code doit être livré sous la forme d'un repository git en ligne sur un site comme github, gitlab ou autre.

Vous avez deux options : soit vous utilisez un framework PHP soit vous n'en utilisez pas.

Quelque soit votre choix, le repository doit contenir les fichiers suivants :

- un fichier `README.md` (voir ci-dessous)
- des fichiers PHP qui constituent le back-end

Le fichier `README.md` doit indiquer la procédure à suivre pour :

- si nécessaire, installer les dépendances (avec composer par exemple)
- lancer le serveur web
- montrer l'URL à ouvrir pour tester l'application web

## Prérequis

- MariaDB
- PHPMyAdmin
- la BDD du projet bibliothèque
- les requêtes de données faites avec un composant d'accès aux données

Si vous utilisez Symfony :

- PHP 7.x ou 8.x
- composer

## Les pages

### Entête

L'entête du site doit afficher un menu qui propose :

- un lien clickable qui pointe vers la page d'accueil
- un lien clickable nommé `login` qui permet d'accéder à la page d'authentification (`/login`)

Et si l'utilisateur est admin, le menu doit aussi proposer des liens vers :

- la page liste des utilisateurs
- la page liste des livres
- la page liste des auteurs
- la page liste des genres
- la page liste des emprunteurs
- la page liste des emprunts

### Page d'accueil

La page d'accueil, accessible par tout le monde, doit afficher un formulaire de recherche et un catalogue des livres.

Dans le catalogue des livres, le titre doit être un lien clickable qui pointe vers la page détails du livre.
Le formulaire de recherche doit permettre de faire une recherche par mot clé dans le titre, par mot clé dans le nom de l'auteur ou par code ISBN exact.

- formulaire :
  - titre
  - auteur
  - isbn

- résultats :
  - titre (lien clickable)
  - auteur
  - année d'édition
  - nombre de page
  - (optionnel) disponibilité

- URL : `/`
- méthode : `GET`, `POST`
- accessibilité : tout le monde

### Page détails d'un livre

La page détails d'un livre, accessible par tout le monde, doit afficher les données complètes d'un livre et doit aussi indiquer si le livre est disponible ou non (c-à-d s'il fait partie d'un emprunts non rendu ou pas).

- données :
  - titre
  - disponibilité
  - année d'édition
  - nombre de pages
  - code ISBN
  - cote du livre
  - auteur
  - genre

- URL : `/livre/{id}`
- méthode : `GET`
- accessibilité : tout le monde

### Page d'authentification

La page d'authentification, accessible par tout le monde, doit afficher un formulaire d'authentification (email et mot de passe).
Les messages d'erreur doivent respecter les règles de sécurité.
Une authentification réussie doit rediriger l'utilisateur vers la page liste des emprunts.

- formulaire :
  - email
  - mot de passe

- résultats : redirection vers la page liste des emprunts

- URL : `/login`
- méthode : `GET`, `POST`
- accessibilité : tout le monde

### Pages CRUD des emprunts

Dans les pages CRUD des emprunts :

- la page liste des emprunts est accessible par tout utilisateur authentifié (`ROLE_ADMIN` ou `ROLE_EMRUNTEUR`)
- la page détail d'un emprunt est accessible par tout utilisateur authentifié (`ROLE_ADMIN` ou `ROLE_EMRUNTEUR`)
- les autres pages (création, modification, suppression) ne sont accessibles que par les admins (`ROLE_ADMIN`)

Dans la page liste des emprunts :

- si l'utilisateur est un admin (`ROLE_ADMIN`), on peut afficher tous les emprunts
- si l'utilisateur est un emprunteur (`ROLE_EMRUNTEUR`), on ne doit afficher que ses emprunts

Dans la page détails d'un emprunt :

- si l'utilisateur est un admin (`ROLE_ADMIN`), il a accès à tous les emprunts
- si l'utilisateur est un emprunteur (`ROLE_EMRUNTEUR`) et qu'il essaie d'afficher un emprunt qui n'est pas à lui, il faut renvoyer une erreur `404 NOT FOUND`

- les pages de type CRUD des emprunts :
  - URL : `/admin/emprunt`  
    méthode : `GET`
    accessibilité : admin, emprunteur
  - URL : `/admin/emprunt/new`  
    méthode : `GET`, `POST`
    accessibilité : admin
  - URL : `/admin/emprunt/{id}`  
    méthode : `GET`
    accessibilité : admin, emprunteur
  - URL : `/admin/emprunt/{id}/edit`  
    méthode : `GET`, `POST`
    accessibilité : admin
  - URL : `/admin/emprunt/{id}`  
    méthode : `DELETE`
    accessibilité : admin

### Les autres pages de type CRUD

Les pages de type CRUD ne doivent être accessible que pour les utilisateurs de type admin.

Ces pages doivent permettre de gérer :

- des utilisateurs (de la table `user`)
- des livres
- des auteurs
- des genres
- des emprunteurs

- les pages de type CRUD des livres :
  - URL : `/admin/livre`  
    méthode : `GET`
  - URL : `/admin/livre/new`  
    méthode : `GET`, `POST`
  - URL : `/admin/livre/{id}`  
    méthode : `GET`
  - URL : `/admin/livre/{id}/edit`  
    méthode : `GET`, `POST`
  - URL : `/admin/livre/{id}`  
    méthode : `DELETE`
  - accessibilité : admin

Les autres pages de type CRUD sont construites en remplaçant le mot clé `livre` par la ressource correspondante.
Exemple : `/admin/user`, `/admin/auteur`, `/admin/genre`, etc.

