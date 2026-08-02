<?php

namespace YourReselling\ContainerRegistry;

use YourReselling\Client;

/**
 * Container registries: repositories, tags and robot accounts.
 */
class ContainerRegistry
{
    private Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * List container registries
     */
    public function getAll(): array
    {
        return $this->client->get('products/container-registry');
    }

    /**
     * Create a container registry
     */
    public function create(array $params = []): array
    {
        return $this->client->post('products/container-registry/create', $params);
    }

    /**
     * Show a container registry
     */
    public function getById(string $registry): array
    {
        return $this->client->get("products/container-registry/{$registry}");
    }

    /**
     * List artifacts of a repository
     */
    public function getArtifacts(string $registry): array
    {
        return $this->client->get("products/container-registry/{$registry}/artifacts");
    }

    /**
     * Delete a container registry
     */
    public function delete(string $registry, array $params = []): array
    {
        return $this->client->post("products/container-registry/{$registry}/delete", $params);
    }

    /**
     * List repositories
     */
    public function getRepositories(string $registry): array
    {
        return $this->client->get("products/container-registry/{$registry}/repositories");
    }

    /**
     * Set keep-last-N retention
     */
    public function retention(string $registry, array $params = []): array
    {
        return $this->client->post("products/container-registry/{$registry}/retention", $params);
    }

    /**
     * List robot accounts
     */
    public function getRobots(string $registry): array
    {
        return $this->client->get("products/container-registry/{$registry}/robots");
    }

    /**
     * Create a robot account
     */
    public function createRobot(string $registry, array $params = []): array
    {
        return $this->client->post("products/container-registry/{$registry}/robots", $params);
    }

    /**
     * Delete a robot account
     */
    public function deleteRobot(string $registry, string $robot, array $params = []): array
    {
        return $this->client->delete("products/container-registry/{$registry}/robots/{$robot}", $params);
    }

    /**
     * Trigger a vulnerability scan
     */
    public function scan(string $registry, array $params = []): array
    {
        return $this->client->post("products/container-registry/{$registry}/scan", $params);
    }

    /**
     * List webhooks
     */
    public function getWebhooks(string $registry): array
    {
        return $this->client->get("products/container-registry/{$registry}/webhooks");
    }

    /**
     * Create a webhook
     */
    public function createWebhook(string $registry, array $params = []): array
    {
        return $this->client->post("products/container-registry/{$registry}/webhooks", $params);
    }

    /**
     * Delete a webhook
     */
    public function deleteWebhook(string $registry, string $webhookid, array $params = []): array
    {
        return $this->client->delete("products/container-registry/{$registry}/webhooks/{$webhookid}", $params);
    }
}
