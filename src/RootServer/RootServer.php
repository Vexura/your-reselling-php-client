<?php

namespace YourReselling\RootServer;

use GuzzleHttp\Exception\GuzzleException;
use YourReselling\Client;

class RootServer
{
    private $client;

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
        return $this->client->get('products/root-server/list');
    }

    /**
     * @param int $id
     * @return mixed|string
     * @throws GuzzleException
     */
    public function getById(int $id)
    {
        return $this->client->get("products/root-server/{$id}");
    }

    /**
     * @param int $id
     * @return mixed|string
     * @throws GuzzleException
     */
    public function start(int $id)
    {
        return $this->client->post("products/root-server/{$id}/start");
    }

    /**
     * @param int $id
     * @return mixed|string
     * @throws GuzzleException
     */
    public function stop(int $id)
    {
        return $this->client->post("products/root-server/{$id}/stop");
    }

    /**
     * @param int $id
     * @return mixed|string
     * @throws GuzzleException
     */
    public function restart(int $id)
    {
        return $this->client->post("products/root-server/{$id}/restart");
    }

    /**
     * @param int $id
     * @return mixed|string
     * @throws GuzzleException
     */
    public function kill(int $id)
    {
        return $this->client->post("products/root-server/{$id}/kill");
    }

    /**
     * @param int $id
     * @return mixed|string
     * @throws GuzzleException
     */
    public function delete(int $id)
    {
        return $this->client->delete("products/root-server/{$id}/kill");
    }

    /**
     * @param int $id
     * @param int|null $os_id
     * @return mixed|string
     * @throws GuzzleException
     */
    public function reinstall(int $id, int $os_id = null)
    {
        return $this->client->post("products/root-server/{$id}/reinstall", ['os_id' => $os_id]);
    }

    /**
     * @param int $id
     * @param int|null $root_password
     * @return mixed|string
     * @throws GuzzleException
     */
    public function resetRootPassword(int $id, string $root_password = null)
    {
        return $this->client->post("products/root-server/{$id}/reset-root-password", ['root_password' => $root_password]);
    }

    /**
     * @param int $id
     * @return mixed|string
     * @throws GuzzleException
     */
    public function vnc(int $id)
    {
        return $this->client->get("products/root-server/{$id}/vnc");
    }

    /**
     * @return mixed|string
     * @throws GuzzleException
     */
    public function locations()
    {
        return $this->client->get("products/root-server/locations");
    }

    /**
     * @return mixed|string
     * @throws GuzzleException
     */
    public function osList()
    {
        return $this->client->get("products/root-server/os-list");
    }

    /**
     * @param string $location
     * @return mixed|string
     * @throws GuzzleException
     */
    public function priceList(string $location)
    {
        return $this->client->get("products/root-server/{$location}/pricelist");
    }

    /**
     * @param string $location
     * @param int $cores
     * @param int $ram
     * @param int $disk
     * @param int $backups
     * @param int $ipv4
     * @param int $ipv6
     * @return mixed|string
     * @throws GuzzleException
     */
    public function calculatePrice(string $location, int $cores, int $ram, int $disk, int $backups, int $ipv4, int $ipv6)
    {
        return $this->client->post("products/root-server/{$location}/calculator", [
            'cores' => $cores,
            'ram' => $ram,
            'disk' => $disk,
            'backups' => $backups,
            'ipv4' => $ipv4,
            'ipv6' => $ipv6,
        ]);
    }

    /**
     * @param string $location
     * @param int $cores
     * @param int $ram
     * @param int $disk
     * @param int $ipv4
     * @param int $ipv6
     * @param int $os_id
     * @param int $backups
     * @param string|null $host_name
     * @param string|null $custom_name
     * @param string|null $root_password
     * @return mixed|string
     * @throws GuzzleException
     */
    public function create(string $location, int $cores, int $ram, int $disk, int $ipv4, int $ipv6, int $os_id, int $backups, string $host_name = null, string $custom_name = null, string $root_password = null)
    {
        return $this->client->post("products/root-server/{$location}/create", ['cores' => $cores, 'ram' => $ram, 'disk' => $disk, 'ipv4' => $ipv4, 'ipv6' => $ipv6, 'os_id' => $os_id, 'backups' => $backups, 'custom_name' => $custom_name, 'root_password' => $root_password, 'hostname' => $host_name]);
    }

    /**
     * @param int $vm_id
     * @return mixed|string
     * @throws GuzzleException
     */
    public function getAllIsos(int $vm_id)
    {
        return $this->client->get("products/root-server/{$vm_id}/iso");
    }

    /**
     * @param int $vm_id
     * @return mixed|string
     * @throws GuzzleException
     */
    public function getPrivateIsos(int $vm_id)
    {
        return $this->client->get("products/root-server/{$vm_id}/iso/private");
    }

    /**
     * @param int $vm_id
     * @return mixed|string
     * @throws GuzzleException
     */
    public function getPublicIsos(int $vm_id)
    {
        return $this->client->get("products/root-server/{$vm_id}/iso/public");
    }

    /**
     * @param int $vm_id
     * @param int $iso_id
     * @return mixed|string
     * @throws GuzzleException
     */
    public function deletePrivateIso(int $vm_id, int $iso_id)
    {
        return $this->client->get("products/root-server/{$vm_id}/iso/{$iso_id}/delete");
    }

    /**
     * @param int $vm_id
     * @param string $url
     * @return mixed|string
     * @throws GuzzleException
     */
    public function addPrivateIso(int $vm_id, string $url)
    {
        return $this->client->post("products/root-server/{$vm_id}/iso/addPrivate", ["url" => $url]);
    }

    /**
     * @param int $vm_id
     * @return mixed|string
     * @throws GuzzleException
     */
    public function getUsage(int $vm_id)
    {
        return $this->client->get("products/root-server/{$vm_id}/usage");
    }

    /**
     * @param int $vm_id
     * @param string $runtime
     * @return mixed|string
     */
    public function getStats(int $vm_id, string $runtime)
    {
        return $this->client->post("products/root-server/{$vm_id}/stats", [
            'runtime' => $runtime,
        ]);
    }

    /**
     * @param int $vm_id
     * @return mixed|string
     */
    public function getTasks(int $vm_id)
    {
        return $this->client->get("products/root-server/{$vm_id}/tasks");
    }
}
