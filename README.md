# Alothaim Task Management

A Laravel-based task management application.

---

## 🚀 Installation

### Using Docker (recommended)

```bash
# Clone the repository
git clone git@github.com:Hossam-Tarek/alothaim-task.git
cd alothaim-task

# Copy environment file
cp .env.example .env

# Start containers
docker compose up -d

# Run database seeders
docker compose exec php php artisan db:seed
```

### Without Docker
#### requirements
Make sure you have the following installed:
- PHP 8.2+ 
- Composer 
- MySQL 8+ 
- Node.js & NPM 
- Nginx or Apache (or run via php artisan serve)

```bash
# Clone the repository
git clone git@github.com:Hossam-Tarek/alothaim-task.git
cd alothaim-task

# Copy environment file
cp .env.example .env

# Install PHP dependencies
composer install

# Generate application key
php artisan key:generate

# Run migrations and seeders
php artisan migrate:fresh --seed

# Install JS dependencies
npm install

# Build frontend assets
npm run build

```

### 🔑 Admin Credentials

After seeding, you can log in using the default admin account:
- Email: admin@admin.com 
- Password: 123456789
