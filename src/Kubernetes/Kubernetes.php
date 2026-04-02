<?php

namespace YourReselling\Kubernetes;

use YourReselling\Client;

class Kubernetes
{
    private Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    // --- Info ---

    public function locations(): array
    {
        return $this->client->get('products/kubernetes/locations');
    }

    public function plans(): array
    {
        return $this->client->get('products/kubernetes/plans');
    }

    public function versions(): array
    {
        return $this->client->get('products/kubernetes/versions');
    }

    // --- Clusters ---

    public function getAll(): array
    {
        return $this->client->get('products/kubernetes');
    }

    public function getById(string $id): array
    {
        return $this->client->get("products/kubernetes/{$id}");
    }

    public function create(array $params): array
    {
        return $this->client->post('products/kubernetes/create', $params);
    }

    public function update(string $id, array $params): array
    {
        return $this->client->post("products/kubernetes/{$id}/update", $params);
    }

    public function upgrade(string $id, array $params): array
    {
        return $this->client->post("products/kubernetes/{$id}/upgrade", $params);
    }

    public function delete(string $id): array
    {
        return $this->client->post("products/kubernetes/{$id}/delete");
    }

    public function restore(string $id): array
    {
        return $this->client->post("products/kubernetes/{$id}/restore");
    }

    public function getKubeconfig(string $id): array
    {
        return $this->client->get("products/kubernetes/{$id}/kubeconfig");
    }

    // --- Node Pools ---

    public function getNodePools(string $clusterId): array
    {
        return $this->client->get("products/kubernetes/{$clusterId}/node-pools");
    }

    public function createNodePool(string $clusterId, array $params): array
    {
        return $this->client->post("products/kubernetes/{$clusterId}/node-pools/create", $params);
    }

    public function updateNodePool(string $clusterId, string $poolId, array $params): array
    {
        return $this->client->post("products/kubernetes/{$clusterId}/node-pools/{$poolId}/update", $params);
    }

    public function deleteNodePool(string $clusterId, string $poolId): array
    {
        return $this->client->post("products/kubernetes/{$clusterId}/node-pools/{$poolId}/delete");
    }

    public function scaleUpNodePool(string $clusterId, string $poolId, array $params): array
    {
        return $this->client->post("products/kubernetes/{$clusterId}/node-pools/{$poolId}/scale-up", $params);
    }

    public function scaleDownNodePool(string $clusterId, string $poolId, array $params): array
    {
        return $this->client->post("products/kubernetes/{$clusterId}/node-pools/{$poolId}/scale-down", $params);
    }

    // --- Nodes ---

    public function cordonNode(string $clusterId, string $nodeId): array
    {
        return $this->client->post("products/kubernetes/{$clusterId}/nodes/{$nodeId}/cordon");
    }

    public function uncordonNode(string $clusterId, string $nodeId): array
    {
        return $this->client->post("products/kubernetes/{$clusterId}/nodes/{$nodeId}/uncordon");
    }

    public function drainNode(string $clusterId, string $nodeId): array
    {
        return $this->client->post("products/kubernetes/{$clusterId}/nodes/{$nodeId}/drain");
    }

    // --- Firewall ---

    public function getFirewallRules(string $clusterId): array
    {
        return $this->client->get("products/kubernetes/{$clusterId}/firewall/rules");
    }

    public function createFirewallRule(string $clusterId, array $params): array
    {
        return $this->client->post("products/kubernetes/{$clusterId}/firewall/rules/create", $params);
    }

    public function deleteFirewallRule(string $clusterId, string $ruleId): array
    {
        return $this->client->post("products/kubernetes/{$clusterId}/firewall/rules/{$ruleId}/delete");
    }
}
