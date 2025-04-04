<?php

namespace YourReselling\Domains;

use GuzzleHttp\Exception\GuzzleException;
use YourReselling\Client;

class Domains
{
    private Client $client;
    private DNS $dnsHandler;
    private Nameserver $nameserverHandler;
    private Contact $contactHandler;

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
        return $this->client->get('products/domain', []);
    }

    /**
     * @param int $id
     * @return mixed|string
     * @throws GuzzleException
     */
    public function getDomainById(int $id)
    {
        return $this->client->get("products/domain/{$id}");
    }

    public function getAuthcode(int $id)
    {
        return $this->client->get("products/domain/{$id}/authcode", []);
    }

    public function addDeletionRequest(int $id)
    {
        return $this->client->post("products/domain/{$id}/delete", []);
    }

    public function removeDeletionRequest(int $id)
    {
        return $this->client->post("products/domain/{$id}/undelete", []);
    }

    public function checkSingleDomain(string $domain)
    {
        return $this->client->post('products/domain/check', [
            "domain" => $domain
        ]);
    }

    public function getPricelist()
    {
        return $this->client->get("products/domain/pricelist", []);
    }

    public function create(string $domain, string $firstname, string $lastname, string $email, string $phone, string $street, string $number, string $city, string $zip, string $state, string $country, array $nameservers = [], string $company = null)
    {
        return $this->client->post("products/domain/order", [
            "domain" => $domain,
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
            "nameservers" => $nameservers,
            "company" => $company
        ]);
    }

    public function transfer(string $domain, string $authcode, string $firstname, string $lastname, string $email, string $phone, string $street, string $number, string $city, string $zip, string $state, string $country, array $nameservers = [], string $company = null)
    {
        return $this->client->post("products/domain/transfer", [
            "domain" => $domain,
            "authcode" => $authcode,
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
            "nameservers" => $nameservers,
            "company" => $company
        ]);
    }

    /**
     * @return DNS
     */
    public function dns(): DNS
    {
        return $this->dnsHandler ??= new DNS($this->client);
    }

    /**
     * @return Nameserver
     */
    public function nameserver(): Nameserver
    {
        return $this->nameserverHandler ??= new Nameserver($this->client);
    }

    /**
     * @return Contact
     */
    public function contact(): Contact
    {
        return $this->contactHandler ??= new Contact($this->client);
    }
}