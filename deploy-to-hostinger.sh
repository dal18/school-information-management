#!/bin/bash

# Hostinger Deployment Script
# School Information Management System

echo "=========================================="
echo "🚀 Deploying to Hostinger..."
echo "=========================================="
echo ""

# Configuration
SERVER="u678276410@145.79.25.219"
PORT="65002"
BASE_DIR="/home/u678276410/domains/littleflowerhs.com/public_html"
REPO_URL="https://github.com/dal18/school-information-management.git"

echo "📦 Step 1: Backup current files..."
ssh -p $PORT $SERVER << 'ENDSSH'
cd /home/u678276410/domains/littleflowerhs.com/public_html
if [ -d "laravel" ]; then
    mv laravel laravel-backup-$(date +%Y%m%d-%H%M%S)
    echo "✅ Backed up laravel folder"
fi
if [ -d "public" ]; then
    mv public public-backup-$(date +%Y%m%d-%H%M%S)
    echo "✅ Backed up public folder"
fi
ENDSSH

echo ""
echo "📥 Step 2: Clone repository from GitHub..."
ssh -p $PORT $SERVER << 'ENDSSH'
cd /home/u678276410/domains/littleflowerhs.com/public_html
git clone https://github.com/dal18/school-information-management.git laravel
echo "✅ Repository cloned"
ENDSSH

echo ""
echo "⚙️  Step 3: Setup environment file..."
ssh -p $PORT $SERVER << 'ENDSSH'
cd /home/u678276410/domains/littleflowerhs.com/public_html/laravel
cp .env.example .env

# Update .env file
cat > .env << 'EOF'
APP_NAME="School Information Management System"
APP_ENV=production
APP_KEY=
APP_DEBUG=false
APP_URL=https://littleflowerhs.com

APP_LOCALE=en
APP_FALLBACK_LOCALE=en
APP_FAKER_LOCALE=en_US

APP_MAINTENANCE_DRIVER=file
BCRYPT_ROUNDS=12

LOG_CHANNEL=stack
LOG_STACK=single
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=u678276410_lfhs_database
DB_USERNAME=u678276410_lfhs_user
DB_PASSWORD=Baruela0518qwerty

SESSION_DRIVER=database
SESSION_LIFETIME=120
SESSION_ENCRYPT=false
SESSION_PATH=/
SESSION_DOMAIN=null

BROADCAST_CONNECTION=log
FILESYSTEM_DISK=local
QUEUE_CONNECTION=database

CACHE_STORE=database

MEMCACHED_HOST=127.0.0.1

REDIS_CLIENT=phpredis
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=smtp
MAIL_SCHEME=null
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=adrianbaruela0@gmail.com
MAIL_PASSWORD="uavf cxjj ijye uqfw"
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="noreply@school.edu"
MAIL_FROM_NAME="${APP_NAME}"

ADMISSION_DEADLINE="2024-12-31"
MAX_FILE_UPLOAD_SIZE=5120
ALLOWED_FILE_TYPES="pdf,jpg,jpeg,png,doc,docx"

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_USE_PATH_STYLE_ENDPOINT=false

VITE_APP_NAME="${APP_NAME}"
EOF

echo "✅ Environment file created"
ENDSSH

echo ""
echo "📦 Step 4: Install Composer dependencies..."
ssh -p $PORT $SERVER << 'ENDSSH'
cd /home/u678276410/domains/littleflowerhs.com/public_html/laravel
composer install --optimize-autoloader --no-dev
echo "✅ Dependencies installed"
ENDSSH

echo ""
echo "🔑 Step 5: Generate application key..."
ssh -p $PORT $SERVER << 'ENDSSH'
cd /home/u678276410/domains/littleflowerhs.com/public_html/laravel
php artisan key:generate
echo "✅ App key generated"
ENDSSH

echo ""
echo "🗄️  Step 6: Run database migrations..."
ssh -p $PORT $SERVER << 'ENDSSH'
cd /home/u678276410/domains/littleflowerhs.com/public_html/laravel
php artisan migrate:fresh --force
echo "✅ Migrations completed"
ENDSSH

echo ""
echo "💾 Step 7: Cache configuration..."
ssh -p $PORT $SERVER << 'ENDSSH'
cd /home/u678276410/domains/littleflowerhs.com/public_html/laravel
php artisan config:cache
php artisan route:cache
php artisan view:cache
echo "✅ Configuration cached"
ENDSSH

echo ""
echo "🔒 Step 8: Set file permissions..."
ssh -p $PORT $SERVER << 'ENDSSH'
cd /home/u678276410/domains/littleflowerhs.com/public_html/laravel
chmod -R 755 storage bootstrap/cache
echo "✅ Permissions set"
ENDSSH

echo ""
echo "📁 Step 9: Setup public directory..."
ssh -p $PORT $SERVER << 'ENDSSH'
cd /home/u678276410/domains/littleflowerhs.com/public_html
cp -r laravel/public/* ./
sed -i "s|__DIR__.'/../vendor|__DIR__.'/laravel/vendor|g" index.php
sed -i "s|__DIR__.'/../bootstrap/app.php|__DIR__.'/laravel/bootstrap/app.php|g" index.php
echo "✅ Public directory configured"
ENDSSH

echo ""
echo "=========================================="
echo "✅ DEPLOYMENT COMPLETE!"
echo "=========================================="
echo ""
echo "🌐 Your website is now live at:"
echo "   https://littleflowerhs.com"
echo ""
echo "🔐 Default admin credentials:"
echo "   Email: admin@lfhs.edu"
echo "   Password: password"
echo ""
echo "⚠️  IMPORTANT: Change the admin password after first login!"
echo ""
