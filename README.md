## Installation

- Une base de données MySQL doit être accessible en localhost depuis le port 3306 (en utilisant WampServer par exemple).
- Exécutez dans un terminal à la racine du projet la commande "php bin/console doctrine:database:create" pour créer une base de données 'btp' si elle n'existe pas déjà.
- Ensuite, exécutez la commande "php bin/console doctrine:schema:update --force" au même endroit pour y ajouter les tables et les contraintes.
- Il peut y avoir des erreurs à l'exécution de cette commande si la base existait déjà auparavant et que des données ne respectent pas les contraintes de notre schéma. Dans ce cas nous recommandons de supprimer les données qui posent problème puis de relancer la commande.
- Le serveur PHP doit être lancé en localhost sur le port 8000. Pour cela, exécutez la commande "php -S localhost:8000" dans un terminal à l'intérieur du dossier "public" du projet.

### API
--------------------

Il y a une API accessible, l'api à été faite pour récupérer les chantiers depuis un front react et créer un diagramme de gantt.
On peut récuperer le chantier avec l'id 5 : http://localhost:8000/api/chantiers/5
ou bien pour récupérer la liste des chantiers et leurs attributs : http://localhost:8000/api/chantiers/