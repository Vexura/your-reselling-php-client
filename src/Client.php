<?php

namespace YourReselling;

use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;
use YourReselling\Accounting\Accounting;
use YourReselling\Domains\Domains;
use YourReselling\Exceptions\ParameterException;
use YourReselling\Licenses\Plesk;
use YourReselling\RootServer\RootServer;
use YourReselling\VPN\VPN;

class Client
{
    private $httpClient;
    private Credentials $credentials;
    private string $apiToken;
    private $rootServerHandler;
    private $domainHandler;
    private $accountingHandler;
    private $pleskHandler;
    private $vpnHandler;


    /**
     * @param string $token
     * @param string $version
     * @param null $httpClient
     */
    public function __construct(string $token, string $version = "v1", $httpClient = null)
    {
        $this->apiToken = $token;
        $this->setHttpClient($httpClient);
        $this->credentials = new Credentials($token, $version);
    }

    /**
     * @param \GuzzleHttp\Client|null $httpClient
     * @return void
     */
    public function setHttpClient(\GuzzleHttp\Client $httpClient = null)
    {
        $this->httpClient = $httpClient ?: new \GuzzleHttp\Client([
            'http_errors' => false,
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $this->apiToken,
                'User-Agent' => 'YourResellingClient/1.0'
            ],
            'allow_redirects' => false,
            'follow_redirects' => false,
            'timeout' => 120
        ]);
    }

    /**
     * @param $credentials
     * @param $version
     * @return void
     */
    public function setCredentials($credentials, $version)
    {
        if (!$credentials instanceof Credentials) {
            $credentials = new Credentials($credentials, $version);
        }

        $this->credentials = $credentials;
    }

    /**
     * @return \GuzzleHttp\Client
     */
    public function getHttpClient(): \GuzzleHttp\Client
    {
        return $this->httpClient;
    }

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->apiToken;
    }

    /**
     * @return Credentials
     */
    private function getCredentials(): Credentials
    {
        return $this->credentials;
    }


    /**
     * @param string $actionPath
     * @param array $params
     * @param string $method
     * @return ResponseInterface
     * @throws GuzzleException
     */
    private function request(string $actionPath, array $params = [], string $method = 'GET'): ResponseInterface
    {
        $url = $this->getCredentials()->getUrl(). $this->getCredentials()->getVersion() . '/' .$actionPath;

        if (!is_array($params)) {
            throw new ParameterException();
        }

        switch ($method) {
            case 'GET':
                return $this->getHttpClient()->get($url, [
                    'verify' => false,
                    'json' => $params
                ]);
            case 'POST':
                return $this->getHttpClient()->post($url, [
                    'verify' => false,
                    'json' => $params
                ]);
            case 'PUT':
                return $this->getHttpClient()->put($url, [
                    'verify' => false,
                    'json' => $params
                ]);
            case 'DELETE':
                return $this->getHttpClient()->delete($url, [
                    'verify' => false,
                    'json' => $params
                ]);
            default:
                throw new ParameterException('Wrong method: ' . $method);
        }
    }

    /**
     * @param ResponseInterface $response
     * @return mixed|string
     */
    public function processRequest(ResponseInterface $response)
    {
        $responseBody = $response->getBody()->__toString();
        $result = json_decode($responseBody, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \RuntimeException('JSON decoding error: ' . json_last_error_msg());
        }

        return $result ?? $responseBody;
    }

    /**
     * @param string $actionPath
     * @param array $params
     * @return mixed|string
     * @throws GuzzleException
     */
    public function post(string $actionPath, array $params = [])
    {
        $response = $this->request($actionPath, $params, 'POST');
        return $this->processRequest($response);
    }

    /**
     * @param string $actionPath
     * @param array $params
     * @return mixed|string
     * @throws GuzzleException
     */
    public function get(string $actionPath, array $params = [])
    {
        $response = $this->request($actionPath, $params, 'GET');
        return $this->processRequest($response);
    }

    /**
     * @param string $actionPath
     * @param array $params
     * @return mixed|string
     * @throws GuzzleException
     */
    public function put(string $actionPath, array $params = [])
    {
        $response = $this->request($actionPath, $params, 'PUT');
        return $this->processRequest($response);
    }

    /**
     * @param string $actionPath
     * @param array $params
     * @return mixed|string
     * @throws GuzzleException
     */
    public function delete(string $actionPath, array $params = [])
    {
        $response = $this->request($actionPath, $params, 'DELETE');
        return $this->processRequest($response);
    }

    /**
     * @return Accounting
     */
    public function accounting(): Accounting
    {
        return $this->accountingHandler ??= new Accounting($this);
    }

    /**
     * @return Domains
     */
    public function domain(): Domains
    {
        return $this->domainHandler ??= new Domains($this);
    }

    /**
     * @return RootServer
     */
    public function rootServer(): RootServer
    {
        return $this->rootServerHandler ??= new RootServer($this);
    }

    /**
     * @return Plesk
     */
    public function plesk(): Plesk
    {
        return $this->pleskHandler ??= new Plesk($this);
    }

    /**
     * @return VPN
     */
    public function vpn(): VPN
    {
        return $this->vpnHandler ??= new VPN($this);
    }
}