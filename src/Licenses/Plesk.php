<?php

namespace YourReselling\Licenses;

use GuzzleHttp\Exception\GuzzleException;
use YourReselling\Client;

class Plesk
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
        return $this->client->get('products/licenses/plesk');
    }

    /**
     * @param int $id
     * @return mixed|string
     * @throws GuzzleException
     */
    public function getById(int $id)
    {
        return $this->client->get("products/licenses/plesk/$id");
    }

    /**
     * @return mixed|string
     * @throws GuzzleException
     */
    public function getPriceList()
    {
        return $this->client->get("products/licenses/plesk/pricelist");
    }

    /**
     * @param int $licenseId Plesk License ID
     * @return mixed|string
     * @throws GuzzleException
     */
    public function orderLicense(int $licenseId)
    {
        return $this->client->post("products/licenses/plesk/create", [
            'license_id' => $licenseId
        ]);
    }

    /**
     * @param int $id
     * @return mixed|string
     * @throws GuzzleException
     */
    public function getIpBinding(int $id)
    {
        return $this->client->get("products/licenses/plesk/$id/binding");
    }

    /**
     * @param int $id
     * @param string $ip_address
     * @return mixed|string
     * @throws GuzzleException
     */
    public function updateIpBinding(int $id, string $ip_address)
    {
        return $this->client->post("products/licenses/plesk/$id/binding/set", [
            'ip_address' => $ip_address
        ]);
    }

    /**
     * @param int $id
     * @return mixed|string
     * @throws GuzzleException
     */
    public function setDeleteRequest(int $id)
    {
        return $this->client->delete("products/licenses/plesk/$id/delete");
    }

    /**
     * @param int $id
     * @return mixed|string
     * @throws GuzzleException
     */
    public function unSetDeleteRequest(int $id)
    {
        return $this->client->delete("products/licenses/plesk/$id/undelete");
    }
}