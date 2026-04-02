<?php

namespace YourReselling\Plesk;

use YourReselling\Client;

class Plesk
{
    private Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    // --- Info ---

    public function nodes(): array
    {
        return $this->client->get('products/plesk/nodes');
    }

    public function plans(): array
    {
        return $this->client->get('products/plesk/plans');
    }

    // --- Accounts ---

    public function getAccounts(): array
    {
        return $this->client->get('products/plesk/accounts');
    }

    public function getAccount(string $id): array
    {
        return $this->client->get("products/plesk/accounts/{$id}");
    }

    public function createAccount(array $params): array
    {
        return $this->client->post('products/plesk/accounts/create', $params);
    }

    public function changePlan(string $id, array $params): array
    {
        return $this->client->post("products/plesk/accounts/{$id}/change-plan", $params);
    }

    public function cancelAccount(string $id): array
    {
        return $this->client->post("products/plesk/accounts/{$id}/cancel");
    }

    public function revokeCancellation(string $id): array
    {
        return $this->client->post("products/plesk/accounts/{$id}/revoke-cancel");
    }

    public function deleteAccount(string $id): array
    {
        return $this->client->post("products/plesk/accounts/{$id}/delete");
    }

    public function suspendAccount(string $id): array
    {
        return $this->client->post("products/plesk/accounts/{$id}/suspend");
    }

    public function unsuspendAccount(string $id): array
    {
        return $this->client->post("products/plesk/accounts/{$id}/unsuspend");
    }

    // --- Webspaces ---

    public function getWebspaces(): array
    {
        return $this->client->get('products/plesk/webspaces');
    }

    public function getWebspace(string $id): array
    {
        return $this->client->get("products/plesk/webspaces/{$id}");
    }

    public function createWebspace(array $params): array
    {
        return $this->client->post('products/plesk/webspaces/create', $params);
    }

    public function deleteWebspace(string $id): array
    {
        return $this->client->post("products/plesk/webspaces/{$id}/delete");
    }

    public function suspendWebspace(string $id): array
    {
        return $this->client->post("products/plesk/webspaces/{$id}/suspend");
    }

    public function unsuspendWebspace(string $id): array
    {
        return $this->client->post("products/plesk/webspaces/{$id}/unsuspend");
    }

    public function getWebspaceStats(string $id): array
    {
        return $this->client->get("products/plesk/webspaces/{$id}/stats");
    }

    public function getWebspaceStatsHistory(string $id): array
    {
        return $this->client->get("products/plesk/webspaces/{$id}/stats/history");
    }
}
