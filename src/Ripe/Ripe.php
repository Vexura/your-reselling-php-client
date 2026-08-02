<?php

namespace YourReselling\Ripe;

use YourReselling\Client;

/**
 * RIPE organisations and their contacts.
 */
class Ripe
{
    private Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * List RIPE organisations
     */
    public function getOrganisations(array $query = []): array
    {
        return $this->client->get('ripe/organisations', $query);
    }

    /**
     * Create RIPE organisation
     */
    public function createOrganisation(array $params): array
    {
        return $this->client->post('ripe/organisations', $params);
    }

    /**
     * Verify external RIPE organisation
     */
    public function organisationsVerify(array $params): array
    {
        return $this->client->post('ripe/organisations/verify', $params);
    }

    /**
     * Show RIPE organisation
     */
    public function getOrganisation(string $organisation): array
    {
        return $this->client->get("ripe/organisations/{$organisation}");
    }

    /**
     * Delete RIPE organisation
     */
    public function deleteOrganisation(string $organisation, array $params = []): array
    {
        return $this->client->delete("ripe/organisations/{$organisation}", $params);
    }

    /**
     * Add contact to organisation
     */
    public function createOrganisationsContact(string $organisation, array $params): array
    {
        return $this->client->post("ripe/organisations/{$organisation}/contacts", $params);
    }

    /**
     * Delete RIPE contact
     */
    public function deleteOrganisationsContact(string $organisation, string $contact, array $params = []): array
    {
        return $this->client->delete("ripe/organisations/{$organisation}/contacts/{$contact}", $params);
    }

    /**
     * Retry failed contact creation
     */
    public function organisationsContactsRetry(string $organisation, string $contact, array $params = []): array
    {
        return $this->client->post("ripe/organisations/{$organisation}/contacts/{$contact}/retry", $params);
    }

    /**
     * Refresh external organisation
     */
    public function organisationsRefresh(string $organisation, array $params = []): array
    {
        return $this->client->post("ripe/organisations/{$organisation}/refresh", $params);
    }

    /**
     * Retry failed organisation creation
     */
    public function organisationsRetry(string $organisation, array $params = []): array
    {
        return $this->client->post("ripe/organisations/{$organisation}/retry", $params);
    }
}
