## Démarrer l'API

Pour démarrer le projet, veuillez ajouter et remplir un fichier `.env` selon la template du fichier `.env.example`.<br/>

Ensuite, veuillez exécuter ces deux commandes dans l'ordre en vous assurant d'être à la racine du projet sur votre terminal.

```
php artisan migrate
php artisan db:seed
php artisan jwt:secret
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

|       email       | password |
| :---------------: | :------: |
| karine@gmail.com  | password |
| nicolas@gmail.com | password |
| alexis@gmail.com  | password |

## Routes

Toutes les routes ci-dessous sont uniquement accessibles aux administrateurs connectés. Veuillez ajouter le token obtenu lors de la connexion en tant que `Bearer Token` avec chaque requête.

### Liste des routes disponibles

#### Etudiant

-   `fristname` : String
-   `lastname` : String
-   `age` : Integer
-   `entry_year` : Integer
-   `student_class_id` : Integer

```
GET http://127.0.0.1:8000/api/students
GET http://127.0.0.1:8000/api/students/{id}
POST http://127.0.0.1:8000/api/students
PUT http://127.0.0.1:8000/api/students/{id}
DELETE http://127.0.0.1:8000/api/students/{id}
```

#### Promotion

-   `name` : String
-   `graduation_year` : Integer

```
GET http://127.0.0.1:8000/api/student-classes
GET http://127.0.0.1:8000/api/student-classes/{id}
POST http://127.0.0.1:8000/api/student-classes
PUT http://127.0.0.1:8000/api/student-classes/{id}
DELETE http://127.0.0.1:8000/api/student-classes/{id}
```

#### Professeur

-   `firstname` : String
-   `lastname` : String
-   `arrival_year` : Integer

```
GET http://127.0.0.1:8000/api/teachers
GET http://127.0.0.1:8000/api/teachers/{id}
POST http://127.0.0.1:8000/api/teachers
PUT http://127.0.0.1:8000/api/teachers/{id}
DELETE http://127.0.0.1:8000/api/teachers/{id}
```

#### Modules

-   `name` : String
-   `start_date` : Date (Y-m-d)
-   `end_date` : Date (Y-m-d)
-   `teacher_id` : Integer
-   `student_class_id` : Integer

```
GET http://127.0.0.1:8000/api/modules
GET http://127.0.0.1:8000/api/modules/{id}
POST http://127.0.0.1:8000/api/modules
PUT http://127.0.0.1:8000/api/modules/{id}
DELETE http://127.0.0.1:8000/api/modules/{id}
```

#### Notes

-   `value` : Integer
-   `student_id` : Integer
-   `module_id` : Integer

```
GET http://127.0.0.1:8000/api/marks
GET http://127.0.0.1:8000/api/marks/{id}
POST http://127.0.0.1:8000/api/marks
PUT http://127.0.0.1:8000/api/marks/{id}
DELETE http://127.0.0.1:8000/api/marks/{id}
```
