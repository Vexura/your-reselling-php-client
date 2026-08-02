<?php

namespace YourReselling\Ipv6;

use YourReselling\Client;

/**
 * IPv6 assignments: allocations, ASNs, routing and LOAs.
 */
class Ipv6
{
    private Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * List IPv6 subnets
     */
    public function getAll(array $query = []): array
    {
        return $this->client->get('products/ipv6', $query);
    }

    /**
     * Order IPv6 subnet
     */
    public function order(array $params): array
    {
        return $this->client->post('products/ipv6/order', $params);
    }

    /**
     * List available IPv6 pools
     */
    public function getPools(): array
    {
        return $this->client->get('products/ipv6/pools');
    }

    /**
     * Show IPv6 subnet details
     */
    public function getById(string $assignment): array
    {
        return $this->client->get("products/ipv6/{$assignment}");
    }

    /**
     * Create sub-allocation
     */
    public function createAllocation(string $assignment, array $params): array
    {
        return $this->client->post("products/ipv6/{$assignment}/allocations", $params);
    }

    /**
     * Delete sub-allocation
     */
    public function deleteAllocation(string $assignment, string $allocation, array $params = []): array
    {
        return $this->client->delete("products/ipv6/{$assignment}/allocations/{$allocation}", $params);
    }

    /**
     * List subnet ASNs
     */
    public function getAsns(string $assignment): array
    {
        return $this->client->get("products/ipv6/{$assignment}/asns");
    }

    /**
     * Add ASN to subnet
     */
    public function createAsn(string $assignment, array $params): array
    {
        return $this->client->post("products/ipv6/{$assignment}/asns", $params);
    }

    /**
     * Remove ASN from subnet
     */
    public function deleteAsn(string $assignment, string $asnEntry, array $params = []): array
    {
        return $this->client->delete("products/ipv6/{$assignment}/asns/{$asnEntry}", $params);
    }

    /**
     * Generate ASN LOA
     */
    public function asnsLoaGenerate(string $assignment, string $asnEntry, array $params = []): array
    {
        return $this->client->post("products/ipv6/{$assignment}/asns/{$asnEntry}/loa/generate", $params);
    }

    /**
     * Revoke ASN LOA
     */
    public function asnsLoaRevoke(string $assignment, string $asnEntry, array $params = []): array
    {
        return $this->client->post("products/ipv6/{$assignment}/asns/{$asnEntry}/loa/revoke", $params);
    }

    /**
     * Disable ASN routing
     */
    public function asnsRoutingDisable(string $assignment, string $asnEntry, array $params = []): array
    {
        return $this->client->post("products/ipv6/{$assignment}/asns/{$asnEntry}/routing/disable", $params);
    }

    /**
     * Enable ASN routing
     */
    public function asnsRoutingEnable(string $assignment, string $asnEntry, array $params = []): array
    {
        return $this->client->post("products/ipv6/{$assignment}/asns/{$asnEntry}/routing/enable", $params);
    }

    /**
     * Update geofeed
     */
    public function updateGeofeed(string $assignment, array $params): array
    {
        return $this->client->patch("products/ipv6/{$assignment}/geofeed", $params);
    }

    /**
     * Update subnet label
     */
    public function updateLabel(string $assignment, array $params): array
    {
        return $this->client->patch("products/ipv6/{$assignment}/label", $params);
    }

    /**
     * Generate LOA
     */
    public function loaGenerate(string $assignment, array $params = []): array
    {
        return $this->client->post("products/ipv6/{$assignment}/loa/generate", $params);
    }

    /**
     * Revoke LOA
     */
    public function loaRevoke(string $assignment, array $params = []): array
    {
        return $this->client->post("products/ipv6/{$assignment}/loa/revoke", $params);
    }

    /**
     * Update rDNS delegation
     */
    public function updateRdns(string $assignment, array $params): array
    {
        return $this->client->patch("products/ipv6/{$assignment}/rdns", $params);
    }

    /**
     * Disable subnet routing
     */
    public function routingDisable(string $assignment, array $params = []): array
    {
        return $this->client->post("products/ipv6/{$assignment}/routing/disable", $params);
    }

    /**
     * Enable subnet routing
     */
    public function routingEnable(string $assignment, array $params = []): array
    {
        return $this->client->post("products/ipv6/{$assignment}/routing/enable", $params);
    }

    /**
     * Terminate subnet
     */
    public function terminate(string $assignment, array $params = []): array
    {
        return $this->client->post("products/ipv6/{$assignment}/terminate", $params);
    }
}
