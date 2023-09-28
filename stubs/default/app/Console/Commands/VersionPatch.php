<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class VersionPatch extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'version:patch';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Erhöht die Patch-Version';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $configPath = config_path('version.json');
        $configData = json_decode(file_get_contents($configPath), true);

        $configData['patch'] += 1;
        $jsonData = json_encode($configData);

        $file = config_path('version.json');
        file_put_contents($file, $jsonData);
    }
}
