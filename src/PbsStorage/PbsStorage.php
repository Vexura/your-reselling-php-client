<?php

namespace YourReselling\PbsStorage;

use YourReselling\Client;

class PbsStorage
{
    private Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function locations(): array
    {
        return $this->client->get('products/pbs-storage/locations');
    }

    public function getAll(array $params = []): array
    {
        return $this->client->get('products/pbs-storage', $params);
    }

    public function getById(string $id): array
    {
        return $this->client->get("products/pbs-storage/{$id}");
    }

    public function order(array $params): array
    {
        return $this->client->post('products/pbs-storage/order', $params);
    }

    public function delete(string $id): array
    {
        return $this->client->delete("products/pbs-storage/{$id}/delete");
    }
}
