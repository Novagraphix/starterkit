<?php

namespace Novagraphix\Starterkit;

use Illuminate\Support\Arr;
use Laravel\Ui\Presets\Preset;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Artisan;

class StarterkitPreset extends Preset
{
    const NPM_PACKAGES_TO_ADD = [
        '@tailwindcss/forms' => '^0.5.6',
        '@tailwindcss/typography' => '^0.5.10',
        'alpinejs' => '^3.13.0',
        'autoprefixer' => '^10.4.16',
        "postcss" => "^8.4.30",
        "sass" =>  "^1.68.0",
        "tailwindcss" =>  "^3.3.3",
        "@yaireo/tagify" => "^4.17.9",
        "sweetalert2" => "^11.7.31",
    ];

    const NPM_PACKAGES_TO_REMOVE = [
        'lodash',
        'axios',
    ];

    public static function install()
    {
        static::updatePackages();

        $filesystem = new Filesystem();
        $filesystem->copyDirectory(__DIR__ . '/../stubs/default', base_path());
        $filesystem->deleteDirectory(base_path() . '/resources/css');
        $filesystem->delete(base_path() . '/resources/views/welcome.blade.php');

        // update vite.config for SCSS
        static::updateFile(base_path('vite.config.js'), function ($file) {
            return str_replace("css/app.css", "scss/app.scss", $file);
        });

        static::updateFile(base_path('composer.json'), function ($file) {
            return str_replace('"require-dev": {', '"require-dev": {' . "\n\t\t" . '"barryvdh/laravel-debugbar": "^3.9",
        "beyondcode/laravel-dump-server": "^1.9",', $file);
        });

        static::updateFile(base_path('app/Http/Kernel.php'), function ($file) {
            return str_replace("'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,", "'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,\n\t\t'redirect-to-dashboard' => \App\Http\Middleware\RedirectToDashboard::class,", $file);
        });

        /* static::updateFile(base_path('app/Http/Kernel.php'), function ($file) {
            $updatedFile = str_replace("'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,", "'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,\n\t\t'redirect-to-dashboard' => \App\Http\Middleware\RedirectToDashboard::class,", $file);
            return str_replace("'password.confirm' => \Illuminate\Auth\Middleware\RequirePassword::class,", "'password.confirm' => \App\Http\Middleware\RequirePassword::class,", $updatedFile);
        }); */

        // This is needed until page named routes are available in Folio
        static::updateFile(base_path('app/Http/Middleware/Authenticate.php'), function ($file) {
            return str_replace("route('login')", "'/auth/login'", $file);
        });

        // Run the Folio and volt install commands
        Artisan::call('folio:install');
        Artisan::call('volt:install');
    }

    protected static function updatePackageArray(array $packages)
    {
        return array_merge(
            static::NPM_PACKAGES_TO_ADD,
            Arr::except($packages, static::NPM_PACKAGES_TO_REMOVE)
        );
    }

    /**
     * Update the contents of a file with the logic of a given callback.
     */
    protected static function updateFile(string $path, callable $callback)
    {
        $originalFileContents = file_get_contents($path);
        $newFileContents = $callback($originalFileContents);
        file_put_contents($path, $newFileContents);
    }
}
