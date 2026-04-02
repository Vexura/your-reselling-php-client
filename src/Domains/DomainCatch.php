<?php

namespace YourReselling\Domains;

use YourReselling\Client;

class DomainCatch
{
    private Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function getAll(array $params = []): array
    {
        return $this->client->get('products/domains/catch', $params);
    }

    public function getById(string $id): array
    {
        return $this->client->get("products/domains/catch/{$id}");
    }

    public function create(string $domain, string $handleId): array
    {
        return $this->client->post('products/domains/catch/create', [
            'domain' => $domain,
            'handle_id' => $handleId,
        ]);
    }

    public function cancel(string $id): array
    {
        return $this->client->post("products/domains/catch/{$id}/cancel");
    }
}
