<?php

namespace App\Http\Controllers;

use App\Services\CatApiService;
use Illuminate\Http\Request;

final class PetController extends Controller
{

    public function __construct(
        private readonly CatApiService $api,
    ) {}

    public function __invoke(string $pet)
    {

        $breed = $this->api->getBreed($pet);

        return view('pet', [
            'breed' => $breed->toArray(),
        ]);
    }
}
