<?php

namespace App\Contracts;

interface ApiServiceContract
{

    public function getApiKey(): string;

    public function getApiUrl(): string;

    public function getBreeds(?string $search = null): array;

}
