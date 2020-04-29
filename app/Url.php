<?php
/**
 * Author: York
 * Email: yorkshp@gmail.com
 * Date: 28.04.2020
 */

namespace App;


use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

class Url
{
    /** @var string  */
    private string $endpoint;

    /** @var array  */
    private array $params = [];

    /** @var ResponseInterface  */
    private ?ResponseInterface $requestInstance = null;

    /**
     * Url constructor.
     * @param string $endpoint
     */
    public function __construct(string $endpoint)
    {
        $this->endpoint = $endpoint;
    }

    /**
     * @param array $params
     * @return Url
     */
    public function params(array $params): Url
    {
        $this->params = $params;
        return $this;
    }

    /**
     * @return bool
     */
    public function isFound(): bool
    {
        return $this->getStatusCode() === 200;
    }

    /**
     * @return string
     */
    public function getBody(): string
    {
        return $this->request()->getBody()->getContents();
    }

    /**
     * @return array
     */
    public function getArray(): array
    {
        return json_decode($this->getBody(), true, 512, JSON_THROW_ON_ERROR);
    }

    /**
     * @return string
     */
    public function getJson(): string
    {
        return $this->getBody();
    }

    /**
     * @return mixed
     */
    public function getStatusCode(): int
    {
        return $this->request()->getStatusCode();
    }

    /**
     * @return ResponseInterface
     */
    private function request(): ResponseInterface
    {
        if (!$this->requestInstance) {
            $client = new Client();
            try {
                $this->requestInstance = $client->request('GET',
                    $this->endpoint,
                    $this->params ? ['query' => $this->params] : [], );
            } catch (ClientException $e) {
                $this->requestInstance = $e->getResponse();
            }
        }

        return $this->requestInstance;
    }
}
