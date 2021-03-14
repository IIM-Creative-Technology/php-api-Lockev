## Démarrer l'API

Pour démarrer le projet, veuillez ajouter et remplir un fichier .env selon la template du fichier .env.example.<br/>

Ensuite, veuillez exécuter ces deux commandes dans l'ordre en vous assurant d'être à la racine du projet sur votre terminal.

```
php artisan migrate
php artisan db:seed
```

Il ne reste plus qu'à lancer le serveur !

```
php artisan serve
```

## Se connecter à un compte administrateur

Afin de vous connecter à un compte administrateur [Karine, Nicolas, Alexis], veuillez réaliser une requête POST sur l'url (à adapter si le projet n'est pas hébergé localement)

```
http://127.0.0.1:8000/api/auth/login
```

Les identifiants sont :

| username | password |
| :------: | :------: |
|  Karine  | password |
| Nicolas  | password |
|  Alexis  | password |

## Routes

Toutes les routes ci-dessous sont uniquement accessibles aux administrateurs connectés. Veuillez ajouter le token obtenu lors de la connexion en tant que `Bearer Token` avec chaque requête.

### Liste des routes disponibles

```
GET http://127.0.0.1:8000/api/[route]
GET http://127.0.0.1:8000/api/[route]/{id}
POST http://127.0.0.1:8000/api/[route]
PUT http://127.0.0.1:8000/api/[route]/{id}
DELETE http://127.0.0.1:8000/api/[route]/{id}
```

`[route]` doit être remplacé par l'un des éléments suivant :

```
students
student-classes
teachers
modules
marks
```
