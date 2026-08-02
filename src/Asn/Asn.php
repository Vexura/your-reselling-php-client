<?php

namespace YourReselling\Asn;

use YourReselling\Client;

/**
 * ASN objects: ordering, routing and RPKI.
 */
class Asn
{
    private Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * List ASNs
     */
    public function getAll(array $query = []): array
    {
        return $this->client->get('products/asn', $query);
    }

    /**
     * Order ASN
     */
    public function order(array $params): array
    {
        return $this->client->post('products/asn/order', $params);
    }

    /**
     * Get ASN pricing
     */
    public function getPricing(): array
    {
        return $this->client->get('products/asn/pricing');
    }

    /**
     * Show ASN details
     */
    public function getById(string $asn): array
    {
        return $this->client->get("products/asn/{$asn}");
    }

    /**
     * Cancel ASN
     */
    public function cancel(string $asn, array $params = []): array
    {
        return $this->client->post("products/asn/{$asn}/cancel", $params);
    }
}
