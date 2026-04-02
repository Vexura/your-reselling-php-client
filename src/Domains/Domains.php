<?php

namespace YourReselling\Domains;

use YourReselling\Client;

class Domains
{
    private Client $client;
    private ?DNS $dnsHandler = null;
    private ?DNSSEC $dnssecHandler = null;
    private ?Nameserver $nameserverHandler = null;
    private ?Handle $handleHandler = null;
    private ?DomainCatch $catchHandler = null;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    // --- Lookup ---

    public function check(string $domain): array
    {
        return $this->client->get('products/domains/check', ['domain' => $domain]);
    }

    public function checkBulk(array $domains): array
    {
        return $this->client->post('products/domains/check-bulk', ['domains' => $domains]);
    }

    public function suggestions(string $name, int $limit = 10): array
    {
        return $this->client->get('products/domains/suggestions', ['name' => $name, 'limit' => $limit]);
    }

    // --- Info ---

    public function pricing(?string $tld = null, ?bool $featured = null): array
    {
        $params = [];
        if ($tld !== null) $params['tld'] = $tld;
        if ($featured !== null) $params['featured'] = $featured;
        return $this->client->get('products/domains/pricing', $params);
    }

    public function statistics(): array
    {
        return $this->client->get('products/domains/statistics');
    }

    // --- Management ---

    public function getAll(array $filters = []): array
    {
        return $this->client->get('products/domains', $filters);
    }

    public function getById(string $id): array
    {
        return $this->client->get("products/domains/{$id}");
    }

    public function create(array $params): array
    {
        return $this->client->post('products/domains/create', $params);
    }

    public function transfer(array $params): array
    {
        return $this->client->post('products/domains/transfer', $params);
    }

    public function generateAuthCode(string $id): array
    {
        return $this->client->post("products/domains/{$id}/auth-code");
    }

    public function enableAutoRenew(string $id): array
    {
        return $this->client->post("products/domains/{$id}/enableAutoRenew");
    }

    public function disableAutoRenew(string $id): array
    {
        return $this->client->post("products/domains/{$id}/disableAutoRenew");
    }

    // --- Sub-handlers ---

    public function dns(): DNS
    {
        return $this->dnsHandler ??= new DNS($this->client);
    }

    public function dnssec(): DNSSEC
    {
        return $this->dnssecHandler ??= new DNSSEC($this->client);
    }

    public function nameserver(): Nameserver
    {
        return $this->nameserverHandler ??= new Nameserver($this->client);
    }

    public function handle(): Handle
    {
        return $this->handleHandler ??= new Handle($this->client);
    }

    public function catch(): DomainCatch
    {
        return $this->catchHandler ??= new DomainCatch($this->client);
    }
}
