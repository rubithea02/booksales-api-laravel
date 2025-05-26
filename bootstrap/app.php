<?php

use Illuminate\Foundation\Application;
use App\Http\Middleware\CheckRole;

/*
|--------------------------------------------------------------------------
| Create The Application
|--------------------------------------------------------------------------
*/

$app = new Application(
    $_ENV['APP_BASE_PATH'] ?? dirname(__DIR__)
);

/*
|--------------------------------------------------------------------------
| Bind Important Interfaces
|--------------------------------------------------------------------------
*/

$app->singleton(
    Illuminate\Contracts\Http\Kernel::class,
    App\Http\Kernel::class
);

$app->singleton(
    Illuminate\Contracts\Console\Kernel::class,
    App\Console\Kernel::class
);

$app->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class,
    App\Exceptions\Handler::class
);

/*
|--------------------------------------------------------------------------
| Register Middleware Alias
|--------------------------------------------------------------------------
|
| Jika kamu menggunakan Laravel 11 dan tidak punya Http\Kernel.php,
| kamu bisa mendaftarkan alias middleware di sini secara langsung
| menggunakan metode macro/extend custom, atau dengan closure middleware.
|
*/

// $app->config('middleware.alias.role', CheckRole::class);

/*
|--------------------------------------------------------------------------
| Return The Application
|--------------------------------------------------------------------------
*/

return $app;
