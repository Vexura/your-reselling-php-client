<?php

namespace YourReselling\Domains;

use YourReselling\Client;

class DNS
{
    private Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function get(string $domainId): array
    {
        return $this->client->get("products/domains/{$domainId}/dns");
    }

    public function update(string $domainId, array $records): array
    {
        return $this->client->post("products/domains/{$domainId}/dns/update", ['records' => $records]);
    }
}
