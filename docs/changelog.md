# Changelog

## Formato
Ogni voce del changelog deve seguire questo formato:
```
## [YYYY-MM-DD]
### Aggiunto
- Nuove funzionalità

### Modificato
- Modifiche a funzionalità esistenti

### Risolto
- Bug fix e correzioni

### Documentazione
- Aggiornamenti alla documentazione
```

## [2024-02-03]
### Aggiunto
- Creata classe `ViewNotification` per la visualizzazione dei dettagli delle notifiche
- Aggiunti file di traduzione per il modulo User:
  - `features.php` in italiano e inglese con traduzioni per campi, placeholder e testi di aiuto
  - `social_providers.php` in italiano e inglese con traduzioni per campi, placeholder e testi di aiuto
  - `tenants.php` in italiano e inglese con traduzioni per campi, placeholder e testi di aiuto

### Modificato
- Corretto `SnapshotResource`: sostituito metodo `form()` con `getFormSchema()`
- Corretto `StoredEventResource`: sostituito metodo `form()` con `getFormSchema()`
- Verificato che `ActivityResource` ha già l'implementazione corretta di `getFormSchema()`
- Corretto `NotificationResource`: sostituito estensione `Resource` con `XotBaseResource` e aggiunto `getFormSchema()`
- Rimosso import non necessario di `Resource` da `StoredEventResource`
- Rimosso metodo `form()` ridondante da `FailedJobResource` (già aveva `getFormSchema()`)
- Rimosso `$navigationIcon` e `getNavigationGroup()` da `NotificationResource` (gestiti da `XotBaseResource`)
- Rimosso `$navigationIcon` da `FailedJobResource` (gestito da `XotBaseResource`)
- Corretto `ViewNotification`: sostituito estensione `ViewRecord` con `XotBaseViewRecord`
- Corretto `DeviceResource` nel modulo User:
  - Rimosso `$navigationIcon` (gestito da `XotBaseResource`)
  - Sostituito metodo `form()` con `getFormSchema()`
  - Implementato schema del form completo con tutti i campi del modello Device
  - Migliorato campo languages usando TagsInput invece di Select
- Corretto `FeatureResource` nel modulo User:
  - Rimosso metodo `form()` ridondante (già presente `getFormSchema()`)
  - Rimosso `$navigationIcon` (gestito da `XotBaseResource`)
  - Rimosso import non necessario di `Filament\Forms\Form`
  - Rimossi i metodi `->label()` in favore delle traduzioni automatiche
  - Aggiunti riferimenti alle traduzioni per placeholder e helper text
- Corretto `SocialProviderResource` nel modulo User:
  - Rimosso metodo `form()` ridondante
  - Rimosso `$navigationIcon` (gestito da `XotBaseResource`)
  - Implementato schema del form completo con tutti i campi del modello
  - Aggiunti riferimenti alle traduzioni per placeholder e helper text
  - Migliorata gestione dei campi json usando KeyValue
  - Aggiunto supporto per SVG con Textarea a larghezza piena
- Corretto `TenantResource` nel modulo User:
  - Rimosso metodo `form()` ridondante
  - Rimosso codice commentato non più necessario
  - Implementato schema del form completo con tutti i campi del modello
  - Aggiunta gestione automatica di slug e domain dal nome
  - Aggiunti riferimenti alle traduzioni per placeholder e helper text
  - Migliorata organizzazione dei campi in una sezione a due colonne
  - Aggiunta validazione e configurazione avanzata per ogni campo

### Verificato
- Modulo TechPlanner: tutte le risorse (`PhoneCallResource`, `ClientResource`, `DeviceResource`) estendono correttamente `XotBaseResource`
- Modulo Tenant: `DomainResource` estende correttamente `XotBaseResource`
- Modulo Media: tutte le risorse (`MediaResource`, `MediaConvertResource`, `TemporaryUploadResource`) estendono correttamente `XotBaseResource`
- Modulo Job: tutte le risorse estendono correttamente `XotBaseResource`
- Modulo Lang: nessuna risorsa Filament presente

### Documentazione
- Creato file changelog.md per tracciare le modifiche al progetto
- Implementata strategia di documentazione basata su documentation_strategy.md
- Creato file technical_notes.md con chiarimenti su XotBaseResource e gestione dei form
- Corretta documentazione: le classi che estendono XotBaseResource devono implementare getFormSchema() e NON form()
- Aggiornata documentazione: le classi che estendono XotBaseResource non devono definire $navigationIcon o getNavigationGroup()
- Aggiunta documentazione sull'uso corretto di XotBaseViewRecord per le pagine di visualizzazione

## Note
- Ogni modifica deve essere documentata immediatamente
- Includere riferimenti a ticket/issues correlati quando possibile
- Mantenere le descrizioni concise e informative
- Aggiungere dettagli tecnici quando rilevanti 