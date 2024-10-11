<?php

namespace YourReselling\VPN;

use GuzzleHttp\Exception\GuzzleException;
use YourReselling\Client;

class VPN
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
        return $this->client->get('products/vpn');
    }

    /**
     * @param int $id VPN Account ID
     * @return mixed|string
     * @throws GuzzleException
     */
    public function getById(int $id)
    {
        return $this->client->get('products/vpn/' . $id);
    }

    /**
     * @return mixed|string
     * @throws GuzzleException
     */
    public function gerPriceList()
    {
        return $this->client->get('products/vpn/pricelist');
    }

    /**
     * @param string $username
     * @param string $password
     * @param string|null $custom_name
     * @return mixed|string
     * @throws GuzzleException
     */
    public function createVPNAccount(string $username, string $password, string $custom_name = null)
    {
        return $this->client->post('products/vpn/create', [
            'username' => $username,
            'password' => $password,
            'custom_name' => $custom_name,
        ]);
    }

    /**
     * @param int $id VPN Account ID
     * @param string|null $custom_name Set Custom Name
     * @return mixed|string
     * @throws GuzzleException
     */
    public function changeCustomName(int $id, string $custom_name = null)
    {
        return $this->client->post('products/vpn/' . $id . '/setCustomName', [
            'custom_name' => $custom_name,
        ]);
    }

    /**
     * @param int $id VPN Account ID
     * @return mixed|string
     * @throws GuzzleException
     */
    public function getServerList(int $id)
    {
        return $this->client->get('products/vpn/' . $id . '/servers');
    }

    /**
     * @param int $id VPN Account ID
     * @param int $server_id Server ID
     * @return mixed|string
     * @throws GuzzleException
     */
    public function getOpenVpnConfig(int $id, int $server_id)
    {
        return $this->client->post('products/vpn/' . $id . '/openvpn/config', [
            'server_id' => $server_id,
        ]);
    }

    /**
     * @param int $id VPN Account ID
     * @param int $server_id Server ID
     * @return mixed|string
     * @throws GuzzleException
     */
    public function getWireGuardConfig(int $id, int $server_id)
    {
        return $this->client->post('products/vpn/' . $id . '/wireguard/config', [
            'server_id' => $server_id,
        ]);
    }

    /**
     * @param int $id VPN Account ID
     * @param string $password New Password
     * @return mixed|string
     * @throws GuzzleException
     */
    public function setAccountPassword(int $id, string $password)
    {
        return $this->client->post('products/vpn/' . $id . '/setPassword', [
            'password' => $password,
        ]);
    }

    /**
     * @param $id int VPN Account ID
     * @return mixed|string
     * @throws GuzzleException
     */
    public function deleteAccount(int $id)
    {
        return $this->client->delete('products/vpn/' . $id . '/delete');
    }
}