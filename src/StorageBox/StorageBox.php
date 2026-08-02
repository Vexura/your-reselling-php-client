<?php

namespace YourReselling\StorageBox;

use YourReselling\Client;

/**
 * Storage boxes: sub-accounts, snapshots and access settings.
 */
class StorageBox
{
    private Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * List StorageBox datastores
     */
    public function getAll(array $query = []): array
    {
        return $this->client->get('products/storagebox', $query);
    }

    /**
     * List StorageBox locations
     */
    public function getLocations(): array
    {
        return $this->client->get('products/storagebox/locations');
    }

    /**
     * Order StorageBox datastore
     */
    public function order(array $params): array
    {
        return $this->client->post('products/storagebox/order', $params);
    }

    /**
     * Get StorageBox datastore details
     */
    public function getById(string $datastore): array
    {
        return $this->client->get("products/storagebox/{$datastore}");
    }

    /**
     * Update StorageBox (friendly, size, speed, autoscaling)
     */
    public function update(string $datastore, array $params): array
    {
        return $this->client->patch("products/storagebox/{$datastore}", $params);
    }

    /**
     * List ACL entries
     */
    public function getAcl(string $datastore): array
    {
        return $this->client->get("products/storagebox/{$datastore}/acl");
    }

    /**
     * Add ACL entry (IP/CIDR)
     */
    public function acl(string $datastore, array $params): array
    {
        return $this->client->post("products/storagebox/{$datastore}/acl", $params);
    }

    /**
     * Delete ACL entry
     */
    public function deleteAcl(string $datastore, string $aclid, array $params = []): array
    {
        return $this->client->delete("products/storagebox/{$datastore}/acl/{$aclid}", $params);
    }

    /**
     * Get PBS backup snapshots overview
     */
    public function getBackupsOverview(string $datastore, array $query = []): array
    {
        return $this->client->get("products/storagebox/{$datastore}/backups-overview", $query);
    }

    /**
     * Delete StorageBox datastore
     */
    public function delete(string $datastore, array $params = []): array
    {
        return $this->client->delete("products/storagebox/{$datastore}/delete", $params);
    }

    /**
     * List recent webhook events
     */
    public function getEvents(string $datastore, array $query = []): array
    {
        return $this->client->get("products/storagebox/{$datastore}/events", $query);
    }

    /**
     * Get usage & I/O graph data
     */
    public function getGraph(string $datastore, array $query = []): array
    {
        return $this->client->get("products/storagebox/{$datastore}/graph", $query);
    }

    /**
     * Get immutable backup config
     */
    public function getImmutableBackups(string $datastore): array
    {
        return $this->client->get("products/storagebox/{$datastore}/immutable-backups");
    }

    /**
     * Enable immutable backups
     */
    public function createImmutableBackup(string $datastore, array $params): array
    {
        return $this->client->post("products/storagebox/{$datastore}/immutable-backups", $params);
    }

    /**
     * Request immutable backups disable (starts grace period)
     */
    public function deleteImmutableBackups(string $datastore, array $params = []): array
    {
        return $this->client->delete("products/storagebox/{$datastore}/immutable-backups", $params);
    }

    /**
     * Cancel pending immutable backups disable
     */
    public function immutableBackupsCancelDisable(string $datastore, array $params = []): array
    {
        return $this->client->post("products/storagebox/{$datastore}/immutable-backups/cancel-disable", $params);
    }

    /**
     * List namespaces
     */
    public function getNamespaces(string $datastore): array
    {
        return $this->client->get("products/storagebox/{$datastore}/namespaces");
    }

    /**
     * Create namespace
     */
    public function createNamespace(string $datastore, array $params): array
    {
        return $this->client->post("products/storagebox/{$datastore}/namespaces", $params);
    }

    /**
     * Delete namespace
     */
    public function deleteNamespaces(string $datastore, array $params): array
    {
        return $this->client->delete("products/storagebox/{$datastore}/namespaces", $params);
    }

    /**
     * Get optimal backup time slots
     */
    public function getOptimalTime(string $datastore): array
    {
        return $this->client->get("products/storagebox/{$datastore}/optimal-time");
    }

    /**
     * Update prune / retention schedule
     */
    public function updatePrune(string $datastore, array $params): array
    {
        return $this->client->put("products/storagebox/{$datastore}/prune", $params);
    }

    /**
     * Get geo-replication status
     */
    public function getReplication(string $datastore): array
    {
        return $this->client->get("products/storagebox/{$datastore}/replication");
    }

    /**
     * Configure geo-replication
     */
    public function replication(string $datastore, array $params): array
    {
        return $this->client->post("products/storagebox/{$datastore}/replication", $params);
    }

    /**
     * Disable geo-replication
     */
    public function deleteReplication(string $datastore, array $params = []): array
    {
        return $this->client->delete("products/storagebox/{$datastore}/replication", $params);
    }

    /**
     * Preview replication server placement
     */
    public function replicationPreview(string $datastore, array $params): array
    {
        return $this->client->post("products/storagebox/{$datastore}/replication/preview", $params);
    }

    /**
     * Get rescale history
     */
    public function getRescaleLog(string $datastore): array
    {
        return $this->client->get("products/storagebox/{$datastore}/rescale-log");
    }

    /**
     * Rotate PBS / SSH credentials
     */
    public function createRotateCredential(string $datastore, array $params = []): array
    {
        return $this->client->post("products/storagebox/{$datastore}/rotate-credentials", $params);
    }

    /**
     * List SFTP directory
     */
    public function getSftp(string $datastore, array $query = []): array
    {
        return $this->client->get("products/storagebox/{$datastore}/sftp", $query);
    }

    /**
     * Delete file/directory via SFTP
     */
    public function deleteSftp(string $datastore, array $params): array
    {
        return $this->client->delete("products/storagebox/{$datastore}/sftp", $params);
    }

    /**
     * Download file via SFTP
     */
    public function getSftpDownload(string $datastore, array $query = []): array
    {
        return $this->client->get("products/storagebox/{$datastore}/sftp/download", $query);
    }

    /**
     * Create directory via SFTP
     */
    public function sftpMkdir(string $datastore, array $params): array
    {
        return $this->client->post("products/storagebox/{$datastore}/sftp/mkdir", $params);
    }

    /**
     * Upload file via SFTP
     */
    public function sftpUpload(string $datastore, array $params): array
    {
        return $this->client->post("products/storagebox/{$datastore}/sftp/upload", $params);
    }

    /**
     * Add SSH public keys
     */
    public function createSshKey(string $datastore, array $params): array
    {
        return $this->client->post("products/storagebox/{$datastore}/ssh-keys", $params);
    }
}
