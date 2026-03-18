<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class WeatherService
{
    public function get(string $city): array
    {
        $response = Http::get(
            config('services.weather.url'),
            [
                'q' => $city,
                'appid' => config('services.weather.key'),
                'units' => 'metric',
            ]
        );

        if ($response->failed()) {
            throw new \Exception('API failed');
        }

        $data = $response->json();

        return [
            'city' => $data['name'] ?? $city,
            'temperature' => $data['main']['temp'] ?? null,
            'weather' => $data['weather'][0]['description'] ?? null,
            'timestamp' => now()->toDateTimeString(),
        ];
    }

    public function getCached(string $city): array
    {
        $key = "weather_" . strtolower($city);

        $cached = Cache::get($key);

        if ($cached) {
            return [
                ...$cached,
                'source' => 'cache'
            ];
        }

        $data = $this->get($city);

        Cache::put($key, $data, now()->addMinutes(10));

        return [
            ...$data,
            'source' => 'external'
        ];
    }
}
