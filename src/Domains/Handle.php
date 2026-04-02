<?php

namespace YourReselling\Domains;

use YourReselling\Client;

class Handle
{
    private Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function getAll(array $params = []): array
    {
        return $this->client->get('products/domains/handles', $params);
    }

    public function getById(string $id): array
    {
        return $this->client->get("products/domains/handles/{$id}");
    }

    public function create(array $params): array
    {
        return $this->client->post('products/domains/handles/create', $params);
    }

    public function update(string $id, array $params): array
    {
        return $this->client->post("products/domains/handles/{$id}/update", $params);
    }

    public function delete(string $id): array
    {
        return $this->client->delete("products/domains/handles/{$id}/delete");
    }

    public function getDomains(string $id): array
    {
        return $this->client->get("products/domains/handles/{$id}/domains");
    }
}
