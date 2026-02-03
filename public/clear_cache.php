<?php

use Illuminate\Support\Facades\Artisan;

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';

// Bootstrap the console kernel
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

// Run the commands
foreach (['config:clear', 'cache:clear', 'route:clear', 'view:clear','optimize:clear', 'config:cache'] as $command) {
    Artisan::call($command);
    echo Artisan::output() . "<br>";
}
echo "Cache cleared successfully.";