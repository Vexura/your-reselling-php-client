<?php

namespace YourReselling\Billing;

use YourReselling\Client;

class Billing
{
    private Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function getInvoices(): array
    {
        return $this->client->get('billing/invoices');
    }

    public function getInvoiceById(string $id): array
    {
        return $this->client->get("billing/invoices/{$id}");
    }

    public function getUsage(): array
    {
        return $this->client->get('billing/usage');
    }
}
