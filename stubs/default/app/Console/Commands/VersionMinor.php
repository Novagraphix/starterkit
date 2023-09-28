<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class VersionMinor extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'version:minor';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Erhöht die Minor-Version';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $configPath = config_path('version.json');
        $configData = json_decode(file_get_contents($configPath), true);

        $configData['minor'] += 1;
        $jsonData = json_encode($configData);

        $file = config_path('version.json');
        file_put_contents($file, $jsonData);
    }
}
