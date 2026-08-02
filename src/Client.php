<?php

namespace YourReselling;

use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;
use YourReselling\Account\Account;
use YourReselling\Announcements\Announcements;
use YourReselling\Asn\Asn;
use YourReselling\Billing\Billing;
use YourReselling\ContainerRegistry\ContainerRegistry;
use YourReselling\DDoS\DDoS;
use YourReselling\Dedicated\Dedicated;
use YourReselling\Domains\Domains;
use YourReselling\Exceptions\ParameterException;
use YourReselling\Inference\Inference;
use YourReselling\IpTunnels\IpTunnels;
use YourReselling\Ipv6\Ipv6;
use YourReselling\Kubernetes\Kubernetes;
use YourReselling\LoadBalancer\LoadBalancer;
use YourReselling\PbsStorage\PbsStorage;
use YourReselling\Plesk\Plesk;
use YourReselling\Ripe\Ripe;
use YourReselling\Rootserver\Rootserver;
use YourReselling\S3Storage\S3Storage;
use YourReselling\Ssl\Ssl;
use YourReselling\StorageBox\StorageBox;
use YourReselling\SubReseller\SubReseller;
use YourReselling\TeamSpeak\TeamSpeak;
use YourReselling\VPN\VPN;

class Client
{
    private $httpClient;
    private Credentials $credentials;
    private string $apiToken;
    private ?Account $accountHandler = null;
    private ?Announcements $announcementsHandler = null;
    private ?Billing $billingHandler = null;
    private ?DDoS $ddosHandler = null;
    private ?Domains $domainHandler = null;
    private ?Inference $inferenceHandler = null;
    private ?IpTunnels $ipTunnelsHandler = null;
    private ?Kubernetes $kubernetesHandler = null;
    private ?LoadBalancer $loadBalancerHandler = null;
    private ?PbsStorage $pbsStorageHandler = null;
    private ?Plesk $pleskHandler = null;
    private ?Rootserver $rootserverHandler = null;
    private ?SubReseller $subResellerHandler = null;
    private ?TeamSpeak $teamspeakHandler = null;
    private ?VPN $vpnHandler = null;
    private ?Asn $asnHandler = null;
    private ?ContainerRegistry $containerRegistryHandler = null;
    private ?Dedicated $dedicatedHandler = null;
    private ?Ipv6 $ipv6Handler = null;
    private ?Ripe $ripeHandler = null;
    private ?S3Storage $s3StorageHandler = null;
    private ?Ssl $sslHandler = null;
    private ?StorageBox $storageBoxHandler = null;

    public function __construct(string $token, string $version = 'v1', $httpClient = null, ?string $baseUrl = null)
    {
        $this->apiToken = $token;
        $this->credentials = new Credentials($token, $version, $baseUrl);
        $this->setHttpClient($httpClient);
    }

    public function setHttpClient(?\GuzzleHttp\Client $httpClient = null): void
    {
        $this->httpClient = $httpClient ?: new \GuzzleHttp\Client([
            'http_errors' => false,
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $this->apiToken,
                'User-Agent' => 'ResellingProviderClient/2.1'
            ],
            'allow_redirects' => false,
            'timeout' => 120
        ]);
    }

    public function getHttpClient(): \GuzzleHttp\Client
    {
        return $this->httpClient;
    }

    public function getToken(): string
    {
        return $this->apiToken;
    }

    private function getCredentials(): Credentials
    {
        return $this->credentials;
    }

    private function buildUrl(string $actionPath): string
    {
        return $this->getCredentials()->getUrl() . $this->getCredentials()->getVersion() . '/' . $actionPath;
    }

    private function request(string $actionPath, array $params = [], string $method = 'GET', array $options = []): ResponseInterface
    {
        $url = $this->buildUrl($actionPath);

        switch ($method) {
            case 'GET':
                return $this->getHttpClient()->get($url, ['query' => $params ?: null] + $options);
            case 'POST':
                return $this->getHttpClient()->post($url, ['json' => $params] + $options);
            case 'PUT':
                return $this->getHttpClient()->put($url, ['json' => $params] + $options);
            case 'PATCH':
                return $this->getHttpClient()->patch($url, ['json' => $params] + $options);
            case 'DELETE':
                return $this->getHttpClient()->delete($url, ['json' => $params] + $options);
            default:
                throw new ParameterException('Invalid HTTP method: ' . $method);
        }
    }

    public function processRequest(ResponseInterface $response): array
    {
        $statusCode = $response->getStatusCode();
        $responseBody = $response->getBody()->__toString();
        $result = json_decode($responseBody, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            // Non-JSON response (gateway/timeout error page, empty body, ...).
            // Surface the HTTP status and a short body snippet so callers can
            // tell what actually happened instead of just "JSON decoding error".
            $snippet = trim(substr($responseBody, 0, 300));

            throw new \RuntimeException(
                sprintf(
                    'Unexpected non-JSON response (HTTP %d): %s',
                    $statusCode,
                    $snippet !== '' ? $snippet : '<empty response body>'
                ),
                $statusCode
            );
        }

        if ($statusCode >= 400) {
            $error = $result['error'] ?? [];
            $message = $error['message'] ?? $result['message'] ?? 'API request failed';
            throw new \RuntimeException($message, $statusCode);
        }

        return $result['data'] ?? $result;
    }

    public function get(string $actionPath, array $params = []): array
    {
        return $this->processRequest($this->request($actionPath, $params, 'GET'));
    }

    public function post(string $actionPath, array $params = []): array
    {
        return $this->processRequest($this->request($actionPath, $params, 'POST'));
    }

    public function put(string $actionPath, array $params = []): array
    {
        return $this->processRequest($this->request($actionPath, $params, 'PUT'));
    }

    public function patch(string $actionPath, array $params = []): array
    {
        return $this->processRequest($this->request($actionPath, $params, 'PATCH'));
    }

    public function delete(string $actionPath, array $params = []): array
    {
        return $this->processRequest($this->request($actionPath, $params, 'DELETE'));
    }

    /**
     * A GET whose response is not JSON — a rendered file, an archive, an
     * image. Returns the body untouched.
     */
    public function getRaw(string $actionPath, array $params = []): string
    {
        $response = $this->request($actionPath, $params, 'GET');

        if ($response->getStatusCode() >= 400) {
            $body = $response->getBody()->__toString();
            $decoded = json_decode($body, true);
            $message = $decoded['error']['message'] ?? $decoded['message'] ?? 'API request failed';
            throw new \RuntimeException($message, $response->getStatusCode());
        }

        return $response->getBody()->__toString();
    }

    public function postRaw(string $actionPath, array $params = []): string
    {
        $response = $this->request($actionPath, $params, 'POST');

        if ($response->getStatusCode() >= 400) {
            $body = $response->getBody()->__toString();
            $decoded = json_decode($body, true);
            $message = $decoded['error']['message'] ?? $decoded['message'] ?? 'API request failed';
            throw new \RuntimeException($message, $response->getStatusCode());
        }

        return $response->getBody()->__toString();
    }

    public function postMultipart(string $actionPath, array $multipart): array
    {
        $url = $this->buildUrl($actionPath);
        $response = $this->getHttpClient()->post($url, [
            'multipart' => $multipart,
            'headers' => ['Content-Type' => null],
        ]);
        return $this->processRequest($response);
    }

    public function account(): Account
    {
        return $this->accountHandler ??= new Account($this);
    }

    public function announcements(): Announcements
    {
        return $this->announcementsHandler ??= new Announcements($this);
    }

    public function billing(): Billing
    {
        return $this->billingHandler ??= new Billing($this);
    }

    public function ddos(): DDoS
    {
        return $this->ddosHandler ??= new DDoS($this);
    }

    public function domain(): Domains
    {
        return $this->domainHandler ??= new Domains($this);
    }

    public function inference(): Inference
    {
        return $this->inferenceHandler ??= new Inference($this);
    }

    public function ipTunnels(): IpTunnels
    {
        return $this->ipTunnelsHandler ??= new IpTunnels($this);
    }

    public function kubernetes(): Kubernetes
    {
        return $this->kubernetesHandler ??= new Kubernetes($this);
    }

    public function loadBalancer(): LoadBalancer
    {
        return $this->loadBalancerHandler ??= new LoadBalancer($this);
    }

    public function pbsStorage(): PbsStorage
    {
        return $this->pbsStorageHandler ??= new PbsStorage($this);
    }

    public function plesk(): Plesk
    {
        return $this->pleskHandler ??= new Plesk($this);
    }

    public function rootserver(): Rootserver
    {
        return $this->rootserverHandler ??= new Rootserver($this);
    }

    public function asn(): Asn
    {
        return $this->asnHandler ??= new Asn($this);
    }

    public function containerRegistry(): ContainerRegistry
    {
        return $this->containerRegistryHandler ??= new ContainerRegistry($this);
    }

    public function dedicated(): Dedicated
    {
        return $this->dedicatedHandler ??= new Dedicated($this);
    }

    public function ipv6(): Ipv6
    {
        return $this->ipv6Handler ??= new Ipv6($this);
    }

    public function ripe(): Ripe
    {
        return $this->ripeHandler ??= new Ripe($this);
    }

    public function s3Storage(): S3Storage
    {
        return $this->s3StorageHandler ??= new S3Storage($this);
    }

    public function ssl(): Ssl
    {
        return $this->sslHandler ??= new Ssl($this);
    }

    public function storageBox(): StorageBox
    {
        return $this->storageBoxHandler ??= new StorageBox($this);
    }

    public function subReseller(): SubReseller
    {
        return $this->subResellerHandler ??= new SubReseller($this);
    }

    public function teamspeak(): TeamSpeak
    {
        return $this->teamspeakHandler ??= new TeamSpeak($this);
    }

    public function vpn(): VPN
    {
        return $this->vpnHandler ??= new VPN($this);
    }
}
