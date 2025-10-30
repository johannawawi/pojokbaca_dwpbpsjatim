<?php

if (!function_exists('supabaseUrl')) {
    /**
     * Generate public URL for Supabase Storage
     * Contoh: supabaseUrl('images/buku/xxxxx.png')
     */
    function supabaseUrl(string $path): string
    {
        $base = rtrim(env('SUPABASE_PUBLIC_BASE'), '/');
        $path = ltrim($path, '/');
        return $base . '/' . $path;
    }
}

