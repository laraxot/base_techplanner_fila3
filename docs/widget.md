# TechPlanner Map Widget Documentation

## Overview
The MapWidget provides a map visualization for the TechPlanner module.

## File Structure
```
Modules/TechPlanner/
├── app/
│   └── Filament/
│       └── Widgets/
│           └── MapWidget.php
└── resources/
    └── views/
        └── filament/
            └── widgets/
                └── map.blade.php
```

## Implementation

### Widget Class
The widget class should be placed in the correct namespace:
```php
namespace Modules\TechPlanner\Filament\Widgets;
```

### View Resolution
The view name should match the module name:
```php
protected static string $view = 'techplanner::filament.widgets.map';
```

### Usage in Pages
To use the widget in a Filament page:
```php
protected function getHeaderWidgets(): array
{
    return [
        MapWidget::class,
    ];
}
```

## Troubleshooting

### Common Issues
1. Class not found:
   - Ensure the class is in the correct namespace
   - Verify autoload configuration in composer.json
   - Run `composer dump-autoload`

2. View not found:
   - Check view path matches module name
   - Ensure view file exists in resources/views
   - Verify view namespace registration

### Best Practices
1. Always use module-specific view namespace
2. Keep widget logic separate from view
3. Use typed properties and return types
4. Document widget configuration options
