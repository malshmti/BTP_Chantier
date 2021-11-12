
# Projet de programmation web avancée - Emploi du temps
Ce projet a été réalisé par moi-même et un camarade anonyme.

## Installation

- Une base de données MySQL doit être accessible en localhost depuis le port 3306 (en utilisant WampServer par exemple).
- Exécutez dans un terminal à la racine du projet la commande "php bin/console doctrine:database:create" pour créer une base de données 'edt' si elle n'existe pas déjà.
- Ensuite, exécutez la commande "php bin/console doctrine:schema:update --force" au même endroit pour y ajouter les tables et les contraintes.
- Il peut y avoir des erreurs à l'exécution de cette commande si la base existait déjà auparavant et que des données ne respectent pas les contraintes de notre schéma. Dans ce cas nous recommandons de supprimer les données qui posent problème puis de relancer la commande.
- Le serveur PHP doit être lancé en localhost sur le port 8000. Pour cela, exécutez la commande "php -S localhost:8000" dans un terminal à l'intérieur du dossier "public" du projet.



# Ancien readme du projet de l'année dernière.

## Fonctionnalités

- Si votre base de données est vide et que vous souhaitez disposer de données dans la base pour pouvoir tester directement l'emploi du temps, nous avons créé un jeu de données pour le 15 mars 2021. Pour en disposer, vous devez exécuter le script 'edt.sql' qui se situe à la racine du projet. Pour cela, rendez-vous dans [phpMyAdmin](http://localhost/phpmyadmin) puis cliquez sur la base de données 'edt'. Ensuite, cliquez sur l'onglet 'SQL' en haut et copiez-collez tout le contenu du script 'edt.sql'. Finalement, cliquez sur 'Exécuter' et la base de données sera peuplée. Vous pourrez voir des cours s'afficher pour le 15 mars 2021 dans l'emploi du temps.

### Emploi du temps
--------------------

Cliquez ici pour accéder à l'emploi du temps : [EDT](http://localhost:8000/edt.html). Vous pouvez y voir s'afficher les cours et leurs informations :
- Le type de cours (Cours, TD ou TP)
- La matière
- Le professeur
- La salle
- Les heures de début et de fin

Au chargement, la date d'aujourd'hui est sélectionnée. Vous pouvez utiliser les boutons au dessus du calendrier pour afficher les jours suivants/précédents ou revenir à aujourd'hui quand vous le souhaitez. Il y a également un bouton permettant d'exporter le calendrier du jour au format PDF.

Lorsque vous cliquez sur un cours vous avez accès au détail de celui-ci, où les informations sont visibles de manière plus claire. Vous avez également la possibilité de donner votre avis sur celui-ci ou sur le professeur de ce cours. Cliquez sur le bouton correspondant et remplissez le formulaire. Sachez cependant qu'un étudiant ne peut pas donner plusieurs avis sur un même cours / professeur.

Si vous souhaitez consulter tous les avis des cours ou des professeurs, cliquez sur le bouton correspondant au dessus du calendrier. Vous serez redirigé vers une page permettant de consulter les avis d'un cours ou d'un professeur donné.

### EasyAdmin
--------------------

Depuis l'interface [EasyAdmin](http://localhost:8000/admin), vous avez la possibilité de consulter, créer, modifier et supprimer des professeurs, matières, avis, salles, cours et avis de cours.   
Nous avons mis en place des contraintes pour garder un emploi du temps cohérent. Voici les principales :

- Vous ne pouvez pas créer un cours qui commence avant 8h ou se termine après 20h.
- L'heure du début d'un cours ne peut pas être plus tard que son heure de fin.
- Un cours ne peut pas s'étaler sur plusieurs jours (par exemple de 8h à 10h le lendemain).
- Vous ne pouvez pas associer un cours à un professeur ayant déjà cours à la même période.
- Vous ne pouvez pas associer un cours à une salle déjà occupée pendant la période du cours.

Nous avons choisi de ne pas obliger un cours à être lié à une salle car il peut arriver qu'une salle ne soit pas encore décidée au moment de la création du cours dans l'emploi du temps, de même pour le professeur assurant le cours.

Si vous ne respectez pas une contrainte lors de la création ou de la modification d'une entité, l'erreur correspondante sera affichée et vous pourrez la corriger avant d'enregistrer.


### API
--------------------

Pour la transmission des données à l'emploi du temps, nous utilisons une API permettant de récupérer tous les cours en fonction du jour passé en paramètre au format YYYY-MM-DD. Par exemple pour récupérer les cours du 9 mars 2021, la route utilisée sera http://localhost:8000/api/cours/jour/2021-03-09 avec la méthode GET.

L'API est aussi utilisée pour récupérer, créer et supprimer les avis donnés par les étudiants concernants les professeurs ou les cours aux routes http://localhost:8000/api/professeurs/{idProf}/avis pour les professeurs et http://localhost:8000/api/cours/{idCours}/avis pour les cours (méthodes GET pour récupérer, POST pour créer et DELETE pour supprimer).
