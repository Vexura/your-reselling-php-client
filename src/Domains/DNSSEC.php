<?php

namespace YourReselling\Domains;

use YourReselling\Client;

class DNSSEC
{
    private Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function get(string $domainId): array
    {
        return $this->client->get("products/domains/{$domainId}/dnssec");
    }

    public function update(string $domainId, bool $enabled, array $records = []): array
    {
        $params = ['enabled' => $enabled];
        if (!empty($records)) $params['records'] = $records;
        return $this->client->post("products/domains/{$domainId}/dnssec/update", $params);
    }
}
