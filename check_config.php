<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();
echo "APP_URL: " . config('app.url') . "\n";
echo "FILESYSTEM_DISK: " . config('filesystems.default') . "\n";
echo "PUBLIC_DISK_URL: " . config('filesystems.disks.public.url') . "\n";
