<?php

use Illuminate\Foundation\Application;
use Illuminate\Contracts\Http\Kernel;
use Illuminate\Contracts\Console\Kernel as ConsoleKernel;
use Illuminate\Contracts\Debug\ExceptionHandler;
use App\Http\Kernel as HttpKernel;
use App\Console\Kernel as AppConsoleKernel;
use App\Exceptions\Handler;

$app = new Application(
    $_ENV['APP_BASE_PATH'] ?? dirname(__DIR__)
);

/*
|--------------------------------------------------------------------------
| FIX FOR VERCEL (READ-ONLY FILESYSTEM)
|--------------------------------------------------------------------------
|
| /tmp is writable on Vercel, so we redirect Laravel storage & bootstrap cache.
|
*/

$app->useStoragePath('/tmp/storage');

// Override storage and bootstrap cache paths
$app->instance('path.storage', '/tmp/storage');
$app->instance('path.bootstrap', '/tmp/storage/framework');

/*
|--------------------------------------------------------------------------
| Bind Important Interfaces
|--------------------------------------------------------------------------
*/

$app->singleton(
    Illuminate\Contracts\Http\Kernel::class,
    HttpKernel::class
);

$app->singleton(
    Illuminate\Contracts\Console\Kernel::class,
    AppConsoleKernel::class
);

$app->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class,
    Handler::class
);

return $app;
