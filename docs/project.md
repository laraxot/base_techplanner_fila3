# Documentazione del Progetto TechPlanner

## Indice
1. [Architettura](#architettura)
2. [Moduli](#moduli)
3. [Processo di Sviluppo](#processo-di-sviluppo)
4. [Strumenti di Sviluppo](#strumenti-di-sviluppo)
5. [Analisi Statica](#analisi-statica)
6. [Troubleshooting](#troubleshooting)
7. [Risoluzione Errori](#risoluzione-errori)

## Architettura
Il sistema è costruito su Laravel utilizzando un'architettura modulare. Ogni modulo è indipendente e ha responsabilità specifiche.

### Struttura del Progetto
- `laravel/`: Core dell'applicazione Laravel
- `public_html/`: Directory pubblica per il web server
- `bashscripts/`: Script di utilità per gestione progetto
- `docs/`: Documentazione e configurazioni
- `cache/`: File di cache temporanei

### File Chiave
- `docs/techplanner.local.conf`: Configurazione Apache del virtual host
- `docs/certificate.md`: Istruzioni per la configurazione SSL
- `.gitmodules`: Configurazione dei submoduli Git

### Configurazioni
- Server Name: techplanner.local
- SSL abilitato con certificati self-signed
- Log files:
  - Error log: `/var/www/html/_bases/base_techplanner_fila3/error.log`
  - Access log: `/var/www/html/_bases/base_techplanner_fila3/access.log`

### Pattern Architetturali
1. **Action Pattern**: Ogni operazione complessa è incapsulata in una classe Action
2. **Repository Pattern**: Accesso ai dati attraverso repository
3. **Service Layer**: Logica di business in servizi dedicati

## Moduli

### TechPlanner
- **Responsabilità**: Core business logic
- **Dipendenze**: Geo, User, Activity
- **Pattern**: CQRS per la gestione dei comandi
- **Funzionalità Principali**:
  1. Gestione Clienti
  2. Pianificazione Appuntamenti
  3. Gestione Risorse

### Geo
- **Responsabilità**: Funzionalità geografiche
- **Servizi Esterni**: 
  - Google Maps
  - OpenStreetMap
  - Here Maps
- **Ottimizzazioni**:
  - Caching delle coordinate
  - Batch processing
  - Query geografiche ottimizzate
- **Actions Disponibili**:
  - `GetCoordinatesFromMultipleServicesAction`: Ottiene coordinate da diversi servizi di geocoding
  - `CalculateDistanceAction`: Calcola la distanza tra due punti
  - `CalculateTravelTimeAction`: Stima il tempo di percorrenza tra due punti

### Implementazione Geolocalizzazione
- Coordinate salvate in sessione e cookie (30 giorni)
- Calcolo distanza con formula di Haversine
- Integrazione con OSRM per tempi di percorrenza
- Widget Filament per gestione coordinate
- Colonna distanza/tempo nella lista clienti
- Ottimizzazione SQL per ordinamento per distanza

### User
- **Responsabilità**: Autenticazione e autorizzazione
- **Features**:
  - Multi-tenancy
  - Ruoli e permessi
  - Profili utente

### Activity
- **Responsabilità**: Logging e audit
- **Features**:
  - Activity log
  - Audit trail
  - Event sourcing

### Gdpr
- **Responsabilità**: Conformità GDPR
- **Features**:
  - Gestione consensi
  - Privacy policy
  - Data retention

## Processo di Sviluppo

### Workflow Git
- **Branch Strategy**:
  - `main`: Produzione
  - `develop`: Sviluppo principale
  - `feature/*`: Nuove funzionalità
  - `bugfix/*`: Correzioni bug
  - `hotfix/*`: Fix urgenti in produzione

### Commit Convention
```
<tipo>(<scope>): <descrizione>

[corpo]

[footer]
```

**Tipi**:
- `feat`: Nuova funzionalità
- `fix`: Correzione bug
- `docs`: Documentazione
- `style`: Formattazione
- `refactor`: Refactoring
- `test`: Test
- `chore`: Manutenzione

### Testing
- **Unit Test**:
  - Ogni Action deve avere i suoi test
  - Coverage minimo: 80%
  - Naming convention: `NomeClasseTest`
- **Feature Test**:
  - Test end-to-end per funzionalità critiche
  - Test di integrazione tra moduli

### Code Review
- **Checklist**:
  1. Conformità agli standard PSR
  2. Presenza di test
  3. Documentazione aggiornata
  4. Performance check
  5. Security check

### Performance
- Query N+1 check
- Indici database
- Caching strategy

### Deployment
- **Staging**:
  1. Deploy automatico da `develop`
  2. Smoke test
  3. Performance test
- **Produzione**:
  1. Deploy manuale da `main`
  2. Backup pre-deploy
  3. Monitoraggio post-deploy

## Strumenti di Sviluppo

### PHPStan
- **Descrizione**: PHPStan è uno strumento di analisi statica per PHP che aiuta a identificare errori nel codice senza eseguirlo.
- **Posizione**: Configurato all'interno della cartella `laravel`.
- **Utilizzo**: Esegui `phpstan analyse` per analizzare il codice e identificare potenziali problemi.

### Altri Strumenti
- **PHPUnit**: Utilizzato per eseguire test automatizzati
- **Composer**: Gestione delle dipendenze PHP
- **Git**: Controllo versione per il codice sorgente
- **TailwindCSS**: Framework CSS per lo styling
- **Filament 3**: Admin panel framework

## Analisi Statica

### PHPStan Livello 9

#### Problemi Identificati e Risolti (19/03/2024)

1. **Incompatibilità Tipo di Ritorno in LocationMapTableWidget**
   - **File**: `Modules/Geo/app/Filament/Widgets/LocationMapTableWidget.php`
   - **Errore**: Il metodo `getData()` ritornava `Collection` ma doveva ritornare `array`
   - **Soluzione**: Modificato il metodo per ritornare direttamente un array
   ```php
   public function getData(): array
   {
       $locations = $this->getRecords();
       $data = [];
       // ... logica di trasformazione ...
       return $data;
   }
   ```

2. **Form Type Mismatch in LocationResource**
   - **File**: `Modules/Geo/app/Filament/Resources/LocationResource.php`
   - **Errore**: Incompatibilità tra i tipi di Form nelle classi
   - **Soluzione**: 
     - Aggiornato l'import per usare `Filament\Forms\Form`
     - Corretto il tipo di ritorno del metodo `form()`
     - Aggiornati i campi del form per una migliore tipizzazione

3. **Classi Mancanti per LocationResource**
   - **Errore**: Classi delle pagine non trovate
   - **Soluzione**: Create le seguenti classi:
     - `ListLocations`: Per la visualizzazione della lista
     - `CreateLocation`: Per la creazione di nuovi record
     - `EditLocation`: Per la modifica dei record
     - `ViewLocation`: Per la visualizzazione dei dettagli

#### Miglioramenti Implementati
1. **Tipizzazione Più Forte**
   - Aggiunta di type hints espliciti
   - Documentazione PHPDoc completa
   - Utilizzo di tipi di ritorno stretti

2. **Struttura Modulare**
   - Separazione chiara delle responsabilità
   - Estensione corretta delle classi base
   - Mantenimento della coerenza tra i moduli

3. **Documentazione**
   - Aggiornata la documentazione delle classi
   - Aggiunti esempi di utilizzo
   - Documentate le dipendenze tra moduli

#### Prossimi Passi
1. [ ] Completare l'analisi del modulo TechPlanner
2. [ ] Implementare test unitari per le nuove classi
3. [ ] Verificare la copertura del codice
4. [ ] Aggiornare la documentazione API

## Troubleshooting

### Filament Issues

#### Widget Issues
1. **Unable to find component: [modules.tech-planner.filament.widgets.coordinates-widget]**
   - **Causa**: Percorso della vista del widget non corretto
   - **Soluzione**: 
     - Spostare la vista in `resources/views/filament/widgets/`
     - Aggiornare il percorso nel widget a `techplanner::filament.widgets.coordinates-widget`

2. **Method notify does not exist**
   - **Causa**: Cambio API in Filament 3
   - **Soluzione**: Usare il nuovo sistema di notifiche
   ```php
   Notification::make()
       ->warning()
       ->title('Titolo')
       ->body('Messaggio')
       ->send();
   ```

#### XotBaseListRecords Issues
1. **Access level to getListTableColumns() must be public**
   - **Causa**: Il metodo nella classe base è public
   - **Soluzione**: Cambiare da protected a public nella classe figlia
   ```php
   public function getListTableColumns(): array
   ```

2. **getTableColumns vs getListTableColumns**
   - **Causa**: XotBaseListRecords usa getListTableColumns invece di getTableColumns
   - **Soluzione**: Usare getListTableColumns e fare l'override correttamente

### Geolocalizzazione Issues

#### API OSRM
1. **Rate Limiting**
   - L'API pubblica di OSRM ha limiti di rate
   - Considerare l'implementazione di caching per le richieste frequenti
   - Possibile soluzione: salvare i risultati nel database

2. **Errori di Connessione**
   - Gestire gracefully gli errori di rete
   - Implementato fallback a "N/D" per distanze
   - Stringa vuota per tempi di percorrenza

#### Calcolo Distanze
1. **Precisione**
   - Formula di Haversine per distanze precise
   - Risultati arrotondati a 1 decimale per leggibilità
   - Possibile ottimizzazione: precalcolare per clienti frequenti

2. **Performance**
   - SQL ottimizzato per ordinamento per distanza
   - Usa indici su latitude/longitude
   - Considera materializzazione vista per grandi dataset

## Risoluzione Errori

### TypeError in ListClients (Risolto)
**Data**: 2024-03-19

**Errore**:
```php
TypeError: Modules\TechPlanner\Filament\Resources\ClientResource\Pages\ListClients::closure(): 
Argument #2 ($action) must be of type Modules\Geo\Actions\GetCoordinatesFromMultipleServicesAction, 
Filament\Tables\Actions\BulkAction given
```

**Causa**:
La closure nell'azione bulk stava cercando di iniettare l'action come secondo parametro, ma Filament passa automaticamente l'oggetto BulkAction come secondo parametro.

**Soluzione**:
1. Rimosso il parametro `GetCoordinatesFromMultipleServicesAction $action` dalla closure
2. Creato l'istanza dell'action usando il container di Laravel
3. Modificato il codice da:
```php
->action(function (Collection $records, GetCoordinatesFromMultipleServicesAction $action) {
```
a:
```php
->action(function (Collection $records) {
    $action = app(GetCoordinatesFromMultipleServicesAction::class);
    // resto del codice...
```

**Lezione Appresa**:
Quando si lavora con le bulk actions di Filament, è meglio utilizzare il container di Laravel per risolvere le dipendenze all'interno della closure invece di affidarsi all'injection dei parametri. 