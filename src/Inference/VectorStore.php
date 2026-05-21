<?php

namespace YourReselling\Inference;

use YourReselling\Client;

class VectorStore
{
    private Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    // --- Collections ---

    public function getAll(): array
    {
        return $this->client->get('products/inference/vector-store');
    }

    public function getById(string $collection): array
    {
        return $this->client->get("products/inference/vector-store/{$collection}");
    }

    public function create(string $name): array
    {
        return $this->client->post('products/inference/vector-store', ['name' => $name]);
    }

    public function update(string $collection, array $params): array
    {
        return $this->client->patch("products/inference/vector-store/{$collection}", $params);
    }

    public function delete(string $collection): array
    {
        return $this->client->delete("products/inference/vector-store/{$collection}");
    }

    public function search(string $collection, string $input): array
    {
        return $this->client->post("products/inference/vector-store/{$collection}/search", ['input' => $input]);
    }

    // --- Items ---

    public function getItems(string $collection): array
    {
        return $this->client->get("products/inference/vector-store/{$collection}/items");
    }

    public function getItem(string $collection, string $item): array
    {
        return $this->client->get("products/inference/vector-store/{$collection}/items/{$item}");
    }

    public function addItem(string $collection, array $params): array
    {
        return $this->client->post("products/inference/vector-store/{$collection}/items", $params);
    }

    public function updateItem(string $collection, string $item, array $params): array
    {
        return $this->client->patch("products/inference/vector-store/{$collection}/items/{$item}", $params);
    }

    public function deleteItem(string $collection, string $item): array
    {
        return $this->client->delete("products/inference/vector-store/{$collection}/items/{$item}");
    }

    // --- Files ---

    public function getFiles(string $collection): array
    {
        return $this->client->get("products/inference/vector-store/{$collection}/files");
    }

    public function getFile(string $collection, string $file): array
    {
        return $this->client->get("products/inference/vector-store/{$collection}/files/{$file}");
    }

    public function uploadFile(string $collection, string $filePath, ?string $filename = null): array
    {
        $multipart = [
            [
                'name' => 'file',
                'contents' => fopen($filePath, 'r'),
                'filename' => $filename ?? basename($filePath),
            ],
        ];
        return $this->client->postMultipart("products/inference/vector-store/{$collection}/files", $multipart);
    }

    public function deleteFile(string $collection, string $file): array
    {
        return $this->client->delete("products/inference/vector-store/{$collection}/files/{$file}");
    }
}
