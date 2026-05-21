<?php

namespace YourReselling\IpTunnels;

use YourReselling\Client;

class IpTunnels
{
    private Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    // --- Info ---

    public function locations(): array
    {
        return $this->client->get('products/ip-tunnels/locations');
    }

    public function locationAvailability(string $locationId): array
    {
        return $this->client->get("products/ip-tunnels/locations/{$locationId}/availability");
    }

    // --- Management ---

    public function getAll(array $filters = []): array
    {
        return $this->client->get('products/ip-tunnels', $filters);
    }

    public function getById(string $id): array
    {
        return $this->client->get("products/ip-tunnels/{$id}");
    }

    public function create(array $params): array
    {
        return $this->client->post('products/ip-tunnels', $params);
    }

    public function update(string $id, array $params): array
    {
        return $this->client->put("products/ip-tunnels/{$id}", $params);
    }

    public function delete(string $id): array
    {
        return $this->client->delete("products/ip-tunnels/{$id}");
    }

    public function suspend(string $id): array
    {
        return $this->client->post("products/ip-tunnels/{$id}/suspend");
    }

    public function unsuspend(string $id): array
    {
        return $this->client->post("products/ip-tunnels/{$id}/unsuspend");
    }

    public function regenerate(string $id): array
    {
        return $this->client->post("products/ip-tunnels/{$id}/regenerate");
    }

    // --- Traffic / Abuse / DDoS ---

    public function getTraffic(string $id, ?string $since = null): array
    {
        $params = $since !== null ? ['since' => $since] : [];
        return $this->client->get("products/ip-tunnels/{$id}/traffic", $params);
    }

    public function getTrafficHistory(string $id, ?string $period = null): array
    {
        $params = $period !== null ? ['period' => $period] : [];
        return $this->client->get("products/ip-tunnels/{$id}/traffic/history", $params);
    }

    public function getAbuseEvents(string $id): array
    {
        return $this->client->get("products/ip-tunnels/{$id}/abuse");
    }

    public function getDdosAlerts(string $id): array
    {
        return $this->client->get("products/ip-tunnels/{$id}/ddos");
    }

    // --- Configuration ---

    public function getConfig(string $id): array
    {
        return $this->client->get("products/ip-tunnels/{$id}/config");
    }

    public function getGuide(string $id): array
    {
        return $this->client->get("products/ip-tunnels/{$id}/guide");
    }

    // --- rDNS ---

    public function setRdns(string $id, string $allocatedIpId, string $rdns): array
    {
        return $this->client->post("products/ip-tunnels/{$id}/rdns", [
            'allocated_ip_id' => $allocatedIpId,
            'rdns' => $rdns,
        ]);
    }

    public function removeRdns(string $id, string $allocatedIpId): array
    {
        return $this->client->delete("products/ip-tunnels/{$id}/rdns/{$allocatedIpId}");
    }
}
