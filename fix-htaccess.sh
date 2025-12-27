#!/bin/bash

# Fix .htaccess and routing issues
echo "Fixing .htaccess and routing..."

cd /home/u678276410/domains/littleflowerhs.com/public_html

# Copy .htaccess if missing
if [ ! -f .htaccess ]; then
    echo "Copying .htaccess from laravel/public..."
    cp laravel/public/.htaccess .htaccess
    echo "✅ .htaccess copied"
else
    echo "✅ .htaccess already exists"
fi

# Verify .htaccess content
echo ""
echo "Current .htaccess content:"
cat .htaccess

# Clear Laravel cache
echo ""
echo "Clearing Laravel cache..."
cd laravel
php artisan optimize:clear
php artisan optimize

echo ""
echo "✅ Done!"
