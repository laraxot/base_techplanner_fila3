# TechPlanner Project Documentation

## Architecture Overview

The project follows a modular architecture with clear separation of concerns:

1. **Modules**:
   - Geo: Handles geolocation and mapping functionality
   - Activity: Manages user activities and logs
   - Gdpr: Implements GDPR compliance features
   - Job: Handles background jobs and queues
   - Lang: Manages language translations
   - Media: Handles file uploads and media management
   - Notify: Manages notifications system
   - Tenant: Implements multi-tenancy features
   - UI: Contains shared UI components
   - User: Manages user authentication and profiles
   - Xot: Core module with shared utilities

2. **Google Maps Integration**:
   - Uses Google Maps Geocoding API
   - Implements data validation and transformation
   - Handles API errors and exceptions
   - Provides clean interface for address processing

## Key Components

### Data Classes
- GoogleMapResponseData: Represents API response
- GoogleMapResultData: Represents individual result
- GoogleMapAddressComponentData: Represents address components
- GoogleMapGeometryData: Represents geographic data
- PhotonResponseData: Represents Photon API response
- PhotonFeatureData: Represents individual Photon feature
- PhotonPropertiesData: Represents Photon feature properties

### Photon Integration
- Uses Photon geocoding service (https://photon.komoot.io)
- Implements data validation and transformation
- Handles API errors and exceptions
- Provides clean interface for address processing
- Main action: GetAddressFromPhotonAction

### Actions
- GetAddressFromGoogleMapsAction: Main geocoding action
- ValidateAddressAction: Validates address components
- TransformAddressAction: Transforms raw data to domain model

## Error Handling
- GoogleMapsApiException: Base exception for API errors
- InvalidLocationDataException: Thrown for invalid coordinates
- MissingApiKeyException: Thrown when API key is not configured
- NoResultsFoundException: Thrown when no results are returned

## Miglioramenti Recenti
- Implementazione di un sistema di aggiornamento batch per coordinate mancanti
- Ordinamento dei clienti in base alla distanza
- Utilizzo di `phpstan` per l'analisi del codice

## Strumenti di Analisi del Codice
- `phpstan` è installato nella cartella `laravel` e può essere utilizzato per analizzare il codice a diversi livelli di rigore.
- Esempio di utilizzo:
  ```bash
  cd laravel && vendor/bin/phpstan analyse Modules --level=1
  ```
