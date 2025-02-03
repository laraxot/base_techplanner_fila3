# Ereditarietà delle List Pages in Filament

## XotBaseListRecords vs ListRecords

Nel nostro progetto, tutte le List Pages devono estendere `XotBaseListRecords` invece di `ListRecords`.

### Struttura Corretta
```php
use Modules\Xot\Filament\Resources\Pages\XotBaseListRecords;

class ListClients extends XotBaseListRecords
{
    // ...
}
```

### Struttura Non Corretta (Da Evitare)
```php
use Filament\Resources\Pages\ListRecords;

class ListClients extends ListRecords
{
    // ...
}
```

### Importante
1. Non utilizzare mai `...parent::getListTableColumns()` nelle classi che estendono `XotBaseListRecords`
2. Implementare sempre tutte le colonne necessarie direttamente nel metodo `getListTableColumns()`
3. `XotBaseListRecords` fornisce funzionalità aggiuntive specifiche per il nostro progetto

### Motivazione
- `XotBaseListRecords` è una classe base personalizzata che include funzionalità specifiche per il nostro progetto
- Mantiene la coerenza in tutte le List Pages
- Fornisce metodi e comportamenti standardizzati per tutte le liste
- Facilita la manutenzione e l'aggiornamento del codice

### Note
- Tutte le List Pages esistenti devono essere migrate per utilizzare `XotBaseListRecords`
- Quando si crea una nuova List Page, utilizzare sempre `XotBaseListRecords` come classe base
- Non utilizzare metodi o proprietà specifiche di `ListRecords` che potrebbero non essere disponibili in `XotBaseListRecords`
