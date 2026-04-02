<?php

namespace YourReselling;

class Credentials
{
    private string $token;
    private string $url;
    private string $version;

    public function __construct(string $token, string $version = 'v1', string $url = null)
    {
        $this->token = $token;
        $this->url = $url ?? 'https://resellingprovider.de/api/';
        $this->version = $version;
    }

    public function __toString()
    {
        return sprintf('[Host: %s], [Token: %s]', $this->url, $this->token);
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getToken(): string
    {
        return $this->token;
    }

    public function getVersion(): string
    {
        return $this->version;
    }
}
