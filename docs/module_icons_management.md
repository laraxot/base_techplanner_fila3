# Gestione delle Icone nei Moduli

## Struttura e Convenzioni

### Directory delle Icone
Le icone SVG devono essere posizionate nella seguente struttura:
```
laravel/Modules/NomeModulo/
├── resources/
    ├── svg/           # Directory per le icone SVG
    │   ├── custom/    # Icone personalizzate
    │   └── heroicons/ # Icone di Heroicons
```

### Registrazione Automatica
Le icone vengono registrate automaticamente tramite il `XotBaseServiceProvider` che:
1. Rileva la directory `svg` del modulo
2. Configura il prefisso basato sul nome del modulo in lowercase
3. Registra il set di icone in `blade-icons.sets`

### Convenzioni di Nomenclatura
- Il prefisso delle icone è il nome del modulo in minuscolo (es: 'xot' per il modulo Xot)
- I file SVG devono seguire il pattern: `nome-icona.svg`
- I nomi dei file devono essere in kebab-case

## Gestione delle Traduzioni

### Struttura dei File di Traduzione
Le icone devono essere definite nei file di traduzione specifici per ogni funzionalità:

```php
// lang/it/cache.php
return [
    'navigation' => [
        'icons' => [
            'view' => 'xot::view-cache',
            'config' => 'xot::config-cache',
            'route' => 'xot::route-cache',
            'event' => 'xot::event-cache',
        ],
    ],
];
```

### Utilizzo nelle Pagine e Risorse
```php
// Nelle pagine o risorse Filament
Action::make('view_cache')
    ->icon(__('xot::cache.navigation.icons.view'))
    ->label(__('xot::cache.pages.artisan-commands.commands.view_cache.label'));
```

## Best Practices
1. Mantenere le icone SVG ottimizzate e pulite
2. Usare nomi descrittivi e coerenti
3. Organizzare le icone in sottodirectory logiche
4. Documentare le nuove icone aggiunte
5. Non rimuovere icone esistenti senza verificare l'utilizzo
6. Definire le icone nei file di traduzione appropriati
7. Mantenere la coerenza tra i file di traduzione
8. Non duplicare le definizioni delle icone

## Importante
- Le icone devono essere definite nel file di traduzione appropriato per la funzionalità
- Non definire le stesse icone in più file di traduzione
- Utilizzare sempre le traduzioni per recuperare le icone
- Mantenere la struttura delle traduzioni coerente tra i moduli

## Esempio di Struttura Completa
```php
// lang/it/cache.php
return [
    'navigation' => [
        'icons' => [
            'view' => 'xot::view-cache',
        ],
    ],
    'pages' => [
        'artisan-commands' => [
            'commands' => [
                'view_cache' => [
                    'label' => 'Cache Views',
                    'description' => 'Genera la cache delle viste',
                ],
            ],
        ],
    ],
];
``` 