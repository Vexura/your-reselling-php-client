<?php

namespace YourReselling\Ssl;

use YourReselling\Client;

/**
 * SSL certificates: order, validate, reissue and download.
 */
class Ssl
{
    private Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * List certificates
     */
    public function getAll(array $query = []): array
    {
        return $this->client->get('products/ssl-certificates', $query);
    }

    /**
     * Generate a CSR
     */
    public function csr(array $params): array
    {
        return $this->client->post('products/ssl-certificates/csr', $params);
    }

    /**
     * Decode a CSR
     */
    public function csrDecode(array $params): array
    {
        return $this->client->post('products/ssl-certificates/csr/decode', $params);
    }

    /**
     * List DCV approver emails
     */
    public function getDcvEmails(array $query = []): array
    {
        return $this->client->get('products/ssl-certificates/dcv-emails', $query);
    }

    /**
     * List download formats
     */
    public function getDownloadFormats(): array
    {
        return $this->client->get('products/ssl-certificates/download-formats');
    }

    /**
     * Order a certificate
     */
    public function order(array $params): array
    {
        return $this->client->post('products/ssl-certificates/order', $params);
    }

    /**
     * List certificate products
     */
    public function getProducts(array $query = []): array
    {
        return $this->client->get('products/ssl-certificates/products', $query);
    }

    /**
     * Get certificate product details
     */
    public function getProduct(string $product): array
    {
        return $this->client->get("products/ssl-certificates/products/{$product}");
    }

    /**
     * Get certificate details
     */
    public function getById(string $certificate): array
    {
        return $this->client->get("products/ssl-certificates/{$certificate}");
    }

    /**
     * Download certificate
     */
    public function getDownload(string $certificate, array $query = []): array
    {
        return $this->client->get("products/ssl-certificates/{$certificate}/download", $query);
    }

    /**
     * Download private key
     */
    public function getPrivateKey(string $certificate): array
    {
        return $this->client->get("products/ssl-certificates/{$certificate}/private-key");
    }

    /**
     * Reissue a certificate
     */
    public function reissue(string $certificate, array $params): array
    {
        return $this->client->post("products/ssl-certificates/{$certificate}/reissue", $params);
    }

    /**
     * Renew a certificate
     */
    public function renew(string $certificate, array $params): array
    {
        return $this->client->post("products/ssl-certificates/{$certificate}/renew", $params);
    }

    /**
     * Revoke a certificate
     */
    public function revoke(string $certificate, array $params): array
    {
        return $this->client->post("products/ssl-certificates/{$certificate}/revoke", $params);
    }
}
