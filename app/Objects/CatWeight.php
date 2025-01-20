<?php

namespace App\Objects;

use App\Contracts\WeightContract;
use Stringable;

final class CatWeight implements WeightContract
{

    public function __construct(
        public string $imperial,
        public string $metric,
    ) {}

}
