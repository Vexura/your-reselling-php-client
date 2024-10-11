<?php

namespace YourReselling\Domains;

use GuzzleHttp\Exception\GuzzleException;
use YourReselling\Client;

class Nameserver
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
        return $this->client->get("products/domain/{$id}/nameserver/get", []);
    }

    /**
     * @throws GuzzleException
     */
    public function update(int $id, array $nameservers)
    {
        return $this->client->post("products/domain/{$id}/nameserver/update", [
            "nameservers" => $nameservers
        ]);
    }
}