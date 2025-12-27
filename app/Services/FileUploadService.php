<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class FileUploadService
{
    /**
     * Upload a file to the specified directory
     *
     * @param UploadedFile $file
     * @param string $directory
     * @param string|null $oldFile
     * @param bool $optimize
     * @param int $maxWidth
     * @param bool $generateWebP
     * @param bool $generateThumbnail
     * @return string
     */
    public function upload(
        UploadedFile $file,
        string $directory,
        ?string $oldFile = null,
        bool $optimize = true,
        int $maxWidth = 1200,
        bool $generateWebP = true,
        bool $generateThumbnail = true
    ): string {
        // Delete old file if exists (including WebP and thumbnail variants)
        if ($oldFile) {
            $this->deleteWithVariants($oldFile);
        }

        // Generate unique filename
        $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $path = $directory . '/' . $filename;

        // Check if it's an image and optimization is enabled
        if ($optimize && $this->isImage($file)) {
            $this->uploadOptimizedImage($file, $path, $maxWidth, $generateWebP, $generateThumbnail);
        } else {
            // Upload file directly
            Storage::disk('public')->put($path, file_get_contents($file));
        }

        return $path;
    }

    /**
     * Upload and optimize an image
     *
     * @param UploadedFile $file
     * @param string $path
     * @param int $maxWidth
     * @param bool $generateWebP
     * @param bool $generateThumbnail
     * @return void
     */
    protected function uploadOptimizedImage(
        UploadedFile $file,
        string $path,
        int $maxWidth,
        bool $generateWebP = true,
        bool $generateThumbnail = true
    ): void {
        // Check if Intervention Image v3 is available (Laravel)
        if (class_exists('\Intervention\Image\Laravel\Facades\Image')) {
            try {
                $image = \Intervention\Image\Laravel\Facades\Image::read($file);

                // Resize if width exceeds max
                if ($image->width() > $maxWidth) {
                    $image->scale(width: $maxWidth);
                }

                // Save optimized JPEG/PNG image
                $encoded = $image->toJpeg(quality: 85);
                Storage::disk('public')->put($path, (string) $encoded);

                // Generate WebP version for better compression
                if ($generateWebP) {
                    $this->generateWebPVersion($path, $image);
                }

                // Generate thumbnail
                if ($generateThumbnail) {
                    $this->generateThumbnail($path, $image);
                }

                return;
            } catch (\Exception $e) {
                // Fall through to direct upload
                \Log::error('Image optimization failed: ' . $e->getMessage());
            }
        }
        // Check if Intervention Image v2 is available (older version)
        elseif (class_exists('\Intervention\Image\Facades\Image')) {
            try {
                $image = \Intervention\Image\Facades\Image::make($file);

                // Resize if width exceeds max
                if ($image->width() > $maxWidth) {
                    $image->resize($maxWidth, null, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    });
                }

                // Save optimized image
                Storage::disk('public')->put($path, (string) $image->encode());

                // Note: WebP and thumbnail generation for v2 would require different syntax
                return;
            } catch (\Exception $e) {
                // Fall through to direct upload
                \Log::error('Image optimization failed: ' . $e->getMessage());
            }
        }

        // Fallback to direct upload if Intervention Image is not available or failed
        Storage::disk('public')->put($path, file_get_contents($file));
    }

    /**
     * Generate WebP version of an image
     *
     * @param string $originalPath
     * @param mixed $image
     * @return void
     */
    protected function generateWebPVersion(string $originalPath, $image): void
    {
        try {
            $webpPath = $this->getWebPPath($originalPath);
            $encoded = $image->toWebp(quality: 80);
            Storage::disk('public')->put($webpPath, (string) $encoded);
        } catch (\Exception $e) {
            \Log::warning('WebP generation failed: ' . $e->getMessage());
        }
    }

    /**
     * Generate thumbnail version of an image
     *
     * @param string $originalPath
     * @param mixed $image
     * @param int $thumbnailWidth
     * @return void
     */
    protected function generateThumbnail(string $originalPath, $image, int $thumbnailWidth = 300): void
    {
        try {
            $thumbnailPath = $this->getThumbnailPath($originalPath);
            $thumbnail = clone $image;

            if ($thumbnail->width() > $thumbnailWidth) {
                $thumbnail->scale(width: $thumbnailWidth);
            }

            $encoded = $thumbnail->toJpeg(quality: 80);
            Storage::disk('public')->put($thumbnailPath, (string) $encoded);
        } catch (\Exception $e) {
            \Log::warning('Thumbnail generation failed: ' . $e->getMessage());
        }
    }

    /**
     * Upload multiple files
     *
     * @param array $files
     * @param string $directory
     * @param bool $optimize
     * @return array
     */
    public function uploadMultiple(array $files, string $directory, bool $optimize = true): array
    {
        $paths = [];

        foreach ($files as $file) {
            if ($file instanceof UploadedFile) {
                $paths[] = $this->upload($file, $directory, null, $optimize);
            }
        }

        return $paths;
    }

    /**
     * Delete a file
     *
     * @param string $path
     * @return bool
     */
    public function delete(string $path): bool
    {
        if (Storage::disk('public')->exists($path)) {
            return Storage::disk('public')->delete($path);
        }

        return false;
    }

    /**
     * Delete a file and all its variants (WebP, thumbnail)
     *
     * @param string $path
     * @return void
     */
    public function deleteWithVariants(string $path): void
    {
        // Delete original
        $this->delete($path);

        // Delete WebP version
        $webpPath = $this->getWebPPath($path);
        $this->delete($webpPath);

        // Delete thumbnail
        $thumbnailPath = $this->getThumbnailPath($path);
        $this->delete($thumbnailPath);
    }

    /**
     * Delete multiple files
     *
     * @param array $paths
     * @return void
     */
    public function deleteMultiple(array $paths): void
    {
        foreach ($paths as $path) {
            $this->delete($path);
        }
    }

    /**
     * Check if file is an image
     *
     * @param UploadedFile $file
     * @return bool
     */
    protected function isImage(UploadedFile $file): bool
    {
        $mimeType = $file->getMimeType();
        return str_starts_with($mimeType, 'image/');
    }

    /**
     * Get file URL
     *
     * @param string|null $path
     * @param string|null $default
     * @return string
     */
    public function getUrl(?string $path, ?string $default = null): string
    {
        if (!$path) {
            return $default ?? asset('images/default-avatar.png');
        }

        return Storage::disk('public')->url($path);
    }

    /**
     * Get validation rules for images
     *
     * @param int $maxSizeKb
     * @return array
     */
    public static function getImageRules(int $maxSizeKb = 2048): array
    {
        return [
            'image',
            'mimes:jpeg,jpg,png,gif,webp',
            'max:' . $maxSizeKb,
        ];
    }

    /**
     * Get validation rules for documents
     *
     * @param int $maxSizeKb
     * @return array
     */
    public static function getDocumentRules(int $maxSizeKb = 5120): array
    {
        return [
            'file',
            'mimes:pdf,doc,docx,xls,xlsx,txt',
            'max:' . $maxSizeKb,
        ];
    }

    /**
     * Get validation rules for any file type
     *
     * @param array $mimeTypes
     * @param int $maxSizeKb
     * @return array
     */
    public static function getFileRules(array $mimeTypes, int $maxSizeKb = 10240): array
    {
        return [
            'file',
            'mimes:' . implode(',', $mimeTypes),
            'max:' . $maxSizeKb,
        ];
    }

    /**
     * Get WebP version path from original path
     *
     * @param string $path
     * @return string
     */
    public function getWebPPath(string $path): string
    {
        $pathInfo = pathinfo($path);
        return $pathInfo['dirname'] . '/' . $pathInfo['filename'] . '.webp';
    }

    /**
     * Get thumbnail version path from original path
     *
     * @param string $path
     * @return string
     */
    public function getThumbnailPath(string $path): string
    {
        $pathInfo = pathinfo($path);
        return $pathInfo['dirname'] . '/' . $pathInfo['filename'] . '_thumb.' . $pathInfo['extension'];
    }

    /**
     * Get responsive image sources (original, WebP, thumbnail)
     *
     * @param string|null $path
     * @return array
     */
    public function getResponsiveSources(?string $path): array
    {
        if (!$path) {
            return [
                'original' => asset('images/default-avatar.png'),
                'webp' => null,
                'thumbnail' => null,
            ];
        }

        $webpPath = $this->getWebPPath($path);
        $thumbnailPath = $this->getThumbnailPath($path);

        return [
            'original' => Storage::disk('public')->url($path),
            'webp' => Storage::disk('public')->exists($webpPath) ? Storage::disk('public')->url($webpPath) : null,
            'thumbnail' => Storage::disk('public')->exists($thumbnailPath) ? Storage::disk('public')->url($thumbnailPath) : null,
        ];
    }

    /**
     * Check if WebP version exists
     *
     * @param string $path
     * @return bool
     */
    public function hasWebPVersion(string $path): bool
    {
        $webpPath = $this->getWebPPath($path);
        return Storage::disk('public')->exists($webpPath);
    }

    /**
     * Check if thumbnail version exists
     *
     * @param string $path
     * @return bool
     */
    public function hasThumbnail(string $path): bool
    {
        $thumbnailPath = $this->getThumbnailPath($path);
        return Storage::disk('public')->exists($thumbnailPath);
    }
}
