<?php

namespace YourReselling\Announcements;

use YourReselling\Client;

class Announcements
{
    private Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function getAll(array $filters = []): array
    {
        return $this->client->get('announcements', $filters);
    }

    public function getById(string $id): array
    {
        return $this->client->get("announcements/{$id}");
    }
}
