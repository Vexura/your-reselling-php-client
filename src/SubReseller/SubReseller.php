<?php

namespace YourReselling\SubReseller;

use YourReselling\Client;

class SubReseller
{
    private Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function getAll(): array
    {
        return $this->client->get('sub-resellers');
    }

    public function getById(string $id): array
    {
        return $this->client->get("sub-resellers/{$id}");
    }

    public function create(array $params): array
    {
        return $this->client->post('sub-resellers', $params);
    }

    public function update(string $id, array $params): array
    {
        return $this->client->patch("sub-resellers/{$id}", $params);
    }

    public function delete(string $id): array
    {
        return $this->client->delete("sub-resellers/{$id}");
    }

    public function suspend(string $id): array
    {
        return $this->client->post("sub-resellers/{$id}/suspend");
    }

    public function unsuspend(string $id): array
    {
        return $this->client->post("sub-resellers/{$id}/unsuspend");
    }

    public function getPricing(string $id): array
    {
        return $this->client->get("sub-resellers/{$id}/pricing");
    }

    public function updatePricing(string $id, array $params): array
    {
        return $this->client->put("sub-resellers/{$id}/pricing", $params);
    }
}
