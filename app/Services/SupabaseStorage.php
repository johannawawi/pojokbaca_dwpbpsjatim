<?php

namespace App\Services;

use Supabase\Storage\StorageClient;

class SupabaseStorage
{
    protected StorageClient $client;
    protected string $bucket;
    protected string $publicBase;

    public function __construct()
    {
        $this->client = new StorageClient(
            rtrim(env('SUPABASE_URL'), '/'),
            env('SUPABASE_KEY')
        );

        // Bucket & public base yang kamu pakai
        $this->bucket     = env('SUPABASE_BUCKET', 'assets');
        // contoh: https://...supabase.co/storage/v1/object/public/assets
        $this->publicBase = rtrim(env('SUPABASE_PUBLIC_BASE'), '/');
    }

    /**
     * Upload ke folder dalam bucket (public), return HANYA nama file
     * $folder contoh: images/buku
     */
    public function uploadPublic(string $folder, \Illuminate\Http\UploadedFile $file): string
    {
        $ext  = strtolower($file->getClientOriginalExtension() ?: $file->extension());
        $rand = bin2hex(random_bytes(4));
        $name = time() . '_' . $rand . '.' . $ext;

        $pathInBucket = trim($folder, '/') . '/' . $name;

        $this->client
            ->from($this->bucket)
            ->upload(
                $pathInBucket,
                $file->getContent(),
                [
                    'contentType' => $file->getMimeType() ?: 'application/octet-stream',
                    'upsert'      => false,
                ]
            );

        return $name; // O1: hanya nama file
    }

    /** Hapus file lama (aman kalau kosong / tidak ada) */
    public function deleteIfExists(string $folder, ?string $fileName): void
    {
        if (!$fileName) return;

        $pathInBucket = trim($folder, '/') . '/' . ltrim($fileName, '/');

        try {
            $this->client->from($this->bucket)->remove([$pathInBucket]);
        } catch (\Throwable $e) {
            // sengaja didiamkan biar tidak ganggu UX kalau file sudah tidak ada
        }
    }

    /** Bangun public URL dari folder + nama file */
    public function publicUrl(string $folder, string $fileName): string
    {
        return $this->publicBase . '/' . trim($folder, '/') . '/' . ltrim($fileName, '/');
    }
}
