
# 📰 Blog API – Laravel 12 + Sanctum + SQLite

Une API RESTful professionnelle développée avec Laravel 12.  
Ce projet propose la gestion complète d’un blog avec articles, commentaires, tags et authentification sécurisée via Sanctum.

---

## ✅ Fonctionnalités

- 🔐 Authentification via Laravel Sanctum
- 📝 Gestion des articles (CRUD)
- 💬 Gestion des commentaires
- 🏷️ Système de tags (relation N-N)
- 🧪 Tests automatisés avec PestPHP
- 🧩 Architecture MVC claire et découplée
- 🗄️ Base de données SQLite (mode local)

---

## 🚀 Installation

```bash
git clone git@github.com:<ton-utilisateur>/blog-laravel12.git
cd blog-laravel12
composer install
cp .env.example .env
php artisan key:generate
touch database/database.sqlite
php artisan migrate --seed
php artisan serve
```

---

## 🔐 Authentification API (Sanctum)

### 📥 Inscription

```http
POST /api/register
```

| Champ       | Type     |
|-------------|----------|
| name        | string   |
| email       | string   |
| password    | string   |
| password_confirmation | string |

---

### 🔐 Connexion

```http
POST /api/login
```

| Champ     | Type   |
|-----------|--------|
| email     | string |
| password  | string |

Retourne un token :  
```
Authorization: Bearer ton_token
```

---

## 📂 Routes API principales

### 📄 Posts

| Méthode | URI            | Auth | Description                  |
|---------|----------------|------|------------------------------|
| GET     | /api/posts     | ✅   | Liste des articles           |
| POST    | /api/posts     | ✅   | Créer un article             |
| GET     | /api/posts/{id}| ✅   | Détail d’un article          |
| PUT     | /api/posts/{id}| ✅   | Modifier un article          |
| DELETE  | /api/posts/{id}| ✅   | Supprimer un article         |

---

### 💬 Comments

| Méthode | URI              | Auth | Description                      |
|---------|------------------|------|----------------------------------|
| GET     | /api/comments     | ✅   | Liste des commentaires           |
| POST    | /api/comments     | ✅   | Créer un commentaire             |

---

### 🏷️ Tags

| Méthode | URI         | Auth | Description                 |
|---------|-------------|------|-----------------------------|
| GET     | /api/tags   | ✅   | Lister les tags             |
| POST    | /api/tags   | ✅   | Créer un nouveau tag        |

---

## 📊 Tests automatisés (Pest)

Tous les tests ont été validés :

| Catégorie   | Testé            | ✅ |
|-------------|------------------|----|
| Auth        | register, login  | ✔️ |
| Posts       | index, store     | ✔️ |
| Comments    | index, store     | ✔️ |
| Tags        | index, store     | ✔️ |

```bash
./vendor/bin/pest
```

Résultat :
```
Tests:    10 passed (41 assertions)
Duration: ~0.25s
```

---

## 🧰 Technologies utilisées

- Laravel 12
- Sanctum (API Token)
- SQLite (dev)
- PestPHP (tests)
- Postman (debug API)

---

## 📄 À venir

- Dockerisation (`php + nginx + mysql`)
- GitHub Actions (CI/CD pipeline)
- Documentation OpenAPI (via Laravel Scribe)

---
## 🔁 Restauration du projet

🧾 Détail du commit :

- 🔧 Recréation du dossier `vendor` via `composer install`
- 🐋 Problèmes Docker résolus : `docker-compose` correctement installé et utilisé
- 🗂️ Base de données `SQLite` configurée dans `.env` et `database.sqlite` créé
- 🧱 Migrations Laravel exécutées avec succès (`php artisan migrate`)
- 🌐 API accessible depuis `localhost` dans le container


## 👨‍💻 Auteur

**Lamine Kasse** – Projet personnel de reconversion back-end (Laravel/DevOps)  
📍 Objectif : intégration professionnelle 🇫🇷/🇨🇭

---
