# Starterkit - WIP - DO NOT USE !!!

Add to .env (Socialite)

```
GOOGLE_CLIENT_ID=***ID FROM https://console.cloud.google.com/ ***
GOOGLE_CLIENT_SECRET=*** SECRET ***
GOOGLE_REDIRECT=${APP_URL}/auth/callback
GOOGLE_REDIRECT_LOCAL=${APP_URL}/auth/callback
```

## INSTALLATION

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

## CONFIG

config/starterkit.php

```
return [
    /**
     * Enable Socialite
     */
    'socialite' => true
];
```

## TO DOC

- Helpers
- Version
- Permission
