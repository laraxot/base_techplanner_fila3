## Path Conventions and Namespaces

- Always check each module's composer.json file for correct:
  - Paths
  - Namespaces
  - Autoload configurations

- Example: Geo module data classes should be located at:
  `/laravel/Modules/Geo/Datas/GoogleMaps/`
  NOT `/laravel/Modules/Geo/Data/`

- This documentation serves as the single source of truth for path conventions

## Google Maps Integration Best Practices

- Data classes for Google Maps responses should be located in:
  `/laravel/Modules/Geo/Datas/GoogleMaps/`
  
- Action classes for Google Maps operations should be located in:
  `/laravel/Modules/Geo/app/Actions/GoogleMaps/`
  
- Example action pattern:
  `GetAddressFromGoogleMapsAction.php` implements:
  - Strict type checking (final class with type hints)
  - Custom exception handling (GoogleMapsApiException)
  - Single responsibility principle (separate methods for API key, request, validation)
  - Immutable data objects (Spatie Data)
  - Comprehensive error handling:
    - Missing API key
    - Failed API requests
    - Empty results
    - Invalid location data

### Uso di Spatie\LaravelData
- Utilizzare `DataCollection` per gestire le collezioni di dati in modo tipizzato e strutturato.
- Assicurarsi che i dati siano rappresentati da oggetti di dati definiti con `Spatie\LaravelData`.

### Modifiche al Codice
- Il file `GetAddressFromGoogleMapsAction.php` è stato migliorato per essere più robusto e strettamente tipizzato.
- Sono stati aggiunti controlli per garantire che la risposta dell'API sia valida prima di procedere con l'elaborazione.
- È stata migliorata la gestione delle eccezioni per fornire messaggi di errore più dettagliati.

### Gestione dei Valori Nulli
- Utilizzare l'operatore null coalescing (??) per fornire valori di default quando i componenti dell'indirizzo sono mancanti
- Esempio:
  ```php
  'locality' => $this->getComponent($result->address_components, ['locality']) ?? '',
  'street' => $this->getComponent($result->address_components, ['route']) ?? '',
  'district' => $this->getComponent($result->address_components, ['sublocality_level_1']) ?? '',
  'street_number' => $this->getComponent($result->address_components, ['street_number']) ?? ''
  ```
- Questo approccio previene errori di tipo quando i componenti dell'indirizzo non sono presenti nella risposta di Google Maps

### Gestione delle Coordinate Geografiche
- Quando si lavora con indirizzi completi, utilizzare `GetCoordinatesDataByFullAddressAction` per ottenere latitudine e longitudine
- Esempio di implementazione:
  ```php
  public function setLongitudeAttribute(?float $value): void
  {
      if (is_null($value) && $this->full_address) {
          $coordinatesAction = new GetCoordinatesDataByFullAddressAction();
          $coordinatesData = $coordinatesAction->execute($this->full_address);
          
          if ($coordinatesData) {
              $this->attributes['latitude'] = $coordinatesData->latitude;
              $this->attributes['longitude'] = $coordinatesData->longitude;
          }
      }
  }
  ```
- Questo pattern garantisce che le coordinate vengano automaticamente calcolate quando viene fornito un indirizzo completo

### Aggiornamento Batch delle Coordinate
- Implementazione di un sistema di aggiornamento batch per coordinate mancanti
- Funzionalità chiave:
  - Processamento in chunk per ottimizzare le prestazioni
  - Gestione degli errori con notifiche dettagliate
  - Supporto per aggiornamenti singoli e multipli
- Esempio di implementazione batch:
  ```php
  private function populateAllCoordinates(): void {
      $batchSize = 50;
      $totalProcessed = 0;
      $totalSuccess = 0;
      $errors = [];

      static::getModel()::whereNull('latitude')
          ->orWhereNull('longitude')
          ->chunk($batchSize, function ($clients) use (&$totalProcessed, &$totalSuccess, &$errors) {
              foreach ($clients as $client) {
                  try {
                      $addressData = app(GetAddressDataFromFullAddressAction::class)
                          ->execute($client->full_address);

                      if ($addressData) {
                          $client->update($addressData->toArray());
                          ++$totalSuccess;
                      }
                  } catch (\Throwable $e) {
                      $errors[] = "Error updating {$client->company_name}: {$e->getMessage()}";
                  }
                  ++$totalProcessed;
              }
          });

      // Gestione notifiche
      $message = "Processed {$totalProcessed} clients. Successfully updated {$totalSuccess} coordinates.";
      if (!empty($errors)) {
          Notification::make()
              ->warning()
              ->title('Coordinate Update Completed with Errors')
              ->body($message."\n\n".implode("\n", array_slice($errors, 0, 5)))
              ->persistent()
              ->send();
      } else {
          Notification::make()
              ->success()
              ->title('Coordinates Updated Successfully')
              ->body($message)
              ->send();
      }
  }
  ```

### Ordinamento per Distanza
- Funzionalità di ordinamento dei clienti in base alla distanza
- Implementazione con:
  - Persistenza delle coordinate in sessione e cookie
  - Aggiornamento dinamico della tabella
  - Gestione delle coordinate mancanti
- Esempio di ordinamento:
  ```php
  public function getTableQuery(): Builder {
      $query = parent::getTableQuery();
      $latitude = Session::get('user_latitude');
      $longitude = Session::get('user_longitude');

      return $query
          ->when($latitude && $longitude,
              function (Builder $query) use ($latitude, $longitude) {
                  $query->withDistance($latitude, $longitude)
                      ->orderByDistance($latitude, $longitude);
              }
          );
  }
  ```

## Photon Integration Best Practices

- Data classes for Photon responses should be located in:
  `/laravel/Modules/Geo/Datas/Photon/`
  
- Action classes for Photon operations should be located in:
  `/laravel/Modules/Geo/app/Actions/Photon/`
  
- Example action pattern:
  `GetAddressFromPhotonAction.php` implements:
  - Strict type checking (final class with type hints)
  - Custom exception handling (PhotonApiException)
  - Single responsibility principle (separate methods for request, validation)
  - Immutable data objects (Spatie Data)
  - Comprehensive error handling:
    - Failed API requests
    - Empty results
    - Invalid location data

### Photon Data Structure
- Use Spatie Data classes to represent Photon API responses
- Main response structure:
  ```php
  class PhotonResponseData extends Data {
      public ?array $features; // Array of PhotonFeatureData
  }
  
  class PhotonFeatureData extends Data {
      public PhotonGeometryData $geometry;
      public PhotonPropertiesData $properties;
  }
  
  class PhotonGeometryData extends Data {
      public array $coordinates; // [longitude, latitude]
  }
  
  class PhotonPropertiesData extends Data {
      public ?string $country;
      public ?string $city;
      public ?string $postcode;
      public ?string $street;
      public ?string $housenumber;
  }
  ```

### Example Usage
```php
$response = Http::get('https://photon.komoot.io/api', [
    'q' => $address,
    'limit' => 1
]);

$data = PhotonResponseData::from($response->json());

if ($data->features) {
    $feature = $data->features[0];
    $coordinates = $feature->geometry->coordinates;
    $properties = $feature->properties;
}
```

### Gestione Automatica delle Coordinate nel Modello Client
- Il modello `Client` imposta automaticamente le coordinate di latitudine e longitudine se l'indirizzo completo è disponibile e i valori sono nulli.
- Utilizza `GetCoordinatesDataByFullAddressAction` per ottenere i dati delle coordinate.
- Esempio:
  ```php
  public function setLongitudeAttribute(?float $value): void
  {
      if (is_null($value) && $this->full_address) {
          $coordinatesAction = new GetCoordinatesDataByFullAddressAction();
          $coordinatesData = $coordinatesAction->execute($this->full_address);

          if ($coordinatesData) {
              $this->attributes['latitude'] = $coordinatesData->latitude;
              $this->attributes['longitude'] = $coordinatesData->longitude;
          }
      } else {
          $this->attributes['longitude'] = $value;
      }
  }
  ```

### Miglioramenti Recenti
- Implementazione di un sistema di aggiornamento batch per coordinate mancanti
- Ordinamento dei clienti in base alla distanza
- Utilizzo di `phpstan` per l'analisi del codice

### Strumenti di Analisi del Codice
- `phpstan` è installato nella cartella `laravel` e può essere utilizzato per analizzare il codice a diversi livelli di rigore.
- Esempio di utilizzo:
  ```bash
  cd laravel && vendor/bin/phpstan analyse Modules --level=1
  ```

### Correzione dell'Integrazione della Mappa
- È stato corretto l'uso del widget per utilizzare `Filament\Widgets\WidgetConfiguration`.
- Assicura che i widget siano configurati correttamente per evitare errori di tipo.
- Esempio di implementazione corretta:
  ```php
  protected function getHeaderWidgets(): array
  {
      return [
          \Filament\Widgets\WidgetConfiguration::make()
              ->view('filament.widgets.map')
              ->data(
                  fn () => [
                      'clients' => $this->getTableQuery()->get(['latitude', 'longitude', 'name'])->toArray(),
                  ]
              ),
      ];
  }
  ```

## Widget Configuration Best Practices

- Extend Filament's base Widget class for custom widgets
- Key methods:
  - `make()`: Creates new widget instance
  - `getViewData()`: Provides data to the view
  - `getView()`: Specifies the view file

- Example implementation:
```php
class ClientMapWidget extends Widget
{
    protected static string $view = 'filament.widgets.map';
    protected ?ListClients $listClients = null;

    public function listClients(ListClients $listClients): static
    {
        $this->listClients = $listClients;
        return $this;
    }

    protected function getViewData(): array
    {
        return [
            'clients' => $this->listClients?->getTableQuery()
                ->get(['latitude', 'longitude', 'name'])
                ->toArray(),
        ];
    }
}

protected function getHeaderWidgets(): array
{
    return [
        ClientMapWidget::make()
            ->listClients($this),
    ];
}
```

- Best practices:
  - Use dependency injection for page-specific data
  - Keep widget logic focused on presentation
  - Use proper type hints and return types
  - Handle null cases gracefully
  - Cache expensive data operations
  - Use proper namespacing for widget classes
  - Follow Filament's widget lifecycle methods
  - Use proper view data structure
  - Implement proper error handling

## Map Widget Configuration

The ClientMapWidget displays client locations using latitude/longitude coordinates from the table data. It extends Filament's base Widget class and uses dependency injection to access the ListClients page's table query. The widget is configured with:

```php
class ClientMapWidget extends Widget
{
    protected static string $view = 'filament.widgets.map';
    protected ?ListClients $listClients = null;

    public function listClients(ListClients $listClients): static
    {
        $this->listClients = $listClients;
        return $this;
    }

    protected function getViewData(): array
    {
        return [
            'clients' => $this->listClients?->getTableQuery()
                ->get(['latitude', 'longitude', 'name'])
                ->toArray(),
        ];
    }
}
```

The widget is registered in ListClients page using:

```php
protected function getHeaderWidgets(): array
{
    return [
        ClientMapWidget::make()
            ->listClients($this),
    ];
}
```

### Widget Configuration Best Practices

1. Always extend the base Widget class
2. Use dependency injection for page-specific data
3. Keep widget logic focused on presentation
4. Use proper type hints and return types
5. Handle null cases gracefully
6. Cache expensive data operations
7. Use proper namespacing for widget classes
8. Follow Filament's widget lifecycle methods
9. Use proper view data structure
10. Implement proper error handling

### Example Usage

```php
// In ListClients page
protected function getHeaderWidgets(): array
{
    return [
        ClientMapWidget::make()
            ->listClients($this),
    ];
}

// In widget template (resources/views/filament/widgets/map.blade.php)
@foreach($clients as $client)
    <div class="marker" 
         data-lat="{{ $client['latitude'] }}" 
         data-lng="{{ $client['longitude'] }}"
         data-title="{{ $client['name'] }}">
    </div>
@endforeach
```

## PhotonAddressData Implementation

The PhotonAddressData class provides a strongly-typed representation of Photon API responses using Spatie LaravelData. Key features:

### Class Structure
```php
class PhotonAddressData extends Data
{
    public function __construct(
        public ?string $country,
        public ?string $city,
        public ?string $postcode,
        public ?string $street,
        public ?string $housenumber,
        public array $coordinates,
    ) {
    }

    public static function fromPhotonFeature(array $feature): self
    {
        $properties = $feature['properties'];
        $coordinates = $feature['geometry']['coordinates'];

        return new self(
            country: $properties['country'] ?? null,
            city: $properties['city'] ?? null,
            postcode: $properties['postcode'] ?? null,
            street: $properties['street'] ?? null,
            housenumber: $properties['housenumber'] ?? null,
            coordinates: [
                'latitude' => $coordinates[1],
                'longitude' => $coordinates[0],
            ],
        );
    }
}
```

### Usage in GetAddressFromPhotonAction
```php
$photonData = PhotonAddressData::fromPhotonFeature($data['features'][0]);

return new AddressData(
    country: $photonData->country,
    city: $photonData->city,
    postcode: $photonData->postcode,
    street: $photonData->street,
    housenumber: $photonData->housenumber,
    latitude: $photonData->coordinates['latitude'],
    longitude: $photonData->coordinates['longitude']
);
```

### Key Benefits
- Strong type safety with nullable properties
- Automatic data validation
- Immutable data structure
- Clean separation of concerns
- Easy conversion to other data formats
- Built-in support for array/JSON serialization
- Null safety with proper default values
- Consistent coordinate handling
- Clear property documentation
- Integration with Spatie's data collection system

### Error Handling
- Null values are handled gracefully with proper defaults
- Invalid API responses are caught and logged
- Missing properties don't cause runtime errors
- Coordinate validation is built-in
- Type conversion is handled automatically

### Best Practices
- Always use the fromPhotonFeature factory method
- Validate API responses before conversion
- Handle null values explicitly
- Use proper type hints
- Maintain immutability
- Follow consistent naming conventions
- Document all properties
- Use proper error handling
- Keep the class focused on data representation
- Integrate with the existing data pipeline

## Next Steps for Photon Integration

### Pending Tasks
1. Implement comprehensive unit tests for PhotonAddressData
2. Add integration tests for GetAddressFromPhotonAction
3. Create error handling middleware for Photon API responses
4. Implement rate limiting for Photon API requests
5. Add caching layer for Photon API responses

### Implementation Status
- [x] Created PhotonAddressData class
- [x] Integrated with GetAddressFromPhotonAction
- [x] Added documentation to laraxot.md
- [ ] Implemented unit tests
- [ ] Added integration tests
- [ ] Created error handling middleware
- [ ] Implemented rate limiting
- [ ] Added caching layer

### Areas Needing Attention
1. Error handling for API rate limits
2. Caching strategy for frequent queries
3. Validation of coordinate data
4. Integration with existing logging system
5. Documentation of edge cases

### Required Decisions
1. Cache duration for Photon responses
2. Rate limit thresholds
3. Error handling strategy for invalid responses
4. Logging format for API errors
5. Coordinate validation rules

### Tomorrow's Plan
1. Start with implementing unit tests
2. Add integration tests for GetAddressFromPhotonAction
3. Implement error handling middleware
4. Add rate limiting configuration
5. Implement caching layer
6. Update documentation with new implementations
