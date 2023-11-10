<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CountryTest extends TestCase
{
    use RefreshDatabase;

    public function testsCountryCreateSuccess()
    {
        $payload = [
            'uid' => '7fde645d-26c8-11df-aea6-00173158052e',
            'name_ru' => "Россия",
            'name_en' => "Russia"
        ];

        $response = $this->postJson('/api/v2/countries', $payload);
        $response
            ->assertCreated()
            ->assertJson([
                'result' => [
                    'id' => 1,
                    'uid' => '7fde645d-26c8-11df-aea6-00173158052e',
                    'deleted' => false,
                    'name_ru' => "Россия",
                    'name_en' => "Russia"
                ]
            ]);
    }
}
