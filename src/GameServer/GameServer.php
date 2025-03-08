<?php

namespace YourReselling\GameServer;

use YourReselling\Client;
use GuzzleHttp\Exception\GuzzleException;

class GameServer
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
    public function getAllCategories()
    {
        return $this->client->get('products/game-servers/categories');
    }

    /**
     * @return mixed|string
     * @throws GuzzleException
     */
    public function getAllGamesByCategory(int $category_id)
    {
        return $this->client->get('products/game-servers/categories/'. $category_id .'/games');
    }

    /**
     * @return mixed|string
     * @throws GuzzleException
     */
    public function getAll()
    {
        return $this->client->get('products/game-servers');
    }


    /**
     * @return mixed|string
     * @throws GuzzleException
     */
    public function getById(int $id)
    {
        return $this->client->get('products/game-servers/' . $id);
    }

    /**
     * @return mixed|string
     * @throws GuzzleException
     */
    public function start(int $id)
    {
        return $this->client->post('products/game-servers/' . $id . '/actions/start');
    }

    /**
     * @return mixed|string
     * @throws GuzzleException
     */
    public function stop(int $id)
    {
        return $this->client->post('products/game-servers/' . $id . '/actions/stop');
    }

    /**
     * @return mixed|string
     * @throws GuzzleException
     */
    public function restart(int $id)
    {
        return $this->client->post('products/game-servers/' . $id . '/actions/restart');
    }

    /**
     * @return mixed|string
     * @throws GuzzleException
     */
    public function kill(int $id)
    {
        return $this->client->post('products/game-servers/' . $id . '/actions/kill');
    }

    /**
     * @return mixed|string
     * @throws GuzzleException
     */
    public function sendCommand(int $id, string $command)
    {
        return $this->client->post('products/game-servers/' . $id . '/actions/command', [
            'command' => $command
        ]);
    }

    /**
     * @return mixed|string
     * @throws GuzzleException
     */
    public function getUsage(int $id)
    {
        return $this->client->get('products/game-servers/' . $id . '/stats');
    }

    /**
     * @return mixed|string
     * @throws GuzzleException
     */
    public function delete(int $id)
    {
        return $this->client->delete('products/game-servers/' . $id);
    }

    /**
     * @return mixed|string
     * @throws GuzzleException
     */
    public function getAllUsers()
    {
        return $this->client->get('products/game-servers/users');
    }

    /**
     * @return mixed|string
     * @throws GuzzleException
     */
    public function getUserById(int $id)
    {
        return $this->client->get('game-servers/users/' . $id);
    }

    /**
     * @return mixed|string
     * @throws GuzzleException
     */
    public function getUserServersById(int $id)
    {
        return $this->client->get('game-servers/users/' . $id . '/servers');
    }

    /**
     * @return mixed|string
     * @throws GuzzleException
     */
    public function createUser(string $username, string $password, string $email, string $firstname, string $lastname)
    {
        return $this->client->post('products/game-servers/users', [
            "username" => $username,
            "password" => $password,
            "email" => $email,
            "firstname" => $firstname,
            "lastname" => $lastname,
        ]);
    }

    /**
     * @return mixed|string
     * @throws GuzzleException
     */
    public function deleteUser(int $id)
    {
        return $this->client->delete('game-servers/users/' . $id);
    }

}
