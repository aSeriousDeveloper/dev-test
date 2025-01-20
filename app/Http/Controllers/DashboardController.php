<?php

namespace App\Http\Controllers;

use App\Services\CatApiService;
use Illuminate\Http\Request;

final class DashboardController extends Controller
{

    public function __construct(
        private readonly CatApiService $api,
    ) {}

    public function __invoke(Request $request)
    {

        $breeds = $this->api->getBreeds($request->query('search'));

        return view('dashboard', [
            'breeds' => $breeds,
        ]);
    }
}
