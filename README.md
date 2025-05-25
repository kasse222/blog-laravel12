# 📰 Blogue API Laravel 12 avec SQLite

## 🚀 Description
Une API RESTful développée avec Laravel 12 pour gérer des articles, commentaires et tags, avec authentification via Sanctum. Le projet utilise **SQLite** pour simplifier l’environnement de développement local.

---

## 🛠️ Fonctionnalités

- Authentification API (register, login, logout, me)
- CRUD complet :
  - Articles (Posts)
  - Commentaires
  - Tags
- Relations Eloquent :
  - `User → Post` (1-n)
  - `Post → Comment` (1-n)
  - `Post ↔ Tag` (n-n)
- Validation des requêtes via `FormRequest`
- Testé avec Postman

---

## 📦 Tech Stack

- **Laravel 12**
- **Sanctum**
- **SQLite**
- **Postman (tests manuels)**
- **Pest (prévu pour les tests automatisés)**

---

## 🔐 Authentification Sanctum

```http
POST /api/register
POST /api/login
GET /api/me
POST /api/logout
```

---

## 📂 Endpoints principaux

### 📄 Posts

```http
GET /api/posts
POST /api/posts
GET /api/posts/{id}
PUT /api/posts/{id}
DELETE /api/posts/{id}
```

### 💬 Comments

```http
GET /api/comments
POST /api/comments
```

### 🏷️ Tags

```http
GET /api/tags
POST /api/tags
```

---

## 📁 Installation locale

```bash
git clone git@github.com:ton-username/nom-repo.git
cd nom-repo
composer install
cp .env.example .env
touch database/database.sqlite
php artisan key:generate
php artisan migrate
php artisan serve
```

---

## ✍️ Auteur

**Lamine Kasse**  
📧 kasselamine130@gmail.com  
🌍 Pop!_OS + Laravel 12 + GitHub + Postman
