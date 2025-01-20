<?php

namespace App\Objects;

use App\Contracts\BreedContract;
use Illuminate\Contracts\Support\Arrayable;
use Stringable;

final class CatBreed implements BreedContract, Stringable, Arrayable
{

    public CatWeight $weight;

    public CatImage $image;

    public function __construct(
        public string $id,
        public string $name,
        public string $life_span,
        public ?string $cfa_url = null,
        public ?string $vetstreet_url = null,
        public ?string $vcahospitals_url = null,
        public string $temperament,
        public string $origin,
        public string $country_codes,
        public string $country_code,
        public string $description,
        public ?bool $indoor = false,
        public ?bool $lap = false,
        public ?string $alt_names = '',
        public int $adaptability = 1,
        public int $affection_level = 1,
        public int $child_friendly = 1,
        public int $dog_friendly = 1,
        public ?int $cat_friendly = 1,
        public int $energy_level = 1,
        public int $grooming = 1,
        public int $health_issues = 1,
        public int $intelligence = 1,
        public int $shedding_level = 1,
        public int $social_needs = 1,
        public int $stranger_friendly = 1,
        public int $vocalisation = 1,
        public ?int $bidability = 1,
        public ?bool $experimental = false,
        public ?bool $hairless = false,
        public ?bool $natural = false,
        public ?bool $rare = false,
        public ?bool $rex = false,
        public ?bool $suppressed_tail = false,
        public ?bool $short_legs = false,
        public ?string $wikipedia_url = null,
        public ?bool $hypoallergenic = false,
        public ?string $reference_image_id = null,

        CatWeight|array|null $weight,
        CatImage|array|null $image,
    ) {
        if($weight) {
            $this->weight = $weight instanceof CatWeight ? $weight : new CatWeight(...$weight);
        }

        if($image) {
            $this->image = $image instanceof CatImage ? $image : new CatImage(...$image);
        }
    }

    public function __toString(): string
    {
        return json_encode($this);
    }

    public function toArray(): array
    {
        $vars = get_object_vars($this);

        if(! empty($vars['weight']) ) {
            if( $vars['weight'] instanceof CatWeight ) {
                $vars['weight_imperial'] = $vars['weight']->imperial;
                $vars['weight_metric'] = $vars['weight']->metric;
            }

            unset($vars['weight']);
        }

        if(! empty($vars['image']) ) {
            if( $vars['weight'] instanceof CatImage ) {
                $vars['image_url'] = $vars['weight']->url;
            }

            unset($vars['image']);
        }

        return $vars;
    }

}
