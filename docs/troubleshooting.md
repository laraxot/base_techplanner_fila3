# Troubleshooting Guide

## Filament Issues

### Widget Issues
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

### XotBaseListRecords Issues
1. **Access level to getListTableColumns() must be public**
   - **Causa**: Il metodo nella classe base è public
   - **Soluzione**: Cambiare da protected a public nella classe figlia
   ```php
   public function getListTableColumns(): array
   ```

2. **getTableColumns vs getListTableColumns**
   - **Causa**: XotBaseListRecords usa getListTableColumns invece di getTableColumns
   - **Soluzione**: Usare getListTableColumns e fare l'override correttamente

## Geolocalizzazione

### API OSRM
1. **Rate Limiting**
   - L'API pubblica di OSRM ha limiti di rate
   - Considerare l'implementazione di caching per le richieste frequenti
   - Possibile soluzione: salvare i risultati nel database

2. **Errori di Connessione**
   - Gestire gracefully gli errori di rete
   - Implementato fallback a "N/D" per distanze
   - Stringa vuota per tempi di percorrenza

### Calcolo Distanze
1. **Precisione**
   - Formula di Haversine per distanze precise
   - Risultati arrotondati a 1 decimale per leggibilità
   - Possibile ottimizzazione: precalcolare per clienti frequenti

2. **Performance**
   - SQL ottimizzato per ordinamento per distanza
   - Usa indici su latitude/longitude
   - Considera materializzazione vista per grandi dataset

## Best Practices

### Sessione e Cookie
1. **Persistenza Coordinate**
   - Salvate in sessione per uso immediato
   - Cookie per persistenza 30 giorni
   - Considerare preferenze utente per durata

2. **Sicurezza**
   - Validazione coordinate input
   - Sanitizzazione prima del salvataggio
   - No dati sensibili in cookie/sessione

### UI/UX
1. **Feedback Utente**
   - Notifiche per azioni importanti
   - Indicatori di caricamento per operazioni async
   - Messaggi chiari per errori/successi

2. **Accessibilità**
   - Labels chiari per input coordinate
   - Feedback visivo per azioni
   - Supporto keyboard navigation
