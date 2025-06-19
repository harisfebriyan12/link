#!/bin/bash
# Script to update .env file to use MySQL database for Laravel project

ENV_FILE=".env"

if [ ! -f "$ENV_FILE" ]; then
  echo ".env file not found in current directory."
  exit 1
fi

# Backup .env file
cp $ENV_FILE "${ENV_FILE}.bak"

# Update DB_CONNECTION to mysql
sed -i 's/^DB_CONNECTION=.*/DB_CONNECTION=mysql/' $ENV_FILE

# Update DB_DATABASE to portal_karawang
sed -i 's/^DB_DATABASE=.*/DB_DATABASE=portal_karawang/' $ENV_FILE

# Update DB_USERNAME to root
sed -i 's/^DB_USERNAME=.*/DB_USERNAME=root/' $ENV_FILE

# Update DB_PASSWORD to empty (change if you have a password)
sed -i 's/^DB_PASSWORD=.*/DB_PASSWORD=/' $ENV_FILE

echo ".env file updated to use MySQL database 'portal_karawang' with user 'root'."
echo "Please restart your Laravel server to apply changes."
