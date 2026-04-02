<?php

namespace YourReselling\DDoS;

use YourReselling\Client;

class DDoS
{
    private Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function getAlerts(): array
    {
        return $this->client->get('ddos/alerts');
    }

    public function getAlertById(string $id): array
    {
        return $this->client->get("ddos/alerts/{$id}");
    }

    public function getAlertFlows(string $id): array
    {
        return $this->client->get("ddos/alerts/{$id}/flows");
    }
}
