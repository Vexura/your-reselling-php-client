<?php

namespace YourReselling\Domains;

use GuzzleHttp\Exception\GuzzleException;
use YourReselling\Client;

class Contact
{
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @throws GuzzleException
     */
    public function get(int $id)
    {
        return $this->client->get("products/domain/{$id}/handle/get", []);
    }

    /**
     * @throws GuzzleException
     */
    public function update(int $id, string $firstname, string $lastname, string $email, string $phone, string $street, string $number, string $city, string $zip, string $state, string $country, string $company = null)
    {
        return $this->client->post("products/domain/{$id}/handle/update", [
            "firstname" => $firstname,
            "lastname" => $lastname,
            "email" => $email,
            "phone" => $phone,
            "street" => $street,
            "number" => $number,
            "city" => $city,
            "zip" => $zip,
            "state" => $state,
            "country" => $country,
            "company" => $company
        ]);
    }
}