<?php

namespace App\Services;

use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\UploadedFile;

class CloudinaryService
{
    /**
     * Upload image ke Cloudinary
     */
    public function uploadImage(UploadedFile $file, string $folder = 'uploads'): array
    {
        try {
            $uploadedFile = Cloudinary::upload($file->getRealPath(), [
                'folder' => $folder,
                'transformation' => [
                    'width' => 1200,
                    'height' => 800,
                    'crop' => 'limit',
                    'quality' => 'auto:good',
                    'fetch_format' => 'auto'
                ]
            ]);

            return [
                'public_id' => $uploadedFile->getPublicId(),
                'secure_url' => $uploadedFile->getSecurePath(),
                'url' => $uploadedFile->getSecurePath(), // Alias for compatibility
            ];
        } catch (\Exception $e) {
            throw new \Exception('Failed to upload image: ' . $e->getMessage());
        }
    }

    /**
     * Upload image dengan thumbnail
     */
    public function uploadWithThumbnail(UploadedFile $file, string $folder = 'uploads'): array
    {
        try {
            // Upload original
            $original = $this->uploadImage($file, $folder);

            // Generate thumbnail URL (Cloudinary auto-generates)
            $thumbnailUrl = cloudinary()->getUrl($original['public_id'], [
                'transformation' => [
                    'width' => 400,
                    'height' => 300,
                    'crop' => 'fill',
                    'quality' => 'auto:good'
                ]
            ]);

            return [
                'public_id' => $original['public_id'],
                'url' => $original['url'],
                'thumbnail_url' => $thumbnailUrl,
            ];
        } catch (\Exception $e) {
            throw new \Exception('Failed to upload with thumbnail: ' . $e->getMessage());
        }
    }

    /**
     * Delete image dari Cloudinary
     */
    public function deleteImage(string $publicId): bool
    {
        try {
            Cloudinary::destroy($publicId);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Get optimized URL with transformations
     */
    public function getOptimizedUrl(string $publicId, array $options = []): string
    {
        $defaultOptions = [
            'quality' => 'auto:good',
            'fetch_format' => 'auto',
        ];

        $options = array_merge($defaultOptions, $options);

        return cloudinary()->getUrl($publicId, ['transformation' => $options]);
    }

    /**
     * Upload video ke Cloudinary
     */
    public function uploadVideo(UploadedFile $file, string $folder = 'videos'): array
    {
        try {
            $uploadedFile = Cloudinary::uploadVideo($file->getRealPath(), [
                'folder' => $folder,
                'resource_type' => 'video',
                'quality' => 'auto:good'
            ]);

            return [
                'public_id' => $uploadedFile->getPublicId(),
                'url' => $uploadedFile->getSecurePath(),
            ];
        } catch (\Exception $e) {
            throw new \Exception('Failed to upload video: ' . $e->getMessage());
        }
    }
}
