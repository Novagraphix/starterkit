# Starterkit - WIP - DO NOT USE !!!

```
composer require novagraphix/starterkit
php artisan ui starterkit
composer update
php artisan migrate
npm install
npm run dev
```

## IMPORTANT

Change `middleware(['guest']);` to `middleware(['role:Administrator']);` in `resources/views/pages/auth/register.blade.php` after first user is registered.

## TO DOC

- Helpers
- Version
- Permission
