<?php

namespace YourReselling\LoadBalancer;

use YourReselling\Client;

class LoadBalancer
{
    private Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    // --- Info ---

    public function plans(): array
    {
        return $this->client->get('products/loadbalancer/plans');
    }

    // --- Management ---

    public function getAll(): array
    {
        return $this->client->get('products/loadbalancer');
    }

    public function getById(string $id): array
    {
        return $this->client->get("products/loadbalancer/{$id}");
    }

    public function create(array $params): array
    {
        return $this->client->post('products/loadbalancer/create', $params);
    }

    public function update(string $id, array $params): array
    {
        return $this->client->post("products/loadbalancer/{$id}/update", $params);
    }

    public function delete(string $id): array
    {
        return $this->client->post("products/loadbalancer/{$id}/delete");
    }

    public function restore(string $id): array
    {
        return $this->client->post("products/loadbalancer/{$id}/restore");
    }

    public function getStats(string $id): array
    {
        return $this->client->get("products/loadbalancer/{$id}/stats");
    }

    // --- Backends ---

    public function getBackends(string $lbId): array
    {
        return $this->client->get("products/loadbalancer/{$lbId}/backends");
    }

    public function addBackend(string $lbId, array $params): array
    {
        return $this->client->post("products/loadbalancer/{$lbId}/backends/create", $params);
    }

    public function updateBackend(string $lbId, string $backendId, array $params): array
    {
        return $this->client->post("products/loadbalancer/{$lbId}/backends/{$backendId}/update", $params);
    }

    public function removeBackend(string $lbId, string $backendId): array
    {
        return $this->client->post("products/loadbalancer/{$lbId}/backends/{$backendId}/delete");
    }

    // --- Domains ---

    public function getDomains(string $lbId): array
    {
        return $this->client->get("products/loadbalancer/{$lbId}/domains");
    }

    public function addDomain(string $lbId, array $params): array
    {
        return $this->client->post("products/loadbalancer/{$lbId}/domains/create", $params);
    }

    public function removeDomain(string $lbId, string $domainId): array
    {
        return $this->client->post("products/loadbalancer/{$lbId}/domains/{$domainId}/delete");
    }

    public function requestSsl(string $lbId, string $domainId): array
    {
        return $this->client->post("products/loadbalancer/{$lbId}/domains/{$domainId}/request-ssl");
    }

    // --- Rules ---

    public function getRules(string $lbId): array
    {
        return $this->client->get("products/loadbalancer/{$lbId}/rules");
    }

    public function addRule(string $lbId, array $params): array
    {
        return $this->client->post("products/loadbalancer/{$lbId}/rules/create", $params);
    }

    public function removeRule(string $lbId, string $ruleId): array
    {
        return $this->client->post("products/loadbalancer/{$lbId}/rules/{$ruleId}/delete");
    }
}
