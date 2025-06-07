# 📰 API de blog – Laravel 12 + Sanctum + MySQL (Docker)

![Laravel Tests](https://github.com/kasse222/blog-laravel12/actions/workflows/laravel.yml/badge.svg)

Une API RESTful professionnelle développée avec Laravel 12.  
Ce projet propose la gestion complète d'un blog avec articles, commentaires, tags et une authentification sécurisée via Sanctum.

---

## ✅ Fonctionnalités

    🔐 Authentification via Laravel Sanctum

    📝 Gestion des articles (CRUD)

    💬 Gestion des commentaires

    🏷️ Système de tags (relation NN)

    🧪 Tests automatisés avec PestPHP

    📚 Documentation Swagger générée automatiquement

    🧩 Architecture MVC claire et découplée

    🗄️ Base de données MySQL 8 (via Docker)

    🐋 Déploiement local via Docker Compose

    ⚙️ CI/CD complet avec GitHub Actions

## 🚀 Installation (Docker)

```bash
git clone https://github.com/kasse222/blog-laravel12.git
cd blog-laravel12
cp .env.example .env

# Lancer l'environnement Docker
docker compose -f docker-compose.prod.yml up -d --build

# Lancer les migrations et seeders
docker compose -f docker-compose.prod.yml exec app php artisan migrate:fresh --seed

⚙️ Utilisation rapide sans Docker

composer install
cp .env.example .env
php artisan key:generate
php artisan migrate:fresh --seed
php artisan serve

📂 Principales API Routes
🔐 API d'authentification (Sanctum)
📥 Inscription

POST /api/register
| Champ                        | Type   |
| ---------------------------- | ------ |
| nom                          | chaîne |
| email                        | chaîne |
| mot\_de\_passe               | chaîne |
| confirmation\_mot\_de\_passe | chaîne |

🔐 Connexion
POST /api/login
| Champ          | Type   |
| -------------- | ------ |
| email          | chaîne |
| mot\_de\_passe | chaîne |
✅ Retourne un token :
Authorization: Bearer <ton_token>

📄 Articles
| Méthode | URI             | Authentification | Description          |
| ------- | --------------- | ---------------- | -------------------- |
| GET     | /api/posts      | ✅                | Liste des articles   |
| POST    | /api/posts      | ✅                | Créer un article     |
| GET     | /api/posts/{id} | ✅                | Détail d’un article  |
| PUT     | /api/posts/{id} | ✅                | Modifier un article  |
| DELETE  | /api/posts/{id} | ✅                | Supprimer un article |

💬 Commentaires
| Méthode | URI               | Authentification | Description            |
| ------- | ----------------- | ---------------- | ---------------------- |
| GET     | /api/commentaires | ✅                | Liste des commentaires |
| POST    | /api/commentaires | ✅                | Créer un commentaire   |

🏷️ Tags
| Méthode | URI       | Authentification | Description     |
| ------- | --------- | ---------------- | --------------- |
| GET     | /api/tags | ✅                | Lister les tags |
| POST    | /api/tags | ✅                | Créer un tag    |

🧪 Tests automatisés (PestPHP)
docker compose -f docker-compose.prod.yml exec app ./vendor/bin/pest
Tous les tests sont passés ✅
| Catégorie        | Tests réalisés                        |
| ---------------- | ------------------------------------- |
| Authentification | inscription, connexion                |
| Articles         | liste, création                       |
| Commentaires     | liste, création                       |
| Tags             | liste, création, édition, suppression |

📚 Documentation Swagger
    Générée automatiquement avec l5-swagger

    Accès à la documentation :
    http://localhost:8080/api/documentation (UI)
    http://localhost:8080/docs (JSON)

Pour régénérer la documentation :
docker compose -f docker-compose.prod.yml exec app php artisan l5-swagger:generate


🐋 Dockérisation complète
Ce projet est entièrement dockerisé avec :

*docker-compose.prod.yml : coordination des services

*Dockerfile : image PHP Laravel 12 optimisée (multi-stage)

*default.conf : configuration NGINX

*.env adapté à MySQL via Docker


Services Docker :
| Service | Rôle                       | Port exposé |
| ------- | -------------------------- | ----------- |
| nginx   | Serveur HTTP reverse-proxy | 8000        |
| app     | Laravel + PHP 8.2 FPM      | interne     |
| db      | Base de données MySQL      | 3306        |

🧰 Technologies utilisées
Laravel 12

Sanctum (authentification API)

MySQL 8 (base de données Docker)

NGINX (serveur HTTP Docker)

Docker + Docker Compose

PestPHP (tests unitaires et fonctionnels)

GitHub Actions (CI/CD)

Postman (débogage API)

⚙️ CI/CD – GitHub Actions
    Tests automatisés exécutés à chaque push

    Génération et validation du JSON Swagger

    Docker build/test auto via main.yml

    Badge visible dans ce README ✔️



👨‍💻 Auteur
Lamine Kasse – Projet personnel de reconversion back-end (Laravel/DevOps)
🎯 Objectif : intégration professionnelle
```
