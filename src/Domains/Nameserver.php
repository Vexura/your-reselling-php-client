<?php

namespace YourReselling\Domains;

use YourReselling\Client;

class Nameserver
{
    private Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function get(string $domainId): array
    {
        return $this->client->get("products/domains/{$domainId}/nameservers");
    }

    public function update(string $domainId, array $nameservers): array
    {
        return $this->client->post("products/domains/{$domainId}/nameservers/update", ['nameservers' => $nameservers]);
    }
}
