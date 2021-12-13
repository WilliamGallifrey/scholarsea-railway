<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class CleanSlateCommand extends Command
{
    protected $signature = 'scholarsea:clean-slate';
    const QUEUE = 'axie';

    public function handle()
    {
        echo "Migrations" . "\n";
        $this->callSilently('migrate:fresh');

        echo "Base Seeders" . "\n";
        $this->callSilently('db:seed');

        echo "User Seeder" . "\n";
        $this->callSilently('db:seed',['--class' => 'UserFakeSeeder']);

        echo "Hash Seeder" . "\n";
        $this->callSilently('db:seed',['--class' => 'HashFakeSeeder']);

        echo "SLP Info" . "\n";
        $this->callSilently('axie:slp');

        echo "Axie Info & Parts" . "\n";
        $this->callSilently('axie:axies');

        echo "Axie Cards & Details" . "\n";
        $this->callSilently('axie:details');

        echo "OK!". "\n";
    }
}
