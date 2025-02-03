# Gestione della Navigazione in Filament

## XotBaseResource e NavigationLabelTrait

Nel nostro progetto, la navigazione delle risorse Filament viene gestita attraverso il sistema di traduzione, non direttamente nel codice.

### Importante
- NON definire `protected static ?string $navigationIcon` nelle classi che estendono `XotBaseResource`
- NON definire `protected static ?string $navigationLabel` nelle classi che estendono `XotBaseResource`
- NON definire `protected static ?string $navigationGroup` nelle classi che estendono `XotBaseResource`

### Gestione Corretta
Le risorse che estendono `XotBaseResource` ereditano `NavigationLabelTrait` che gestisce:
1. Icone di navigazione
2. Label di navigazione
3. Gruppi di navigazione
4. Ordinamento della navigazione

### File di Traduzione
Le configurazioni di navigazione devono essere definite nei file di traduzione:

```php
// lang/it/resource_name.php
return [
    'navigation' => [
        'icon' => 'heroicon-o-users',
        'group' => 'Sistema',
        'label' => 'Utenti',
        'sort' => 1,
    ],
];
```

### Icone Disponibili
Le icone devono essere specificate nel file di traduzione e possono essere:
1. Heroicons (preferite)
   - heroicon-o-* (outline)
   - heroicon-s-* (solid)
2. Custom SVG registrate nel sistema

### Note Importanti
1. Le icone di default sono gestite da `NavigationLabelTrait::getNavigationIcon()`
2. Se l'icona non è trovata nel file di traduzione, viene usata l'icona di default 'heroicon-o-question-mark-circle'
3. La struttura mantiene separazione tra codice e presentazione
4. Facilita la gestione multilingua
5. Permette una gestione centralizzata della navigazione

### Best Practices
1. Sempre usare i file di traduzione per la configurazione della navigazione
2. Non sovrascrivere i metodi di NavigationLabelTrait nelle risorse
3. Mantenere coerenza nelle icone tra le diverse lingue
4. Documentare le scelte di navigazione nel file di traduzione
