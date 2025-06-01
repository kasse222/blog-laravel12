# 📰 API de blog – Laravel 12 + Sanctum + MySQL (Docker)

Une API RESTful professionnelle développée avec Laravel 12.
Ce projet propose la gestion complète d'un blog avec articles, commentaires, tags et une authentification sécurisée via Sanctum.

---

## ✅ Fonctionnalités

* 🔐 Authentification via Laravel Sanctum
* 📝 Gestion des articles (CRUD)
* 💬 Gestion des commentaires
* 🏷️ Système de tags (relation NN)
* 🧪 Tests automatisés avec PestPHP
* 🧩 Architecture MVC claire et découplée
* 🗄️ Base de données **MySQL 8 (via Docker)**
* 🐋 Déploiement local via **Docker Compose**

---

## 🚀 Installation (Docker)

```bash
git clone git@github.com:<ton-utilisateur>/blog-laravel12.git
cd blog-laravel12
cp .env.example .env

# Lancer l'environnement Docker
docker compose -f docker-compose.prod.yml up -d --build

# Lancer les migrations et seeders
docker compose -f docker-compose.prod.yml exec app php artisan migrate:fresh --seed
```

---

## 📂 Principales API Routes

### 🔐 API d'authentification (Sanctum)

#### 📥 Inscription

```
POST /api/register
```

| Champ                        | Type   |
| ---------------------------- | ------ |
| nom                          | chaîne |
| email                        | chaîne |
| mot\_de\_passe               | chaîne |
| confirmation\_mot\_de\_passe | chaîne |

#### 🔐 Connexion

```
POST /api/login
```

| Champ          | Type   |
| -------------- | ------ |
| email          | chaîne |
| mot\_de\_passe | chaîne |

✅ Retourne un token :

```
Authorization: Bearer <ton_token>
```

### 📄 Articles

| Méthode | URI             | Authentification | Description          |
| ------- | --------------- | ---------------- | -------------------- |
| GET     | /api/posts      | ✅                | Liste des articles   |
| POST    | /api/posts      | ✅                | Créer un article     |
| GET     | /api/posts/{id} | ✅                | Détail d’un article  |
| PUT     | /api/posts/{id} | ✅                | Modifier un article  |
| DELETE  | /api/posts/{id} | ✅                | Supprimer un article |

### 💬 Commentaires

| Méthode | URI               | Authentification | Description            |
| ------- | ----------------- | ---------------- | ---------------------- |
| GET     | /api/commentaires | ✅                | Liste des commentaires |
| POST    | /api/commentaires | ✅                | Créer un commentaire   |

### 🏷️ Tags

| Méthode | URI       | Authentification | Description     |
| ------- | --------- | ---------------- | --------------- |
| GET     | /api/tags | ✅                | Lister les tags |
| POST    | /api/tags | ✅                | Créer un tag    |

---

## 🧪 Tests automatisés (PestPHP)

```bash
docker compose -f docker-compose.prod.yml exec app ./vendor/bin/pest
```

**Tous les tests sont passés ✅**

| Catégorie        | Tests réalisés                        |
| ---------------- | ------------------------------------- |
| Authentification | inscription, connexion                |
| Articles         | liste, création                       |
| Commentaires     | liste, création                       |
| Tags             | liste, création, édition, suppression |

---

## 🐋 Dockérisation complète

Ce projet est entièrement dockerisé avec :

* `docker-compose.prod.yml` : coordination des services
* `docker/php/Dockerfile` : image PHP Laravel 12 optimisée
* `docker/nginx/default.conf` : configuration NGINX
* `.env` adapté à **MySQL via Docker**

### Services Docker :

| Service | Rôle                       | Port exposé |
| ------- | -------------------------- | ----------- |
| nginx   | Serveur HTTP reverse-proxy | 8000        |
| app     | Laravel + PHP 8.2 FPM      | interne     |
| db      | Base de données MySQL      | 3306        |

---

## 📄 À venir

* ✅ CI/CD avec GitHub Actions (tests + déploiement)
* ✅ Documentation API via Laravel Scribe
* 🔐 Rotation des tokens et politiques d’accès avancées
* ☁️ Déploiement distant (VPS, Render, etc.)

---

## 🧰 Technologies utilisées

* Laravel 12
* Sanctum (authentification API)
* MySQL 8 (base de données Docker)
* NGINX (serveur HTTP Docker)
* Docker + Docker Compose
* PestPHP (tests unitaires et fonctionnels)
* Postman (débogage API)

---

## 👨‍💻 Auteur

**Lamine Kasse** – Projet personnel de reconversion back-end (Laravel/DevOps)
🎯 Objectif : intégration professionnelle 🇫🇷/🇨🇭

