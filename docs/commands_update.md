# UpdateClientCoordinates Command

- **Signature**: `techplanner:clients-update-coordinates`
- **Description**: Update latitude and longitude for all clients in TechPlanner.
- **Action Execution**: Uses `app(GetCoordinatesDataByFullAddressAction::class)->execute` for fetching coordinates.
- **Error Handling**: Implements try-catch for error handling and logs errors using Laravel's Log facade.

This command is part of the TechPlanner module and follows PSR standards for naming and structure.
