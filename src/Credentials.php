<?php

namespace YourReselling;

class Credentials
{
    private string $token;
    private string $url;
    private string $version;

    /**
     * Credentials constructor
     * @param string $token
     * @param string $version
     */
    public function __construct(string $token, string $version)
    {
        $this->token = $token;
        $this->url = 'https://your-reselling.de/api';
        $this->version = $version;
    }

    public function __toString()
    {
        return sprintf('[Host: %s], [Token: %s]', $this->url, $this->token);
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * @return string
     */
    public function getVersion(): string
    {
        return $this->version;
    }
}