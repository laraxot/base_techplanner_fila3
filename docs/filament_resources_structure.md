# Struttura delle Filament Resources

## XotBaseResource e Table Configuration

Le risorse che estendono `XotBaseResource` hanno una struttura specifica per la gestione delle tabelle:

### Importante
- Le risorse che estendono `XotBaseResource` **NON** devono implementare il metodo `table()` direttamente nella Resource
- Tutta la configurazione della tabella deve essere implementata nella Page "index" collegata alla risorsa
- Il metodo corretto da implementare nella Page è `getListTableColumns()`

### Esempio di Implementazione Corretta

```php
// Nel file della Resource (es: JobResource.php)
class JobResource extends XotBaseResource
{
    protected static ?string $model = Job::class;
    // ... altre configurazioni della resource
}

// Nella Page collegata (es: ListJobs.php)
class ListJobs extends XotBaseListRecords
{
    public function getListTableColumns(): array
    {
        return [
            // definizione delle colonne
        ];
    }
}
```

### Da Evitare
```php
// NON implementare questo nella Resource
public static function table(Table $table): Table
{
    // questo è sbagliato per le risorse che estendono XotBaseResource
}
```

## Motivazione
Questa struttura è stata progettata per mantenere una separazione chiara tra la definizione della risorsa e la sua presentazione nelle tabelle. Tutte le configurazioni relative alla visualizzazione della tabella devono essere gestite nella Page corrispondente.
