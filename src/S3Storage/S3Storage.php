<?php

namespace YourReselling\S3Storage;

use YourReselling\Client;

/**
 * S3 storage: buckets, keys and usage.
 */
class S3Storage
{
    private Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * List S3 buckets
     */
    public function getAll(array $query = []): array
    {
        return $this->client->get('products/s3-storage', $query);
    }

    /**
     * Calculate bucket price
     */
    public function calculate(array $params): array
    {
        return $this->client->post('products/s3-storage/calculate', $params);
    }

    /**
     * List S3 Storage locations
     */
    public function getLocations(): array
    {
        return $this->client->get('products/s3-storage/locations');
    }

    /**
     * Create S3 bucket
     */
    public function order(array $params): array
    {
        return $this->client->post('products/s3-storage/order', $params);
    }

    /**
     * Get S3 bucket details
     */
    public function getById(string $bucket): array
    {
        return $this->client->get("products/s3-storage/{$bucket}");
    }

    /**
     * Update S3 bucket settings
     */
    public function update(string $bucket, array $params): array
    {
        return $this->client->patch("products/s3-storage/{$bucket}", $params);
    }

    /**
     * Delete S3 bucket
     */
    public function delete(string $bucket, array $params = []): array
    {
        return $this->client->delete("products/s3-storage/{$bucket}/delete", $params);
    }

    /**
     * List folders in a bucket
     */
    public function getFolders(string $bucket, array $query = []): array
    {
        return $this->client->get("products/s3-storage/{$bucket}/folders", $query);
    }

    /**
     * Get bucket usage metrics
     */
    public function getMetrics(string $bucket, array $query = []): array
    {
        return $this->client->get("products/s3-storage/{$bucket}/metrics", $query);
    }

    /**
     * Get bucket network bandwidth
     */
    public function getNetworkBandwidth(string $bucket, array $query = []): array
    {
        return $this->client->get("products/s3-storage/{$bucket}/network-bandwidth", $query);
    }

    /**
     * List objects in a bucket
     */
    public function getObjects(string $bucket, array $query = []): array
    {
        return $this->client->get("products/s3-storage/{$bucket}/objects", $query);
    }

    /**
     * Get a presigned download URL
     */
    public function getPresign(string $bucket, array $query = []): array
    {
        return $this->client->get("products/s3-storage/{$bucket}/presign", $query);
    }

    /**
     * Resize S3 bucket
     */
    public function updateQuota(string $bucket, array $params): array
    {
        return $this->client->patch("products/s3-storage/{$bucket}/quota", $params);
    }

    /**
     * Rotate S3 bucket credentials
     */
    public function createRotateCredential(string $bucket, array $params = []): array
    {
        return $this->client->post("products/s3-storage/{$bucket}/rotate-credentials", $params);
    }

    /**
     * Get bucket usage
     */
    public function getUsage(string $bucket): array
    {
        return $this->client->get("products/s3-storage/{$bucket}/usage");
    }
}
