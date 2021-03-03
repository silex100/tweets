# Documentation de cas d'utilisation Tweet

1. Récupération du  projet sur Git
2. Paramètration du serveur 
    1. Pour le serveur nginx, voici le code à ajouter dans la configuration du serveur
       `# nginx configuration by winginx.com`
        `location / { `
        `    if (!-e $request_filename){ `
        `        rewrite ^(.*)$ /index.php?url=$1 break; `
        `    } `
        `}`
2. Configuration Base données
    - Ficher Dump SQL : /doc/tweets.sql
    - Fichier Paramètrage Base données : /config/params.inc

3. Amélioration Possible 
    - Test Chaque données lors d'insertion

Note: Le système de Router utilisé  inspire par Grafikart:  
[link](https://grafikart.fr/tutoriels/router-628)