# Ecommerce Project Setup Guide

## Environment Configuration

Create a `.env` file in the root directory with the following variables:

```env
APP_NAME="Laravel E-Commerce"
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost

LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ecommerce
DB_USERNAME=root
DB_PASSWORD=

BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DISK=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

MEMCACHED_HOST=127.0.0.1

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=smtp
MAIL_HOST=mailpit
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"
MAIL_ADMIN_EMAIL="admin@example.com"

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_USE_PATH_STYLE_ENDPOINT=false

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_HOST=
PUSHER_PORT=443
PUSHER_SCHEME=https
PUSHER_APP_CLUSTER=mt1

VITE_APP_NAME="${APP_NAME}"
VITE_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
VITE_PUSHER_HOST="${PUSHER_HOST}"
VITE_PUSHER_PORT="${PUSHER_PORT}"
VITE_PUSHER_SCHEME="${PUSHER_SCHEME}"
VITE_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"

# Stripe Configuration
STRIPE_KEY=
STRIPE_SECRET=

# Flutterwave Configuration
FLW_PUBLIC_KEY=
FLW_SECRET_KEY=
FLW_SECRET_HASH=

# Currency Configuration
CURRENCY_SYMBOL=£
CURRENCY_CODE=GBP
```

## Installation Steps

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd ecommerce
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install Node.js dependencies (if using Vite)**
   ```bash
   npm install
   ```

4. **Create environment file**
   ```bash
   cp .env.example .env
   ```

5. **Generate application key**
   ```bash
   php artisan key:generate
   ```

6. **Configure database**
   - Update database credentials in `.env` file
   - Create database: `ecommerce`

7. **Run migrations**
   ```bash
   php artisan migrate
   ```

8. **Seed database (optional)**
   ```bash
   php artisan db:seed
   ```

9. **Create storage link**
   ```bash
   php artisan storage:link
   ```

10. **Set proper permissions**
    ```bash
    chmod -R 775 storage bootstrap/cache
    ```

11. **Start development server**
    ```bash
    php artisan serve
    ```

## External Services Setup

### AWS S3 Configuration
1. Create an AWS S3 bucket
2. Get AWS Access Key ID and Secret Access Key
3. Update AWS credentials in `.env` file

### Stripe Configuration
1. Create a Stripe account
2. Get publishable and secret keys
3. Update Stripe credentials in `.env` file

### Flutterwave Configuration
1. Create a Flutterwave account
2. Get public and secret keys
3. Update Flutterwave credentials in `.env` file

### Email Configuration
1. Configure SMTP settings in `.env` file
2. Update mail credentials for notifications

## Admin Access

Default admin credentials (if seeded):
- Email: admin@example.com
- Password: password

## Important Notes

- Make sure PHP version is 8.1 or higher
- MySQL version should be 5.7 or higher
- Composer should be installed globally
- Node.js is required for asset compilation
- SSL certificate is recommended for production

## Troubleshooting

1. **Permission issues**: Run `chmod -R 775 storage bootstrap/cache`
2. **Composer issues**: Clear cache with `composer clear-cache`
3. **Database issues**: Check credentials in `.env` file
4. **Storage issues**: Run `php artisan storage:link`

## Production Deployment

1. Set `APP_ENV=production`
2. Set `APP_DEBUG=false`
3. Configure production database
4. Set up SSL certificate
5. Configure web server (Apache/Nginx)
6. Set up proper file permissions
7. Configure caching (Redis/Memcached)
8. Set up monitoring and logging 