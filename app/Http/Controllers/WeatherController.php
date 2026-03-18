<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\WeatherService;

class WeatherController extends Controller
{
    public function __construct(private WeatherService $service) {}

    public function show(string $city)
    {
        $data = $this->service->get($city);

        return response()->json([
            ...$data,
            'source' => 'external',
        ]);
    }

    public function cached(string $city)
    {
        $data = $this->service->getCached($city);

        return response()->json($data);
    }
}
