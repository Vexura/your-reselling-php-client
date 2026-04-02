<?php

namespace YourReselling\VPN;

use YourReselling\Client;

class VPN
{
    private Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    // --- Info ---

    public function prices(): array
    {
        return $this->client->get('products/vpn/prices');
    }

    public function servers(): array
    {
        return $this->client->get('products/vpn/servers');
    }

    public function dnsOptions(): array
    {
        return $this->client->get('products/vpn/dns-options');
    }

    // --- Accounts ---

    public function getAll(): array
    {
        return $this->client->get('products/vpn/accounts');
    }

    public function getById(string $id): array
    {
        return $this->client->get("products/vpn/accounts/{$id}");
    }

    public function create(array $params): array
    {
        return $this->client->post('products/vpn/accounts', $params);
    }

    public function update(string $id, array $params): array
    {
        return $this->client->patch("products/vpn/accounts/{$id}", $params);
    }

    public function delete(string $id): array
    {
        return $this->client->delete("products/vpn/accounts/{$id}");
    }

    public function suspend(string $id): array
    {
        return $this->client->post("products/vpn/accounts/{$id}/suspend");
    }

    public function unsuspend(string $id): array
    {
        return $this->client->post("products/vpn/accounts/{$id}/unsuspend");
    }

    public function terminate(string $id): array
    {
        return $this->client->post("products/vpn/accounts/{$id}/terminate");
    }
}
