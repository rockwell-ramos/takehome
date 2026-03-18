<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\Http;

class WeatherTest extends TestCase
{
    public function test_getting_weather_data(): void
    {
        Http::fake([
            '*' => Http::response([
                'name' => 'Manila',
                'main' => ['temp' => 30],
                'weather' => [['description' => 'clear sky']]
            ], 200)
        ]);

        $response = $this->getJson('/api/weather/Manila');

        $response->assertStatus(200)
            ->assertJson([
                'city' => 'Manila',
                'temperature' => 30,
                'weather' => 'clear sky',
                'source' => 'external',
            ]);
    }

    public function test_cached_weather(): void
    {
        config(['cache.default' => 'array']);

        Http::fake([
            '*' => Http::response([
                'name' => 'Manila',
                'main' => ['temp' => 30],
                'weather' => [['description' => 'clear sky']]
            ], 200)
        ]);

        $this->getJson('/api/weather/Manila/cached');
        $response = $this->getJson('/api/weather/Manila/cached');

        $response->assertStatus(200)
                 ->assertJson(['source' => 'cache']);

        Http::assertSentCount(1);
    }
}
