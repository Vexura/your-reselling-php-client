<?php

namespace YourReselling\Inference;

use YourReselling\Client;

class Inference
{
    private Client $client;
    private ?VectorStore $vectorStoreHandler = null;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    // --- Chat ---

    public function chatCompletion(array $params): array
    {
        return $this->client->post('products/inference/chat/completions', $params);
    }

    public function chatCompletionRag(array $params): array
    {
        return $this->client->post('products/inference/chat/completions/rag', $params);
    }

    // --- Audio ---

    public function createSpeech(array $params): string
    {
        return $this->client->postRaw('products/inference/audio/speech', $params);
    }

    public function voices(): array
    {
        return $this->client->get('products/inference/audio/voices');
    }

    // --- Images ---

    public function generateImage(array $params): array
    {
        return $this->client->post('products/inference/images/generations', $params);
    }

    // --- Models ---

    public function models(): array
    {
        return $this->client->get('products/inference/models');
    }

    public function chatModels(): array
    {
        return $this->client->get('products/inference/models/chat');
    }

    public function audioModels(): array
    {
        return $this->client->get('products/inference/models/audio');
    }

    public function imageModels(): array
    {
        return $this->client->get('products/inference/models/images');
    }

    // --- Usage ---

    public function usage(): array
    {
        return $this->client->get('products/inference/usage');
    }

    public function dailyUsage(?string $from = null, ?string $to = null): array
    {
        $params = [];
        if ($from !== null) $params['from'] = $from;
        if ($to !== null) $params['to'] = $to;
        return $this->client->get('products/inference/usage/daily', $params);
    }

    // --- Sub-handlers ---

    public function vectorStore(): VectorStore
    {
        return $this->vectorStoreHandler ??= new VectorStore($this->client);
    }
}
