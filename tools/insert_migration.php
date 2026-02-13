<?php

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../bootstrap/app.php';

app()->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$db = Illuminate\Support\Facades\DB::connection();
$name = $argv[1] ?? '2014_10_12_100000_create_password_reset_tokens_table';

$exists = $db->table('migrations')->where('migration', $name)->exists();
if ($exists) {
    echo "already_exists\n";
    exit(0);
}

$batch = $db->table('migrations')->max('batch');
$batch = $batch ? (int) $batch : 0;

$db->table('migrations')->insert([
    'migration' => $name,
    'batch' => $batch,
]);

echo "inserted_batch_{$batch}\n";
