<?php

namespace YourReselling\Account;

use YourReselling\Client;

class Account
{
    private Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function get(): array
    {
        return $this->client->get('account');
    }

    public function update(array $params): array
    {
        return $this->client->patch('account', $params);
    }
}
