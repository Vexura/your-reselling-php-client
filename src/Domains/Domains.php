<?php

namespace YourReselling\Domains;

use YourReselling\Client;
use YourReselling\Exceptions\ParameterException;

class Domains
{
    private Client $client;
    private ?DNS $dnsHandler = null;
    private ?DNSSEC $dnssecHandler = null;
    private ?Nameserver $nameserverHandler = null;
    private ?Handle $handleHandler = null;
    private ?DomainCatch $catchHandler = null;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    // --- Lookup ---

    public function check(string $domain): array
    {
        return $this->client->get('products/domains/check', ['domain' => $domain]);
    }

    public function checkBulk(array $domains): array
    {
        return $this->client->post('products/domains/check-bulk', ['domains' => $domains]);
    }

    public function suggestions(string $name, int $limit = 10): array
    {
        return $this->client->get('products/domains/suggestions', ['name' => $name, 'limit' => $limit]);
    }

    // --- Info ---

    public function pricing(?string $tld = null, ?bool $featured = null): array
    {
        $params = [];
        if ($tld !== null) $params['tld'] = $tld;
        if ($featured !== null) $params['featured'] = $featured;
        return $this->client->get('products/domains/pricing', $params);
    }

    public function statistics(): array
    {
        return $this->client->get('products/domains/statistics');
    }

    // --- Management ---

    public function getAll(array $filters = []): array
    {
        return $this->client->get('products/domains', $filters);
    }

    public function getById(string $id): array
    {
        return $this->client->get("products/domains/{$id}");
    }

    /**
     * Register a domain.
     *
     * Typed usage (recommended):
     *   $client->domains()->create('example.com', handleId: 'HANDLE-1', years: 2);
     *
     * Backward-compatible raw usage still works:
     *   $client->domains()->create(['domain' => 'example.com', 'handle_id' => '...', 'years' => 2]);
     *
     * @param string|array        $domain            Domain name, or a raw params array (legacy).
     * @param string|null         $handleId          Contact handle id (required in typed mode).
     * @param int                 $years             Registration term in years (1-10).
     * @param array<int,string>   $nameservers       Optional nameservers.
     * @param bool                $privacyProtection  Optional WHOIS privacy.
     * @param bool                $dnssecEnabled      Optional DNSSEC.
     * @param string|null         $notes             Optional internal note.
     * @param array<string,mixed> $extra             Escape hatch for additional/new provider fields.
     */
    public function create(
        string|array $domain = [],
        ?string $handleId = null,
        int $years = 1,
        array $nameservers = [],
        bool $privacyProtection = false,
        bool $dnssecEnabled = false,
        ?string $notes = null,
        array $extra = []
    ): array {
        // Legacy: create(array $params) — pass straight through.
        if (is_array($domain)) {
            return $this->client->post('products/domains/create', $domain);
        }

        if ($handleId === null) {
            throw new ParameterException('create() requires a $handleId.');
        }

        $params = $this->buildDomainPayload($domain, $years, $nameservers, $privacyProtection, $dnssecEnabled, $notes, $extra);
        $params['handle_id'] = $handleId;

        return $this->client->post('products/domains/create', $params);
    }

    /**
     * Transfer a domain in.
     *
     * Typed usage (recommended):
     *   $client->domains()->transfer('example.com', 'AUTH-CODE', 'HANDLE-1', years: 1);
     *
     * Backward-compatible raw usage still works:
     *   $client->domains()->transfer(['domain' => '...', 'auth_code' => '...', 'handle_id' => '...']);
     *
     * @param string|array        $domain      Domain name, or a raw params array (legacy).
     * @param string|null         $authCode    Authorization/EPP code (required in typed mode).
     * @param string|null         $handleId    Contact handle id (required in typed mode).
     * @param int                 $years       Term in years (1-10).
     * @param array<int,string>   $nameservers Optional nameservers.
     * @param bool                $privacyProtection Optional WHOIS privacy.
     * @param bool                $dnssecEnabled     Optional DNSSEC.
     * @param string|null         $notes       Optional internal note.
     * @param array<string,mixed> $extra       Escape hatch for additional/new provider fields.
     */
    public function transfer(
        string|array $domain = [],
        ?string $authCode = null,
        ?string $handleId = null,
        int $years = 1,
        array $nameservers = [],
        bool $privacyProtection = false,
        bool $dnssecEnabled = false,
        ?string $notes = null,
        array $extra = []
    ): array {
        // Legacy: transfer(array $params) — pass straight through.
        if (is_array($domain)) {
            return $this->client->post('products/domains/transfer', $domain);
        }

        if ($authCode === null || $handleId === null) {
            throw new ParameterException('transfer() requires an $authCode and a $handleId.');
        }

        $params = $this->buildDomainPayload($domain, $years, $nameservers, $privacyProtection, $dnssecEnabled, $notes, $extra);
        $params['auth_code'] = $authCode;
        $params['handle_id'] = $handleId;

        return $this->client->post('products/domains/transfer', $params);
    }

    /**
     * Build the shared register/transfer payload with the correct field names.
     * `years` is the provider's term field (1-10); a `period` field is ignored.
     *
     * @param array<int,string>   $nameservers
     * @param array<string,mixed> $extra
     * @return array<string,mixed>
     */
    private function buildDomainPayload(
        string $domain,
        int $years,
        array $nameservers,
        bool $privacyProtection,
        bool $dnssecEnabled,
        ?string $notes,
        array $extra
    ): array {
        $params = [
            'domain' => $domain,
            'years' => max(1, min(10, $years)),
        ];

        if ($nameservers !== []) {
            $params['nameservers'] = array_values($nameservers);
        }
        if ($privacyProtection) {
            $params['privacy_protection'] = true;
        }
        if ($dnssecEnabled) {
            $params['dnssec_enabled'] = true;
        }
        if ($notes !== null) {
            $params['notes'] = $notes;
        }

        // Caller-provided extras win (forward-compat / overrides).
        return array_merge($params, $extra);
    }

    public function generateAuthCode(string $id): array
    {
        return $this->client->post("products/domains/{$id}/auth-code");
    }

    public function enableAutoRenew(string $id): array
    {
        return $this->client->post("products/domains/{$id}/enableAutoRenew");
    }

    public function disableAutoRenew(string $id): array
    {
        return $this->client->post("products/domains/{$id}/disableAutoRenew");
    }

    // --- Sub-handlers ---

    public function dns(): DNS
    {
        return $this->dnsHandler ??= new DNS($this->client);
    }

    public function dnssec(): DNSSEC
    {
        return $this->dnssecHandler ??= new DNSSEC($this->client);
    }

    public function nameserver(): Nameserver
    {
        return $this->nameserverHandler ??= new Nameserver($this->client);
    }

    public function handle(): Handle
    {
        return $this->handleHandler ??= new Handle($this->client);
    }

    public function catch(): DomainCatch
    {
        return $this->catchHandler ??= new DomainCatch($this->client);
    }
}
