<?php

namespace YourReselling\StorageBox;

use GuzzleHttp\Exception\GuzzleException;
use YourReselling\Client;

class StorageBox
{
    private Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @return mixed|string
     * @throws GuzzleException
     */
    public function getAll()
    {
        return $this->client->get('products/storage-box/list');
    }

    /**
     * @return mixed|string
     * @throws GuzzleException
     */
    public function getAllLoactions()
    {
        return $this->client->get('products/storage-box/locations');
    }

    /**
     * @param int $id
     * @return mixed|string
     * @throws GuzzleException
     */
    public function getById(int $id)
    {
        return $this->client->get("products/storage-box/$id");
    }

    /**
     * @return mixed|string
     * @throws GuzzleException
     */
    public function getPriceList()
    {
        return $this->client->get("products/storage-box/pricelist");
    }

    /**
     * @param string $location
     * @param string $storage
     * @param string $username
     * @param string $password
     * @return mixed|string
     * @throws GuzzleException
     */
    public function orderStorageBox(string $location, string $storage, string $username, string $password)
    {
        return $this->client->post("products/storage-box/$location/create", [
            'storage' => $storage,
            'username' => $username,
            'password' => $password
        ]);
    }

    /**
     * @param int $id
     * @return mixed|string
     * @throws GuzzleException
     */
    public function getUsage(int $id)
    {
        return $this->client->get("products/storage-box/$id/stats");
    }

    /**
     * @param int $id
     * @param string $password
     * @return mixed|string
     * @throws GuzzleException
     */
    public function changePassword(int $id, string $password)
    {
        return $this->client->get("products/storage-box/$id/change-password", [
            'password' => $password
        ]);
    }

    /**
     * @param int $id
     * @return mixed|string
     * @throws GuzzleException
     */
    public function deleteStorageBox(int $id)
    {
        return $this->client->delete("products/storage-box/$id/delete");
    }
}