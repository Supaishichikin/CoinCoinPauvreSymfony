# CoinCoinPauvreSymfony

Normalement toutes les consignes ont été réalisé (biensure à amélioré et la navigation est null, il n'y a pas plus pauvre que ce coincoinPauvre)

Pour lancer le projet, composer install, lancer l'image docker, faire un symfony serve, ouvrir un smtp
à renseigner dans le point env (pour les confirmation d'inscription par mail (on a utilisé MailHog).
créer la base de donnée également et lancer les fixtures pour avoir des données (sans les images).
Pour avoir des annonces avec images, se connecter (ou pas il n'y a pas de restriction pour la page de création (manque de temps)
il y aura un lien vers une page de création à partir de la homepage. il ya également un endpoint admin juste pour l'avoir avec une restriction d'accès et une redirection (accessible avec "ROLE_ADMIN). Il y a un endpoint également pour le filtre de recherche d'annonce. Les routes sont indiqué dans les différent controller à l'aide des annotations