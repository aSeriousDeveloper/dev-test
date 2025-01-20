<?php

namespace App\Objects;

use App\Contracts\ImageContract;

final class CatImage implements ImageContract
{

    public function __construct(
        public string $id,
        public string $url,
        public int $width,
        public int $height,
        public ?string $mime_type = null,
        public ?array $breeds = null,
    ) {}

}
