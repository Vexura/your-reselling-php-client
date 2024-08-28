<?php

namespace YourReselling\Accounting;

use GuzzleHttp\Exception\GuzzleException;
use YourReselling\Client;

class Accounting
{
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @throws GuzzleException
     */
    public function getUserInformation()
    {
        return $this->client->get('accounting/user-data');
    }

    /**
     * @throws GuzzleException
     */
    public function getAccountUsage()
    {
        return $this->client->get('accounting/usage');
    }

    /**
     * @return mixed|string
     * @throws GuzzleException
     */
    public function getInvoices()
    {
        return $this->client->get('accounting/invoices');
    }

    /**
     * @param string $id
     * @return mixed|string
     * @throws GuzzleException
     */
    public function getInvoiceById(string $id)
    {
        return $this->client->get('accounting/invoices/' . $id);
    }

    /**
     * @return mixed|string
     * @throws GuzzleException
     */
    public function getSubUsers()
    {
        return $this->client->get('accounting/sub_users');
    }

    /**
     * @param string $id
     * @return mixed|string
     * @throws GuzzleException
     */
    public function getSubUserById(string $id)
    {
        return $this->client->get('accounting/sub_users/' . $id);
    }

    /**
     * @param string $username
     * @param string $email
     * @param string|null $password
     * @param string $firstname
     * @param string $lastname
     * @param string $street
     * @param string $number
     * @param string $zip
     * @param string $city
     * @param string $state
     * @param string $country
     * @param float $credit_limit
     * @return mixed|string
     * @throws GuzzleException
     */
    public function createSubUser(string $username, string $email, string $firstname, string $lastname, string $street, string $number, string $zip, string $city, string $state, string $country, float $credit_limit, string $password = null)
    {
        return $this->client->post('accounting/sub_users/create', [
            "username" => $username,
            "email" => $email,
            "password" => $password,
            "firstname" => $firstname,
            "lastname" => $lastname,
            "street" => $street,
            "number" => $number,
            "zip" => $zip,
            "city" => $city,
            "state" => $state,
            "country" => $country,
            "credit_limit" => $credit_limit
        ]);
    }
}