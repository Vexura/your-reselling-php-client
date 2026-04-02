<?php

namespace YourReselling\TeamSpeak;

use YourReselling\Client;

class TeamSpeak
{
    private Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    // --- Info ---

    public function prices(): array
    {
        return $this->client->get('products/teamspeak/prices');
    }

    // --- Instances ---

    public function getInstances(): array
    {
        return $this->client->get('products/teamspeak/instances');
    }

    public function getInstance(string $id): array
    {
        return $this->client->get("products/teamspeak/instances/{$id}");
    }

    public function createInstance(array $params): array
    {
        return $this->client->post('products/teamspeak/instances/create', $params);
    }

    public function startInstance(string $id): array
    {
        return $this->client->post("products/teamspeak/instances/{$id}/start");
    }

    public function stopInstance(string $id): array
    {
        return $this->client->post("products/teamspeak/instances/{$id}/stop");
    }

    public function terminateInstance(string $id): array
    {
        return $this->client->post("products/teamspeak/instances/{$id}/terminate");
    }

    public function resetInstancePassword(string $id): array
    {
        return $this->client->post("products/teamspeak/instances/{$id}/reset-password");
    }

    public function getInstanceStatistics(string $id): array
    {
        return $this->client->get("products/teamspeak/instances/{$id}/statistics");
    }

    public function getInstanceWhitelist(string $id): array
    {
        return $this->client->get("products/teamspeak/instances/{$id}/whitelist");
    }

    public function addToWhitelist(string $id, array $params): array
    {
        return $this->client->post("products/teamspeak/instances/{$id}/whitelist/add", $params);
    }

    public function removeFromWhitelist(string $id, array $params): array
    {
        return $this->client->post("products/teamspeak/instances/{$id}/whitelist/remove", $params);
    }

    // --- Servers ---

    public function getServers(): array
    {
        return $this->client->get('products/teamspeak/servers');
    }

    public function getServer(string $id): array
    {
        return $this->client->get("products/teamspeak/servers/{$id}");
    }

    public function createServer(array $params): array
    {
        return $this->client->post('products/teamspeak/servers/create', $params);
    }

    public function deleteServer(string $id): array
    {
        return $this->client->post("products/teamspeak/servers/{$id}/delete");
    }

    public function startServer(string $id): array
    {
        return $this->client->post("products/teamspeak/servers/{$id}/start");
    }

    public function stopServer(string $id): array
    {
        return $this->client->post("products/teamspeak/servers/{$id}/stop");
    }

    public function updateSettings(string $id, array $params): array
    {
        return $this->client->patch("products/teamspeak/servers/{$id}/settings", $params);
    }

    public function upgradeServer(string $id, array $params): array
    {
        return $this->client->patch("products/teamspeak/servers/{$id}/upgrade", $params);
    }

    public function getServerStats(string $id): array
    {
        return $this->client->get("products/teamspeak/servers/{$id}/stats");
    }

    public function getServerStatsHistory(string $id): array
    {
        return $this->client->get("products/teamspeak/servers/{$id}/stats/history");
    }

    // --- TSDNS ---

    public function updateTsdns(string $id, array $params): array
    {
        return $this->client->patch("products/teamspeak/servers/{$id}/tsdns", $params);
    }

    public function removeTsdns(string $id): array
    {
        return $this->client->post("products/teamspeak/servers/{$id}/tsdns/remove");
    }

    // --- Channels ---

    public function getChannels(string $serverId): array
    {
        return $this->client->get("products/teamspeak/servers/{$serverId}/channels");
    }

    public function getChannel(string $serverId, string $channelId): array
    {
        return $this->client->get("products/teamspeak/servers/{$serverId}/channels/{$channelId}");
    }

    public function createChannel(string $serverId, array $params): array
    {
        return $this->client->post("products/teamspeak/servers/{$serverId}/channels/create", $params);
    }

    public function updateChannel(string $serverId, string $channelId, array $params): array
    {
        return $this->client->patch("products/teamspeak/servers/{$serverId}/channels/{$channelId}", $params);
    }

    public function deleteChannel(string $serverId, string $channelId): array
    {
        return $this->client->post("products/teamspeak/servers/{$serverId}/channels/{$channelId}/delete");
    }

    // --- Clients ---

    public function getClients(string $serverId): array
    {
        return $this->client->get("products/teamspeak/servers/{$serverId}/clients");
    }

    public function kickClient(string $serverId, array $params): array
    {
        return $this->client->post("products/teamspeak/servers/{$serverId}/clients/kick", $params);
    }

    public function moveClient(string $serverId, array $params): array
    {
        return $this->client->post("products/teamspeak/servers/{$serverId}/clients/move", $params);
    }

    public function pokeClient(string $serverId, array $params): array
    {
        return $this->client->post("products/teamspeak/servers/{$serverId}/clients/poke", $params);
    }

    // --- Bans ---

    public function getBans(string $serverId): array
    {
        return $this->client->get("products/teamspeak/servers/{$serverId}/bans");
    }

    public function createBan(string $serverId, array $params): array
    {
        return $this->client->post("products/teamspeak/servers/{$serverId}/bans/create", $params);
    }

    public function deleteBan(string $serverId, string $banId): array
    {
        return $this->client->post("products/teamspeak/servers/{$serverId}/bans/{$banId}/delete");
    }

    public function clearBans(string $serverId): array
    {
        return $this->client->post("products/teamspeak/servers/{$serverId}/bans/clear");
    }

    // --- Tokens ---

    public function getTokens(string $serverId): array
    {
        return $this->client->get("products/teamspeak/servers/{$serverId}/tokens");
    }

    public function createToken(string $serverId, array $params): array
    {
        return $this->client->post("products/teamspeak/servers/{$serverId}/tokens/create", $params);
    }

    public function deleteToken(string $serverId, array $params): array
    {
        return $this->client->post("products/teamspeak/servers/{$serverId}/tokens/delete", $params);
    }

    // --- Complaints ---

    public function getComplaints(string $serverId): array
    {
        return $this->client->get("products/teamspeak/servers/{$serverId}/complaints");
    }

    public function deleteComplaint(string $serverId, string $tcldbid, string $fcldbid): array
    {
        return $this->client->post("products/teamspeak/servers/{$serverId}/complaints/{$tcldbid}/{$fcldbid}/delete");
    }

    public function deleteAllComplaints(string $serverId, string $tcldbid): array
    {
        return $this->client->post("products/teamspeak/servers/{$serverId}/complaints/{$tcldbid}/delete-all");
    }
}
