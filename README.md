ESN-BackEnd
===========

Cet outil permet de faire fonctionner la partie Guide de l'application smartphone développée ici : https://github.com/donatienthorez/ESN_Mobil-IT 

Ce back-office permet à un membre de l'association ESN, d'ajouter, modifier et supprimer des éléments dans le guide. 

Le bloc de gauche permet de naviguer dans l'arborescence du guide. Pour modifier une catégorie il suffit juste de cliquer sur son nom ou sur son contenu dans le bloc de droite.

===========
Comment faire fonctionner le projet sur votre machine :

* Renseignez vos paramètres de base de données dans le fichier includes/database/config.xml (compléter host,user,pass,port et db)
* Lancer les scripts contenus dans le dossier SQL
* Assurez vous que les liens dans le fichier js/AngularApp/services.js soient correctes en fonction de votre arborescence de fichiers

