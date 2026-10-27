@echo off
setlocal enabledelayedexpansion

echo ========================================================
echo   CampusVoice Setup (PHP 8.4 + Laragon MySQL)
echo ========================================================

set "PHP_DIR=C:\laragon\bin\php\php-8.4.27-1-Win32-vs17-x64"
set "COMPOSER_PHAR=C:\laragon\bin\composer\composer.phar"
set "MYSQL_EXE=C:\laragon\bin\mysql\mysql-8.0.30-winx64\bin\mysql.exe"

if not exist "!PHP_DIR!\php.exe" (
    echo [ERROR] PHP 8.4 tidak ditemukan di !PHP_DIR!
    pause
    exit /b 1
)

set "PATH=!PHP_DIR!;%PATH%"

echo.
echo [1/4] Memastikan database MySQL 'campusvoice' tersedia di Laragon...
if exist "!MYSQL_EXE!" (
    "!MYSQL_EXE!" -u root -e "CREATE DATABASE IF NOT EXISTS campusvoice CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
    echo Database 'campusvoice' siap digunakan.
) else (
    echo [INFO] mysql.exe tidak ditemukan di path default, pastikan Laragon MySQL aktif.
)

echo.
echo [2/4] Menjalankan composer install dengan PHP 8.4...
if exist "!COMPOSER_PHAR!" (
    "!PHP_DIR!\php.exe" "!COMPOSER_PHAR!" install
) else (
    composer install
)

echo.
echo [3/4] Generate APP_KEY...
"!PHP_DIR!\php.exe" artisan key:generate

echo.
echo [4/5] Menjalankan migrasi database...
"!PHP_DIR!\php.exe" artisan migrate --force

echo.
echo [5/5] Build asset frontend (Vite)...
call npm.cmd install
call npm.cmd run build

echo.
echo ========================================================
echo   Setup selesai! Database Laragon, dependencies, & Vite siap.
echo ========================================================
pause
