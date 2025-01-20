<?php

namespace App\Services;

use App\Contracts\ApiServiceContract;
use App\Objects\Breed;
use App\Objects\CatBreed;
use GuzzleHttp\ClientInterface;
use Illuminate\Cache\Repository as CacheRepository;
use Illuminate\Config\Repository as ConfigRepository;
use Illuminate\Support\Arr;
use Illuminate\Support\DateFactory;

class CatApiService implements ApiServiceContract
{

    public function __construct(
        private readonly CacheRepository $cache,
        private readonly ConfigRepository $config,
        private readonly DateFactory $date,
        private readonly ClientInterface $http,
    ) {}

    public function getApiKey(): string
    {
        return $this->config->string('catapi.key');
    }

    public function getApiUrl(string $path = '/'): string
    {
        return $this->config->string('catapi.url') . $path;
    }

    /**
     * Get Cat Breeds
     *
     * @param string|null $search
     * @return array<Breed>
     */
    public function getBreeds(?string $search = null): array
    {
        if(! empty($search)) {
            return $this->searchBreeds($search);
        };

        $response = json_decode($this->request('get', '/breeds'), true);
        return $this->parseBreeds($response);
    }

    /**
     * Get Cat Breeds
     *
     * @param string|null $search
     * @return CatBreed
     */
    public function getBreed(string $id)
    {
        $response = json_decode($this->request('get', '/breeds/'.$id), true);
        return $this->parseBreed($response);
    }

    protected function searchBreeds(string $search)
    {
        $response = json_decode($this->request('get', '/breeds/search?q=' . urlencode($search)), true);
        return $this->parseBreeds($response);
    }

    protected function request(string $method = 'get', string $path, array $options = [])
    {

        $key = self::class . $method . $path . json_encode($options);
        $ttl = $this->date->now()->addHour();

        $options = array_merge_recursive([
            $options,
            [
                'headers' => [
                    'x-api-key' => $this->getApiKey(),
                ],
            ],
        ]);

        return $this->cache->remember($key, $ttl, function () use ($method, $path, $options) {
            return $this->http->request($method, $this->getApiUrl($path), $options)->getBody()->getContents();
        });

    }

    protected function parseBreeds(array $breeds) {
        $return = [];

        foreach ($breeds as $breedItem) {
            $return[] = $this->parseBreed($breedItem);
        }

        return $return;
    }

    protected function parseBreed(array $item) {
        $breed = array_merge(get_class_vars(CatBreed::class), array_filter($item));
        return new CatBreed(...$breed);
    }

}
