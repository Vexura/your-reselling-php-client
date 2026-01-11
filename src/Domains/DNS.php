<?php

namespace YourReselling\Domains;

use GuzzleHttp\Exception\GuzzleException;
use YourReselling\Client;

class DNS
{
    private Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @throws GuzzleException
     */
    public function get(int $id)
    {
        return $this->client->get("products/domains/{$id}/dns/get", []);
    }

    /**
     * @throws GuzzleException
     */
    public function update(int $id, array $records)
    {
        return $this->client->post("products/domains/{$id}/dns/update", [
            "records" => $records
        ]);
    }
}