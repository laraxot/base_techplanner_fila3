# Documentazione Laraxot

> **REGOLA FONDAMENTALE**: In questa directory `/var/www/html/base_techplanner_fila3/docs` è severamente vietato creare nuovi file o cartelle. Sono permessi solo due file: `project.md` per le specifiche del progetto e `laraxot.md` (questo file) per le specifiche generiche dello strumento. Questi file devono essere continuamente letti, analizzati e aggiornati.

> **DOCUMENTAZIONE MODULI**: Ogni modulo deve avere la propria cartella `docs` con la documentazione specifica. Prima di accedere o modificare qualsiasi file del modulo, è obbligatorio consultare il `composer.json` del modulo stesso per verificare i percorsi corretti e i namespace. Il file principale di documentazione deve essere nominato `module_<nome_modulo_in_snake_case>.md` (esempio: per il modulo TechPlanner il file sarà `module_tech_planner.md`).

## Introduzione
Laraxot è un framework basato su Laravel che fornisce funzionalità estese per la creazione di applicazioni web modulari.

## Funzionalità Core
### Gestione Moduli
- Sistema modulare estensibile
- Caricamento dinamico dei moduli
- Gestione dipendenze tra moduli

### Sistema di Permessi
- Gestione ruoli e permessi
- ACL granulare
- Integrazione con Laravel Gate

### Gestione Temi
- Sistema di theming flessibile
- Supporto TailwindCSS
- Override template per modulo

### Sistema di Cache
- Cache intelligente per performance
- Invalidazione selettiva
- Supporto Redis/Memcached

## Convenzioni
### Struttura delle Cartelle
- `/laravel`: Core framework
- `/Modules`: Moduli dell'applicazione
  - Ogni modulo deve avere:
    - `/docs`: Documentazione specifica del modulo
    - `composer.json`: Definizione namespace e percorsi
- `/Resources`: Asset e viste
- `/Config`: Configurazioni

### Naming Conventions
- PSR-4 per l'autoloading
- Convenzioni Laravel standard
- Prefissi per moduli custom
- Namespace definiti nel composer.json di ogni modulo

### Best Practices
- Separazione logica business/presentazione
- Utilizzo dei service provider
- Pattern repository per accesso dati
- Consultare sempre composer.json prima di modificare i file
- Mantenere aggiornata la documentazione del modulo

## Componenti
### Form Builder
- Creazione form dinamici
- Validazione integrata
- Supporto campi custom

### Grid System
- Layout responsive
- Componenti Filament
- Personalizzazione colonne

### Media Manager
- Gestione file e media
- Upload multiplo
- Processamento immagini

### Sistema di Notifiche
- Notifiche real-time
- Code e job asincroni
- Integrazione email

## Troubleshooting
### Problemi Comuni
#### Widget Issues
- Percorsi viste non corretti
  - Soluzione: Spostare in `resources/views/filament/widgets/`
  - Aggiornare percorsi a `techplanner::filament.widgets.*`

#### XotBaseListRecords Issues
- Access level methods
  - Usare `public` per override
  - Rispettare nomenclatura metodi

#### API e Performance
- Rate limiting
- Caching risultati
- Ottimizzazione query

### Debug
- Log dettagliati
- Strumenti debug Laravel
- Profiling applicazione

## Aggiornamenti
### Procedura
1. Backup dati
2. Aggiornamento dipendenze
3. Migrazione database
4. Clear cache

### Breaking Changes
- Documentati nel changelog
- Procedure migrazione
- Compatibilità versioni

### Changelog
- Versionamento semantico
- Note di rilascio
- Deprecation notices 