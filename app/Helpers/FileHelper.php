<?php

namespace App\Helpers;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class FileHelper
{


    /**
     * uploadFile
     *
     * @param  mixed $file
     * @param  mixed $filePath
     * @return string
     */
    public static function uploadFile(UploadedFile $file, string $filePath): string|bool
    {
        try {
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '_' . Str::uuid() . '.' . $extension;

            $basePath = rtrim(env('APP_STORAGE'), '/');
            $subPath = ltrim($filePath, '/');
            $path = $basePath . '/' . $subPath;

            // $mimeType = $file->getMimeType(); // Commented out because 'mimetype' option is not used by putFileAs in Laravel

            $disk = config('filesystems.default');

            $stored = Storage::disk($disk)->putFileAs($path, $file, $filename, [
                'visibility' => 'public'
                // 'mimetype' => $mimeType // Laravel handles MIME type automatically; this option is ignored
            ]);

            if ($stored) {
                return asset($filePath . '/' . $filename);
            }

            return false;
        } catch (\Exception $e) {
            Log::error('File upload error: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * deleteFile
     *
     * @param  mixed $filePath
     * @param  mixed $disk
     * @return bool
     */
    public static function deleteFile(string $filePath, string $disk = 'public'): bool
    {
        try {
            // Check if the file exists on the specified disk
            if (Storage::disk($disk)->exists($filePath)) {
                // Delete the file if it exists
                Storage::disk($disk)->delete($filePath);
                Log::info("File '{$filePath}' deleted successfully from disk '{$disk}'.");
                return true;
            }
            Log::warning("File '{$filePath}' not found on disk '{$disk}'.");
            return false;
        } catch (\Exception $e) {
            Log::error('File deletion error: ' . $e->getMessage());
            return false;
        }
    }
}
