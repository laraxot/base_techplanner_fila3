<?php

declare(strict_types=1);

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Geo\Actions\GetCoordinatesFromMultipleServicesAction;
use Modules\TechPlanner\Filament\Resources\ClientResource\Pages\ListClients;
use Modules\TechPlanner\Models\Client;
use Tests\TestCase;

class ListClientsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function itUpdatesClientCoordinates()
    {
        // Arrange: Creiamo un client con un indirizzo noto
        $client = Client::factory()->create([
            'full_address' => 'Via Roma 1, Milano, Italia',
            'latitude' => null,
            'longitude' => null,
        ]);

        // Mock del servizio di geocoding
        $this->mock(GetCoordinatesFromMultipleServicesAction::class, function ($mock) {
            $mock->shouldReceive('execute')
                ->andReturn(['latitude' => 45.4642, 'longitude' => 9.1900]);
        });

        // Act: Eseguiamo l'aggiornamento delle coordinate
        $page = new ListClients();
        $page->updateClientCoordinates($client);

        // Assert: Verifichiamo che le coordinate siano state aggiornate
        $client->refresh();
        $this->assertEquals(45.4642, $client->latitude);
        $this->assertEquals(9.1900, $client->longitude);
    }
}
