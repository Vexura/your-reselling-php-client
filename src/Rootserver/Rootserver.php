<?php

namespace YourReselling\Rootserver;

use YourReselling\Client;

class Rootserver
{
    private Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function locations(): array
    {
        return $this->client->get('products/rootserver/locations');
    }

    public function getLocation(string $id): array
    {
        return $this->client->get("products/rootserver/locations/{$id}");
    }

    public function osList(): array
    {
        return $this->client->get('products/rootserver/os-list');
    }

    public function pricing(string $cluster): array
    {
        return $this->client->get("products/rootserver/cluster/{$cluster}/pricing");
    }

    public function calculatePrice(string $cluster, array $params): array
    {
        return $this->client->post("products/rootserver/cluster/{$cluster}/calculator", $params);
    }

    public function firewallPresets(): array
    {
        return $this->client->get('products/rootserver/firewall-presets');
    }

    public function getAll(): array
    {
        return $this->client->get('products/rootserver');
    }

    public function getById(string $id): array
    {
        return $this->client->get("products/rootserver/{$id}");
    }

    public function create(string $cluster, array $params): array
    {
        return $this->client->post("products/rootserver/cluster/{$cluster}/create", $params);
    }

    public function delete(string $id): array
    {
        return $this->client->post("products/rootserver/{$id}/delete");
    }

    public function start(string $id): array
    {
        return $this->client->post("products/rootserver/{$id}/start");
    }

    public function stop(string $id): array
    {
        return $this->client->post("products/rootserver/{$id}/stop");
    }

    public function restart(string $id): array
    {
        return $this->client->post("products/rootserver/{$id}/restart");
    }

    public function kill(string $id): array
    {
        return $this->client->post("products/rootserver/{$id}/kill");
    }

    public function reinstall(string $id, array $params): array
    {
        return $this->client->post("products/rootserver/{$id}/reinstall", $params);
    }

    public function resetRootPassword(string $id, array $params = []): array
    {
        return $this->client->post("products/rootserver/{$id}/reset-root-password", $params);
    }

    public function resize(string $id, array $params): array
    {
        return $this->client->post("products/rootserver/{$id}/resize", $params);
    }

    public function liveStats(string $id): array
    {
        return $this->client->get("products/rootserver/{$id}/live-stats");
    }

    public function historicalStats(string $id): array
    {
        return $this->client->get("products/rootserver/{$id}/historical-stats");
    }

    public function vnc(string $id): array
    {
        return $this->client->get("products/rootserver/{$id}/vnc");
    }

    public function getAllTasks(): array
    {
        return $this->client->get('products/rootserver/tasks');
    }

    public function getTask(string $taskId): array
    {
        return $this->client->get("products/rootserver/tasks/{$taskId}");
    }

    public function cancelTask(string $taskId): array
    {
        return $this->client->post("products/rootserver/tasks/{$taskId}/cancel");
    }

    public function getServerTasks(string $id): array
    {
        return $this->client->get("products/rootserver/{$id}/tasks");
    }

    public function getServerTask(string $id, string $taskId): array
    {
        return $this->client->get("products/rootserver/{$id}/tasks/{$taskId}");
    }

    public function getRdns(string $id): array
    {
        return $this->client->get("products/rootserver/{$id}/rdns");
    }

    public function updateRdns(string $id, array $params): array
    {
        return $this->client->post("products/rootserver/{$id}/rdns/update", $params);
    }

    public function getFirewallRules(string $id): array
    {
        return $this->client->get("products/rootserver/{$id}/firewall/rules");
    }

    public function createFirewallRule(string $id, array $params): array
    {
        return $this->client->post("products/rootserver/{$id}/firewall/rules/create", $params);
    }

    public function updateFirewallRule(string $id, string $ruleId, array $params): array
    {
        return $this->client->post("products/rootserver/{$id}/firewall/rules/{$ruleId}/update", $params);
    }

    public function deleteFirewallRule(string $id, string $ruleId): array
    {
        return $this->client->post("products/rootserver/{$id}/firewall/rules/{$ruleId}/delete");
    }

    public function reorderFirewallRules(string $id, array $params): array
    {
        return $this->client->post("products/rootserver/{$id}/firewall/rules/reorder", $params);
    }

    public function applyFirewallPreset(string $id, array $params): array
    {
        return $this->client->post("products/rootserver/{$id}/firewall/apply", $params);
    }

    public function getAllVpcs(): array
    {
        return $this->client->get('products/rootserver/vpc');
    }

    public function getVpc(string $vpcId): array
    {
        return $this->client->get("products/rootserver/vpc/{$vpcId}");
    }

    public function createVpc(array $params): array
    {
        return $this->client->post('products/rootserver/vpc/create', $params);
    }

    public function deleteVpc(string $vpcId): array
    {
        return $this->client->post("products/rootserver/vpc/{$vpcId}/delete");
    }

    public function linkToVpc(string $vpcId, array $params): array
    {
        return $this->client->post("products/rootserver/vpc/{$vpcId}/link", $params);
    }

    public function unlinkFromVpc(string $vpcId, array $params): array
    {
        return $this->client->post("products/rootserver/vpc/{$vpcId}/unlink", $params);
    }

    public function getBackups(string $id): array
    {
        return $this->client->get("products/rootserver/{$id}/backups");
    }

    public function getBackup(string $id, string $backupId): array
    {
        return $this->client->get("products/rootserver/{$id}/backups/{$backupId}");
    }

    public function createBackup(string $id): array
    {
        return $this->client->post("products/rootserver/{$id}/backups/create");
    }

    public function restoreBackup(string $id, string $backupId): array
    {
        return $this->client->post("products/rootserver/{$id}/backups/{$backupId}/restore");
    }

    public function deleteBackup(string $id, string $backupId): array
    {
        return $this->client->post("products/rootserver/{$id}/backups/{$backupId}/delete");
    }

    public function getDdosAlerts(string $id): array
    {
        return $this->client->get("products/rootserver/{$id}/ddos");
    }
}
