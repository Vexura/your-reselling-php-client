<?php

namespace YourReselling\Dedicated;

use YourReselling\Client;

/**
 * Dedicated servers: hardware, IPs, traffic and reinstalls.
 */
class Dedicated
{
    private Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * List dedicated locations
     */
    public function getLocations(): array
    {
        return $this->client->get('products/dedicated/locations');
    }

    /**
     * List dedicated plans
     */
    public function getPlans(array $query = []): array
    {
        return $this->client->get('products/dedicated/plans', $query);
    }

    /**
     * Show dedicated plan
     */
    public function getPlan(string $plan): array
    {
        return $this->client->get("products/dedicated/plans/{$plan}");
    }

    /**
     * List dedicated servers
     */
    public function getServers(array $query = []): array
    {
        return $this->client->get('products/dedicated/servers', $query);
    }

    /**
     * Order a dedicated server
     */
    public function createServer(array $params): array
    {
        return $this->client->post('products/dedicated/servers', $params);
    }

    /**
     * Show dedicated server
     */
    public function getServer(string $server): array
    {
        return $this->client->get("products/dedicated/servers/{$server}");
    }

    /**
     * Cancel a dedicated server
     */
    public function deleteServer(string $server, array $params = []): array
    {
        return $this->client->delete("products/dedicated/servers/{$server}", $params);
    }

    /**
     * Queue an agent command
     */
    public function agentCommand(string $server, array $params = []): array
    {
        return $this->client->post("products/dedicated/servers/{$server}/agent/command", $params);
    }

    /**
     * Get agent install command
     */
    public function getAgentInstall(string $server): array
    {
        return $this->client->get("products/dedicated/servers/{$server}/agent/install");
    }

    /**
     * Get agent command result
     */
    public function getAgentResult(string $server, string $task): array
    {
        return $this->client->get("products/dedicated/servers/{$server}/agent/result/{$task}");
    }

    /**
     * Toggle auto-renew
     */
    public function autoRenew(string $server, array $params): array
    {
        return $this->client->post("products/dedicated/servers/{$server}/auto-renew", $params);
    }

    /**
     * Get KVM/VNC console URL
     */
    public function getConsole(string $server): array
    {
        return $this->client->get("products/dedicated/servers/{$server}/console");
    }

    /**
     * Assign IPs
     */
    public function createIp(string $server, array $params): array
    {
        return $this->client->post("products/dedicated/servers/{$server}/ips", $params);
    }

    /**
     * Remove an IP
     */
    public function deleteIps(string $server, array $params): array
    {
        return $this->client->delete("products/dedicated/servers/{$server}/ips", $params);
    }

    /**
     * List assignable IPs
     */
    public function getIpsAssignable(string $server): array
    {
        return $this->client->get("products/dedicated/servers/{$server}/ips/assignable");
    }

    /**
     * Get live network state
     */
    public function getNetwork(string $server): array
    {
        return $this->client->get("products/dedicated/servers/{$server}/network");
    }

    /**
     * List OS templates
     */
    public function getOsTemplates(string $server): array
    {
        return $this->client->get("products/dedicated/servers/{$server}/os-templates");
    }

    /**
     * Get power status
     */
    public function getPower(string $server): array
    {
        return $this->client->get("products/dedicated/servers/{$server}/power");
    }

    /**
     * Perform power action
     */
    public function power(string $server, string $action, array $params = []): array
    {
        return $this->client->post("products/dedicated/servers/{$server}/power/{$action}", $params);
    }

    /**
     * Get PTR record
     */
    public function getRdns(string $server, array $query = []): array
    {
        return $this->client->get("products/dedicated/servers/{$server}/rdns", $query);
    }

    /**
     * Set PTR record
     */
    public function createRdns(string $server, array $params): array
    {
        return $this->client->post("products/dedicated/servers/{$server}/rdns", $params);
    }

    /**
     * Delete PTR record
     */
    public function deleteRdns(string $server, array $params): array
    {
        return $this->client->delete("products/dedicated/servers/{$server}/rdns", $params);
    }

    /**
     * Start reinstall
     */
    public function reinstall(string $server, array $params): array
    {
        return $this->client->post("products/dedicated/servers/{$server}/reinstall", $params);
    }

    /**
     * Abort reinstall
     */
    public function reinstallAbort(string $server, array $params = []): array
    {
        return $this->client->post("products/dedicated/servers/{$server}/reinstall/abort", $params);
    }

    /**
     * Rename a dedicated server
     */
    public function rename(string $server, array $params): array
    {
        return $this->client->patch("products/dedicated/servers/{$server}/rename", $params);
    }

    /**
     * List SSH keys
     */
    public function getSshKeys(string $server): array
    {
        return $this->client->get("products/dedicated/servers/{$server}/ssh-keys");
    }

    /**
     * Add an SSH key
     */
    public function createSshKey(string $server, array $params): array
    {
        return $this->client->post("products/dedicated/servers/{$server}/ssh-keys", $params);
    }

    /**
     * Delete an SSH key
     */
    public function deleteSshKey(string $server, string $key, array $params = []): array
    {
        return $this->client->delete("products/dedicated/servers/{$server}/ssh-keys/{$key}", $params);
    }

    /**
     * Get server stats
     */
    public function getStats(string $server, array $query = []): array
    {
        return $this->client->get("products/dedicated/servers/{$server}/stats", $query);
    }

    /**
     * List scheduled tasks
     */
    public function getTasks(string $server): array
    {
        return $this->client->get("products/dedicated/servers/{$server}/tasks");
    }

    /**
     * Create a scheduled task
     */
    public function createTask(string $server, array $params): array
    {
        return $this->client->post("products/dedicated/servers/{$server}/tasks", $params);
    }

    /**
     * Delete a scheduled task
     */
    public function deleteTask(string $server, string $task, array $params = []): array
    {
        return $this->client->delete("products/dedicated/servers/{$server}/tasks/{$task}", $params);
    }

    /**
     * Get traffic statistics
     */
    public function getTraffic(string $server, array $query = []): array
    {
        return $this->client->get("products/dedicated/servers/{$server}/traffic", $query);
    }

    /**
     * Get pending updates
     */
    public function getUpdates(string $server): array
    {
        return $this->client->get("products/dedicated/servers/{$server}/updates");
    }

    /**
     * Install updates
     */
    public function updatesInstall(string $server, array $params): array
    {
        return $this->client->post("products/dedicated/servers/{$server}/updates/install", $params);
    }
}
