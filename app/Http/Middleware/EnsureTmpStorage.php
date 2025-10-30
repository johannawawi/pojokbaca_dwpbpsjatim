<?php

namespace App\Http\Middleware;

use Closure;

class EnsureTmpStorage
{
    public function handle($request, Closure $next)
    {
        $paths = [
            '/tmp/storage',
            '/tmp/storage/framework',
            '/tmp/storage/framework/views',
            '/tmp/storage/logs',
            '/tmp/storage/cache',
        ];

        foreach ($paths as $path) {
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
        }

        return $next($request);
    }
}
