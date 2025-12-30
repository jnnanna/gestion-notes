<div align="center">
  
# 🎓 EduSecure

### Système de Gestion de Notes Académiques avec OCR Intelligent

[![Laravel](https://img.shields.io/badge/Laravel-11.x-FF2D20? style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![TailwindCSS](https://img.shields.io/badge/TailwindCSS-3.x-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)](https://tailwindcss.com)
[![Alpine.js](https://img.shields.io/badge/Alpine.js-3.x-8BC0D0?style=for-the-badge&logo=alpine. js&logoColor=black)](https://alpinejs.dev)
[![MySQL](https://img.shields.io/badge/MySQL-8.0-4479A1?style=for-the-badge&logo=mysql&logoColor=white)](https://mysql.com)
[![License](https://img.shields.io/badge/License-MIT-green.svg?style=for-the-badge)](LICENSE)

[Démo en ligne](#) • [Documentation](#) • [Signaler un bug](#) • [Demander une fonctionnalité](#)

![EduSecure Dashboard](docs/images/dashboard-preview.png)

</div>

---

## 📋 Table des Matières

- [À Propos](#-à-propos)
- [Fonctionnalités Principales](#-fonctionnalités-principales)
- [Technologies Utilisées](#-technologies-utilisées)
- [Prérequis](#-prérequis)
- [Installation](#-installation)
- [Configuration](#-configuration)
- [Utilisation](#-utilisation)
- [Architecture](#-architecture)
- [Rôles & Permissions](#-rôles--permissions)
- [API Documentation](#-api-documentation)
- [Tests](#-tests)
- [Déploiement](#-déploiement)
- [Contribuer](#-contribuer)
- [Roadmap](#-roadmap)
- [Support](#-support)
- [Licence](#-licence)

---

## 🎯 À Propos

**EduSecure** est une solution complète de gestion de notes académiques conçue pour les établissements d'enseignement supérieur. L'application révolutionne la gestion des notes en intégrant des technologies OCR avancées pour numériser automatiquement les feuilles de notes manuscrites, tout en offrant un workflow de validation robuste et des capacités d'exportation professionnelles.

### 🌟 Pourquoi EduSecure ?

- **Gain de Temps** : Réduction de 80% du temps de saisie des notes grâce à l'OCR
- **Sécurité** : Workflow de validation en 3 étapes avec traçabilité complète
- **Conformité** : Exports conformes aux standards académiques (RGPD, LMD)
- **Flexibilité** : Support multi-filières, multi-niveaux, multi-formats
- **Modernité** : Interface intuitive, dark mode, responsive design

---

## ✨ Fonctionnalités Principales

### 📤 Importation Intelligente

- **OCR Multiformat** : PDF, JPG, PNG (300+ DPI recommandé)
- **Scan Direct** : Intégration scanner USB/réseau
- **App Mobile** : Capture photo via QR code
- **Traitement Batch** : Jusqu'à 50 fichiers simultanés
- **Confiance Score** : Indicateur de fiabilité par note (0-100%)
- **Correction Intelligente** : Suggestions automatiques basées sur l'historique

### ✅ Validation en 3 Étapes

1. **Upload & Scan** : Importation et numérisation OCR
2. **Catégorisation** : Assignation module/filière/semestre
3. **Vérification** : Comparaison visuelle document/données + corrections

### 👥 Gestion Multi-Rôles

| Rôle | Permissions Clés |
|------|------------------|
| **Super Admin** | Gestion complète système + paramètres globaux |
| **Administrateur** | Gestion utilisateurs, modules, filières, validation notes |
| **Enseignant** | Saisie notes, modification notes propres modules |
| **Secrétaire** | Consultation, exportation, gestion étudiants |
| **Consultant** | Consultation uniquement (lecture seule) |

### 📊 Exportation Professionnelle

- **Relevés de Notes** : Format officiel avec cachet numérique
- **Procès-Verbaux** : PV de délibération conformes
- **Bulletins Individuels** : Personnalisés par étudiant
- **Listes de Classe** : Excel/CSV avec statistiques
- **Données Brutes** : Export massif pour analyses

**Formats Supportés** :  PDF (signé), Excel, CSV  
**Personnalisation** : Logo établissement, cachet, signature, graphiques

### 🗄️ Archives & Historique

- **Archivage Automatique** :  Années académiques clôturées
- **Consultation Historique** : Recherche multi-critères
- **Traçabilité Complète** : Timeline de toutes modifications
- **Restauration** : Récupération de données archivées
- **Conformité RGPD** : Export données personnelles sur demande

### 📱 Interface Moderne

- **Dark Mode** : Thème sombre pour confort visuel
- **Responsive Design** : Mobile, tablet, desktop optimisés
- **PWA Ready** : Installation comme application native
- **Accessibilité** : WCAG 2.1 AA compliant
- **Internationalisation** : Français (défaut), Arabe, Anglais

---

## 🛠️ Technologies Utilisées

### Backend

- **Framework** : Laravel 11.x
- **Base de Données** : MySQL 8.0+ / PostgreSQL 13+
- **ORM** : Eloquent
- **Authentication** : Laravel Breeze + Fortify
- **Permissions** : Spatie Laravel Permission
- **Queue** : Redis / Database
- **Cache** : Redis / Memcached

### Frontend

- **Template Engine** : Blade Components
- **CSS Framework** : TailwindCSS 3.4
- **JavaScript** : Alpine.js 3.x
- **Icons** : Material Symbols (Google)
- **Build Tool** : Vite 5.x

### Intégrations

- **OCR Engine** : 
  - Tesseract OCR 5.x (local)
  - Google Cloud Vision API (cloud)
  - Azure Computer Vision (alternative)
- **PDF Generation** : DomPDF / TCPDF
- **Excel** : Maatwebsite Laravel Excel
- **Storage** : Laravel Storage (local/S3/FTP)
- **Email** :  SMTP / Mailgun / SendGrid

### DevOps

- **Version Control** : Git + GitHub
- **CI/CD** : GitHub Actions
- **Containerization** : Docker + Docker Compose
- **Monitoring** : Laravel Telescope + Debugbar
- **Testing** : Pest PHP / PHPUnit

---

## 📋 Prérequis

### Serveur

```bash
- PHP >= 8.2
- Composer >= 2.6
- Node.js >= 18. x
- NPM/Yarn >= 9.x
- MySQL >= 8.0 OU PostgreSQL >= 13
- Redis >= 6.x (recommandé)
- Tesseract OCR >= 5.0 (pour OCR local)
```

### Extensions PHP Requises

```ini
- BCMath
- Ctype
- Fileinfo
- JSON
- Mbstring
- OpenSSL
- PDO
- Tokenizer
- XML
- GD / Imagick (traitement images)
- Redis (si cache Redis)
```

### Recommandations Serveur

```
- RAM :  Minimum 2GB, Recommandé 4GB+
- Stockage : 10GB+ (selon volume fichiers)
- CPU : 2 cores minimum
- Bande passante :  Illimitée
```

---

## 🚀 Installation

### 1. Cloner le Repository

```bash
git clone https://github.com/votre-org/edusecure.git
cd edusecure
```

### 2. Installer les Dépendances

```bash
# Backend
composer install

# Frontend
npm install
```

### 3. Configuration Environnement

```bash
# Copier le fichier .env
cp .env.example .env

# Générer la clé d'application
php artisan key: generate

# Éditer . env avec vos paramètres
nano .env
```

### 4. Configuration Base de Données

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=edusecure
DB_USERNAME=root
DB_PASSWORD=votre_mot_de_passe
```

### 5. Migrations & Seeders

```bash
# Créer les tables
php artisan migrate

# Peupler avec données de test
php artisan db:seed

# OU tout en une fois (fresh install)
php artisan migrate: fresh --seed
```

### 6. Storage & Permissions

```bash
# Créer les liens symboliques
php artisan storage:link

# Définir les permissions (Linux/Mac)
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
```

### 7. Compilation Assets

```bash
# Développement (avec watch)
npm run dev

# Production (optimisé)
npm run build
```

### 8. Lancer le Serveur

```bash
# Serveur de développement
php artisan serve

# Avec worker pour les queues
php artisan queue:work
```

🎉 **Application accessible sur** : [http://localhost:8000](http://localhost:8000)

---

## ⚙️ Configuration

### OCR Configuration

#### Option 1 : Tesseract (Local - Gratuit)

```bash
# Installation Ubuntu/Debian
sudo apt-get install tesseract-ocr tesseract-ocr-fra

# Installation macOS
brew install tesseract tesseract-lang

# Vérifier installation
tesseract --version
```

```env
# . env
OCR_ENGINE=tesseract
TESSERACT_PATH=/usr/bin/tesseract
TESSERACT_LANGUAGES=fra,ara,eng
```

#### Option 2 : Google Cloud Vision API (Cloud - Payant)

```env
OCR_ENGINE=google
GOOGLE_CLOUD_PROJECT_ID=votre-project-id
GOOGLE_CLOUD_KEY_FILE=path/to/service-account. json
```

### Email Configuration

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=votre-email@gmail. com
MAIL_PASSWORD=votre-app-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@edusecure.ma
MAIL_FROM_NAME="EduSecure"
```

### Cache & Queue

```env
# Cache
CACHE_DRIVER=redis
REDIS_HOST=127.0.0.1
REDIS_PORT=6379

# Queue
QUEUE_CONNECTION=redis
```

### Storage Configuration

```env
# Local (défaut)
FILESYSTEM_DISK=local

# Amazon S3
FILESYSTEM_DISK=s3
AWS_ACCESS_KEY_ID=your-key
AWS_SECRET_ACCESS_KEY=your-secret
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=edusecure-uploads
```

---

## 📖 Utilisation

### Comptes par Défaut (après seeding)

| Email | Mot de passe | Rôle |
|-------|--------------|------|
| admin@edusecure.ma | password | Super Admin |
| enseignant@edusecure.ma | password | Enseignant |
| secretaire@edusecure.ma | password | Secrétaire |

⚠️ **IMPORTANT** : Changez ces mots de passe en production !

### Workflow Typique

#### 1️⃣ Import de Notes (Enseignant)

1.  Connexion avec compte enseignant
2. Menu **Notes** → **Importation**
3. Upload fichier(s) PDF/Image
4. Sélection module/filière/semestre
5. Vérification OCR + corrections
6. Soumission pour validation

#### 2️⃣ Validation (Administrateur)

1. Menu **Notes** → **Validation**
2. Liste des feuilles en attente
3. Clic sur **Examiner**
4. Comparaison document/données
5. **Valider** ou **Rejeter** avec commentaire

#### 3️⃣ Export (Secrétaire)

1. Menu **Exportation**
2. Choix modèle (Relevé, PV, Bulletin)
3. Sélection critères (filière, semestre, étudiant)
4. Aperçu avant génération
5. Téléchargement PDF/Excel

### Commandes Artisan Utiles

```bash
# Nettoyer cache
php artisan optimize:clear

# Créer un utilisateur admin
php artisan make:admin

# Archiver une année académique
php artisan archive:annee 2023-2024

# Nettoyer exports expirés
php artisan export:cleanup

# Backup base de données
php artisan backup: run

# Import étudiants CSV
php artisan import:etudiants fichier.csv

# Statistiques système
php artisan system:stats
```

---

## 🏗️ Architecture

### Structure des Dossiers

```
edusecure/
├── app/
│   ├── Console/           # Commandes Artisan
│   ├── Enums/             # Énumérations (6)
│   ├── Http/
│   │   ├── Controllers/   # Contrôleurs (16)
│   │   ├── Middleware/    # Middlewares personnalisés
│   │   └── Requests/      # Form Requests
│   ├── Models/            # Modèles Eloquent (14)
│   ├── Notifications/     # Notifications email
│   ├── Policies/          # Policies
│   └── Services/          # Services métier (OCR, Export, etc.)
│
├── database/
│   ├── factories/         # Factories (5)
│   ├── migrations/        # Migrations (15 tables)
│   └── seeders/           # Seeders (9)
│
├── resources/
│   ├── css/              # TailwindCSS
│   ├── js/               # Alpine. js + scripts
│   └── views/            # Blade templates (40+ vues)
│       ├── auth/
│       ├── components/   # 10 composants réutilisables
│       ├── layouts/
│       └── [modules]/
│
├── routes/
│   ├── web.php           # Routes web (~130)
│   ├── api.php           # Routes API (à venir)
│   └── console. php
│
├── storage/
│   ├── app/
│   │   ├── uploads/      # Fichiers uploadés
│   │   ├── exports/      # Exports générés
│   │   └── archives/     # Archives
│   ├── logs/
│   └── framework/
│
├── tests/
│   ├── Feature/          # Tests fonctionnels
│   └── Unit/             # Tests unitaires
│
├── public/
│   ├── build/            # Assets compilés (Vite)
│   └── storage/          # Lien symbolique
│
├── . env. example
├── composer.json
├── package.json
├── docker-compose.yml
└── README.md
```

### Modèle de Données (ERD Simplifié)

```
┌─────────────┐       ┌──────────────┐       ┌─────────────┐
│   Users     │──────▶│ Departments  │       │  Filieres   │
└─────────────┘       └──────────────┘       └─────────────┘
       │                                             │
       │                                             │
       ▼                                             ▼
┌─────────────────┐                          ┌─────────────┐
│ Feuilles_Notes  │──────────────────────────│  Modules    │
└─────────────────┘                          └─────────────┘
       │                                             │
       │                                             │
       ▼                                             ▼
┌─────────────┐       ┌──────────────┐       ┌─────────────┐
│    Notes    │──────▶│  Etudiants   │       │  Semestres  │
└─────────────┘       └──────────────┘       └─────────────┘
       │
       │
       ▼
┌─────────────────────┐
│ Historique_Validations │
└─────────────────────┘
```

### Services Principaux

#### OCRService

```php
namespace App\Services;

class OCRService
{
    public function processDocument(string $filePath): array
    public function extractGrades(string $text): Collection
    public function calculateConfidence(array $result): float
}
```

#### ExportService

```php
namespace App\Services;

class ExportService
{
    public function generateReleve(Etudiant $etudiant, array $options): string
    public function generatePV(Filiere $filiere, Semestre $semestre): string
    public function generateBulletin(Etudiant $etudiant): string
}
```

#### NotificationService

```php
namespace App\Services;

class NotificationService
{
    public function notifyValidation(FeuilleNote $feuille): void
    public function notifyRejection(FeuilleNote $feuille, string $reason): void
    public function sendWeeklySummary(User $user): void
}
```

---

## 🔐 Rôles & Permissions

### Matrice de Permissions

| Fonctionnalité | Super Admin | Admin | Enseignant | Secrétaire | Consultant |
|----------------|-------------|-------|------------|------------|------------|
| **Gestion Utilisateurs** | ✅ | ✅ | ❌ | ❌ | ❌ |
| **Gestion Modules/Filières** | ✅ | ✅ | ❌ | ❌ | ❌ |
| **Gestion Étudiants** | ✅ | ✅ | ✅ | ✅ | ❌ |
| **Import Notes** | ✅ | ✅ | ✅ | ❌ | ❌ |
| **Validation Notes** | ✅ | ✅ | ❌ | ❌ | ❌ |
| **Export Documents** | ✅ | ✅ | ✅ | ✅ | ❌ |
| **Consultation** | ✅ | ✅ | ✅ | ✅ | ✅ |
| **Paramètres Système** | ✅ | ❌ | ❌ | ❌ | ❌ |
| **Archives** | ✅ | ✅ | ✅ | ✅ | ✅ |

### Créer un Rôle Personnalisé

```php
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

// Créer le rôle
$role = Role::create(['name' => 'coordinateur']);

// Créer et assigner permissions
$permissions = [
    'gestion_modules',
    'validation_notes',
    'export_rapports'
];

foreach ($permissions as $permission) {
    Permission::firstOrCreate(['name' => $permission]);
}

$role->givePermissionTo($permissions);

// Assigner à un utilisateur
$user->assignRole('coordinateur');
```

---

## 📡 API Documentation

### Authentification API (Laravel Sanctum)

```bash
# Obtenir un token
POST /api/auth/login
Content-Type: application/json

{
  "email": "user@example. com",
  "password": "password"
}

# Réponse
{
  "token": "1|abc123.. .",
  "user": {... }
}
```

### Endpoints Principaux

#### Étudiants

```bash
GET    /api/etudiants              # Liste
POST   /api/etudiants              # Créer
GET    /api/etudiants/{id}         # Détail
PUT    /api/etudiants/{id}         # Modifier
DELETE /api/etudiants/{id}         # Supprimer
GET    /api/etudiants/{id}/notes   # Notes de l'étudiant
```

#### Feuilles de Notes

```bash
GET    /api/feuilles-notes                    # Liste
POST   /api/feuilles-notes                    # Créer
GET    /api/feuilles-notes/{id}               # Détail
PUT    /api/feuilles-notes/{id}/valider       # Valider
PUT    /api/feuilles-notes/{id}/rejeter       # Rejeter
GET    /api/feuilles-notes/{id}/historique    # Historique
```

#### Exports

```bash
POST   /api/exports/releve          # Générer relevé
POST   /api/exports/pv               # Générer PV
POST   /api/exports/bulletin         # Générer bulletin
GET    /api/exports/{id}/download    # Télécharger
```

**Documentation complète** : [API Docs (Postman)](docs/api/EduSecure.postman_collection.json)

---

## 🧪 Tests

### Lancer les Tests

```bash
# Tous les tests
php artisan test

# Tests spécifiques
php artisan test --filter=ImportationTest

# Avec coverage
php artisan test --coverage
```

### Structure des Tests

```
tests/
├── Feature/
│   ├── Auth/
│   │   ├── LoginTest.php
│   │   └── PasswordResetTest.php
│   ├── Importation/
│   │   ├── UploadFileTest.php
│   │   └── OCRProcessingTest.php
│   ├── Validation/
│   │   ├── ValidateFeuilleTest.php
│   │   └── RejectFeuilleTest.php
│   └── Export/
│       ├── GenerateReleveTest.php
│       └── GeneratePVTest.php
└── Unit/
    ├── Services/
    │   ├── OCRServiceTest.php
    │   └── ExportServiceTest.php
    └── Models/
        ├── FeuilleNoteTest.php
        └── EtudiantTest.php
```

### Tests Critiques

```php
// Test import avec OCR
public function test_upload_and_ocr_processing()
{
    Storage::fake('local');
    
    $file = UploadedFile::fake()->create('notes.pdf', 1000);
    
    $response = $this->actingAs($enseignant)
        ->post('/importation/upload', ['files' => [$file]]);
    
    $response->assertStatus(302);
    $this->assertDatabaseHas('fichiers_importes', [
        'nom_original' => 'notes.pdf'
    ]);
}

// Test validation feuille
public function test_admin_can_validate_feuille()
{
    $feuille = FeuilleNote::factory()->create(['statut' => StatutFeuilleNote::SOUMIS]);
    
    $response = $this->actingAs($admin)
        ->post("/validation/{$feuille->id}/valider");
    
    $response->assertRedirect();
    $this->assertEquals(StatutFeuilleNote::VALIDE, $feuille->fresh()->statut);
}
```

---

## 🚀 Déploiement

### Option 1 :  Serveur VPS (DigitalOcean, Linode, etc.)

#### 1. Prérequis Serveur

```bash
# Mise à jour système
sudo apt update && sudo apt upgrade -y

# Installation stack LAMP/LEMP
sudo apt install nginx mysql-server php8.2-fpm php8.2-mysql \
  php8.2-xml php8.2-mbstring php8.2-gd php8.2-redis \
  redis-server composer git -y

# Installation Node.js
curl -fsSL https://deb.nodesource.com/setup_18.x | sudo -E bash -
sudo apt install -y nodejs

# Installation Tesseract OCR
sudo apt install tesseract-ocr tesseract-ocr-fra -y
```

#### 2. Configuration Nginx

```nginx
server {
    listen 80;
    server_name edusecure.votre-domaine.com;
    root /var/www/edusecure/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    index index.php;

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index. php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

#### 3. Déploiement

```bash
# Cloner le projet
cd /var/www
git clone https://github.com/votre-org/edusecure.git
cd edusecure

# Installation
composer install --optimize-autoloader --no-dev
npm install && npm run build

# Configuration
cp .env.example .env
php artisan key:generate

# Permissions
sudo chown -R www-data:www-data storage bootstrap/cache
sudo chmod -R 775 storage bootstrap/cache

# Migrations
php artisan migrate --force

# Optimisations
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

#### 4. SSL avec Let's Encrypt

```bash
sudo apt install certbot python3-certbot-nginx
sudo certbot --nginx -d edusecure.votre-domaine.com
```

#### 5. Supervisor (Queue Worker)

```bash
sudo apt install supervisor

# /etc/supervisor/conf.d/edusecure-worker.conf
[program:edusecure-worker]
process_name=%(program_name)s_%(process_num)02d
command=php /var/www/edusecure/artisan queue:work redis --sleep=3 --tries=3 --max-time=3600
autostart=true
autorestart=true
stopasgroup=true
killasgroup=true
user=www-data
numprocs=2
redirect_stderr=true
stdout_logfile=/var/www/edusecure/storage/logs/worker.log
stopwaitsecs=3600

sudo supervisorctl reread
sudo supervisorctl update
sudo supervisorctl start edusecure-worker: *
```

### Option 2 : Docker

```bash
# Démarrer les conteneurs
docker-compose up -d

# Accéder au conteneur
docker-compose exec app bash

# Migrations
docker-compose exec app php artisan migrate
```

### Option 3 : Hébergement Partagé (cPanel)

1.  Téléverser fichiers via FTP
2. Importer base de données via phpMyAdmin
3. Configurer `.env`
4. Pointer `public_html` vers dossier `public`
5. Optimiser :  `php artisan optimize`

---

## 🌐 Hébergeurs Gratuits Laravel

### 🆓 Hébergeurs 100% Gratuits

#### 1. **Railway** ⭐ Recommandé
- **URL** : https://railway.app
- **Offre** : $5 crédit gratuit/mois
- **Specs** : 512MB RAM, 1GB stockage
- **MySQL** :  Inclus
- **Déploiement** : Git push
- **SSL** : Gratuit
- ✅ **Parfait pour Laravel**

#### 2. **Fly.io**
- **URL** : https://fly.io
- **Offre** : 3 VM gratuites, 3GB stockage
- **Specs** : 256MB RAM/VM
- **Base de données** : PostgreSQL gratuit
- **Déploiement** : CLI flyctl
- ✅ **Excellent performance**

#### 3. **Render**
- **URL** : https://render.com
- **Offre** : Web service gratuit
- **Specs** : 512MB RAM
- **MySQL/PostgreSQL** : Gratuit
- **Limitations** : Inactivité = sleep après 15min
- ⚠️ **Bon pour démo uniquement**

#### 4. **Vercel** (avec adaptation)
- **URL** : https://vercel.com
- **Offre** :  Hosting gratuit
- **Specs** :  Serverless
- **Note** : Nécessite adapter Laravel en serverless
- ⚠️ **Complexe pour Laravel standard**

#### 5. **InfinityFree**
- **URL** :  https://infinityfree.net
- **Offre** :  Hébergement cPanel gratuit
- **Specs** :  Illimité (avec limitations soft)
- **PHP** : 8.x supporté
- **MySQL** : 400 connexions/heure
- ⚠️ **Publicités + limitations**

#### 6. **000WebHost** (Hostinger)
- **URL** : https://www.000webhost.com
- **Offre** :  300MB espace, 3GB bande passante
- **PHP** : 8.x
- **MySQL** : 2 bases de données
- **Limitations** : Pas de cron jobs
- ⚠️ **Basique, bon pour tests**

### 💰 Hébergeurs Freemium (avec plan gratuit limité)

#### 7. **Heroku** (limité)
- **URL** : https://heroku.com
- **Offre** : Plus de plan gratuit permanent
- **Alternative** : $7/mois Eco Dynos
- ❌ **Plus vraiment gratuit**

#### 8. **PlanetScale** (Base de données)
- **URL** : https://planetscale.com
- **Offre** :  MySQL gratuit 5GB
- **Usage** : Base de données externe
- ✅ **Excellent pour BDD**

#### 9. **Supabase** (Base de données)
- **URL** : https://supabase.com
- **Offre** : PostgreSQL gratuit 500MB
- **Bonus** : API, Auth, Storage
- ✅ **Alternative intéressante**

### 🎯 Recommandation selon Usage

| Cas d'Usage | Hébergeur | Raison |
|-------------|-----------|--------|
| **Démo / Portfolio** | Railway | Facile, performant, gratuit suffisant |
| **Prototype / Test** | Fly.io | Excellente performance, multi-région |
| **Production Limitée** | Render | Bon compromis gratuit/payant |
| **Apprentissage** | 000WebHost | Simple, cPanel familier |
| **Base de données seule** | PlanetScale | MySQL gratuit robuste |

### ⚡ Configuration Rapide Railway (Exemple)

```bash
# 1. Installer CLI
npm install -g @railway/cli

# 2. Login
railway login

# 3. Initialiser projet
railway init

# 4. Lier à GitHub
railway link

# 5. Ajouter MySQL
railway add mysql

# 6. Déployer
git push

# 7. Variables d'environnement
railway variables
```

### 🔒 Important pour Hébergement Gratuit

```env
# Optimisations pour plans gratuits
APP_ENV=production
APP_DEBUG=false

# Cache
CACHE_DRIVER=file  # Pas redis si non dispo
SESSION_DRIVER=file
QUEUE_CONNECTION=database  # Pas redis

# Logs
LOG_CHANNEL=daily
LOG_LEVEL=error  # Minimiser logs
```

---

## 🤝 Contribuer

Les contributions sont les bienvenues !  Voici comment participer :

### 1. Fork & Clone

```bash
git clone https://github.com/votre-username/edusecure.git
cd edusecure
git checkout -b feature/ma-fonctionnalite
```

### 2. Développer

- Respecter [PSR-12](https://www.php-fig.org/psr/psr-12/)
- Ajouter tests pour nouvelles fonctionnalités
- Documenter code complexe

### 3. Tester

```bash
composer test
php artisan pint  # Formatage code
php artisan phpstan  # Analyse statique
```

### 4. Pull Request

```bash
git push origin feature/ma-fonctionnalite
```

Ouvrir une PR sur GitHub avec description détaillée.

### Code de Conduite

Veuillez lire [CODE_OF_CONDUCT. md](CODE_OF_CONDUCT.md).

---

## 🗺️ Roadmap

### Version 1.1 (Q1 2025)

- [ ] API REST complète (Sanctum)
- [ ] Application mobile (Flutter)
- [ ] OCR avec IA (Google Vision API)
- [ ] Signature électronique documents
- [ ] Module Planning examens

### Version 1.2 (Q2 2025)

- [ ] Dashboard analytics avancé (Chart.js)
- [ ] Export automatique programmé
- [ ] Intégration LMS (Moodle, Canvas)
- [ ] Multi-langue complet (AR, EN)
- [ ] Mode hors ligne (PWA)

### Version 2.0 (Q3 2025)

- [ ] IA prédictive (risque échec)
- [ ] Blockchain pour certificats
- [ ] Module délibération automatique
- [ ] Intégration visioconférence
- [ ] Marketplace modules tiers

---

## 📞 Support

### Documentation

- **Documentation complète** : [docs.edusecure.ma](https://docs.edusecure.ma)
- **FAQ** : [edusecure.ma/faq](https://edusecure.ma/faq)
- **Vidéos tutoriels** : [YouTube](https://youtube.com/@edusecure)

### Communauté

- **Discord** : [discord.gg/edusecure](https://discord.gg/edusecure)
- **Forum** : [forum.edusecure.ma](https://forum.edusecure.ma)
- **Discussions GitHub** : [Discussions](https://github.com/votre-org/edusecure/discussions)

### Contact

- **Email** : support@edusecure.ma
- **Bug Report** : [Issues GitHub](https://github.com/votre-org/edusecure/issues)
- **Feature Request** : [Feature Requests](https://github.com/votre-org/edusecure/issues/new? template=feature_request.md)

---

## 📄 Licence

Ce projet est sous licence **MIT**. Voir [LICENSE](LICENSE) pour plus de détails.

```
MIT License

Copyright (c) 2024 EduSecure

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software... 
```

---

## 🙏 Remerciements

- [Laravel](https://laravel.com) - Framework PHP
- [TailwindCSS](https://tailwindcss.com) - CSS Framework
- [Alpine.js](https://alpinejs.dev) - JavaScript Framework
- [Material Symbols](https://fonts.google.com/icons) - Icônes
- [Spatie](https://spatie.be) - Packages Laravel
- Tous les contributeurs open-source

---

## 🌟 Stargazers

Si ce projet vous aide, donnez-lui une ⭐ sur GitHub !

[![Stargazers](https://reporoster.com/stars/votre-org/edusecure)](https://github.com/votre-org/edusecure/stargazers)

---

<div align="center">

**Fait avec ❤️ pour l'éducation**

[Site Web](https://edusecure.ma)

</div>