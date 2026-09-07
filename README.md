# Atlas Stay

## Présentation du projet

Atlas Stay est une plateforme web dédiée à la découverte et à la réservation des hôtels situés dans les régions montagneuses du Maroc.

La plateforme permet aux utilisateurs de rechercher des hébergements, consulter les informations et les images des hôtels, effectuer des réservations et gérer leurs avis.

Le système propose trois rôles principaux :

- **Client** : recherche des hôtels, réservation, gestion des réservations et des avis.
- **Propriétaire** : gestion de ses hôtels, images et réservations.
- **Administrateur** : gestion des utilisateurs, hôtels, réservations et avis.

Les principales destinations couvertes sont :

- Béni Mellal
- Azilal
- Bin El Ouidane
- Ifrane
- Khénifra
- Chefchaouen

---

## Technologies

### Backend
- PHP 8.3
- Laravel
- Laravel Sanctum
- Eloquent ORM

### Frontend
- Blade
- Tailwind CSS
- JavaScript
- Vite

### Base de données
- MySQL 8.0

### Serveur et déploiement
- Nginx
- PHP-FPM
- Docker
- Docker Compose

### Gestion du projet
- Git
- GitHub
- Composer
- npm

---

## Architecture

Le projet suit l'architecture **MVC (Model - View - Controller)** de Laravel.

```text
                    Atlas Stay
                        │
          ┌─────────────┴─────────────┐
          │                           │
       Frontend                    Backend
          │                           │
   Blade + Tailwind              Laravel
   JavaScript + Vite                 │
                                    │
                              Controllers
                                    │
                                  Models
                                    │
                                Eloquent ORM
                                    │
                                    ▼
                                  MySQL
```

L'application utilise également une API REST sécurisée avec **Laravel Sanctum**.

Pour le déploiement avec Docker :

```text
             Navigateur
                  │
                  ▼
             Nginx : 8000
                  │
                  ▼
          Laravel / PHP-FPM
                  │
                  ▼
              MySQL 8.0
```

---

## Installation classique

### Prérequis

- PHP 8.3 ou supérieur
- Composer
- MySQL
- Node.js
- npm
- Git

### 1. Cloner le projet

```bash
git clone https://github.com/YOUR_USERNAME/Atlas-Stay.git
cd Atlas-Stay
```

### 2. Installer les dépendances PHP

```bash
composer install
```

### 3. Installer les dépendances frontend

```bash
npm install
```

### 4. Configurer l'environnement

Créer le fichier `.env` :

```bash
cp .env.example .env
```

Générer la clé Laravel :

```bash
php artisan key:generate
```

Configurer la base de données dans `.env` :

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=atlas_stay
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Créer la base de données

```sql
CREATE DATABASE atlas_stay;
```

### 6. Exécuter les migrations et seeders

```bash
php artisan migrate --seed
```

### 7. Créer le lien du Storage

```bash
php artisan storage:link
```

### 8. Compiler les assets

```bash
npm run build
```

### 9. Lancer l'application

```bash
php artisan serve
```

L'application sera accessible sur :

```text
http://127.0.0.1:8000
```

---

## Installation avec Docker

### Prérequis

- Docker Desktop
- Docker Compose

### 1. Construire les containers

```bash
docker compose build
```

### 2. Démarrer les services

```bash
docker compose up -d
```

### 3. Vérifier les containers

```bash
docker compose ps
```

Les services utilisés sont :

```text
atlas-stay-app
atlas-stay-nginx
atlas-stay-db
```

### 4. Exécuter les migrations

```bash
docker compose exec app php artisan migrate
```

### 5. Exécuter les seeders

```bash
docker compose exec app php artisan db:seed
```

Ou directement :

```bash
docker compose exec app php artisan migrate:fresh --seed
```

### 6. Créer le lien Storage

```bash
docker compose exec app php artisan storage:link
```

### 7. Nettoyer le cache Laravel

```bash
docker compose exec app php artisan optimize:clear
```

### 8. Accéder à l'application

```text
http://localhost:8000
```

### Commandes Docker utiles

```bash
docker compose down
docker compose restart
docker compose ps
docker compose logs
```

---

## Structure du projet

```text
Atlas-Stay/
│
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   └── Middleware/
│   │
│   └── Models/
│
├── bootstrap/
├── config/
│
├── database/
│   ├── factories/
│   ├── migrations/
│   └── seeders/
│
├── docker/
│   └── nginx/
│       └── default.conf
│
├── public/
│   └── images/
│
├── resources/
│   ├── css/
│   ├── js/
│   └── views/
│
├── routes/
│   ├── api.php
│   ├── console.php
│   └── web.php
│
├── storage/
├── tests/
│
├── .dockerignore
├── .env.example
├── Dockerfile
├── docker-compose.yml
├── composer.json
├── composer.lock
├── package.json
├── package-lock.json
├── vite.config.js
└── README.md
```
