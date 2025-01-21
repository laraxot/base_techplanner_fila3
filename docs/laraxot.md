<<<<<<< HEAD
# Framework Laraxot

## Indice
1. [Architettura](#architettura)
2. [Moduli Base](#moduli-base)
3. [Best Practices](#best-practices)

## Architettura
Il framework Laraxot è costruito su Laravel e segue un'architettura modulare. Ogni modulo è indipendente e può essere riutilizzato in diversi progetti.

### Pattern Architetturali
1. **Action Pattern**: Ogni operazione complessa è incapsulata in una classe Action
2. **Repository Pattern**: Accesso ai dati attraverso repository
3. **Service Layer**: Logica di business in servizi dedicati
4. **Trait**: Riutilizzo del codice attraverso traits

### Struttura dei Moduli
Ogni modulo segue una struttura standard:
```
ModuleName/
├── app/
│   ├── Actions/
│   ├── Models/
│   │   └── Traits/
│   ├── Providers/
│   └── Services/
├── config/
├── database/
│   └── migrations/
├── docs/
├── resources/
└── tests/
```

## Moduli Base

### Xot
- **Responsabilità**: Core del framework
- **Features**:
  - Base classes per Actions
  - Base classes per Models
  - Base classes per Controllers
  - Traits comuni
  - Helpers e Utilities

### UI
- **Responsabilità**: Gestione dell'interfaccia utente
- **Features**:
  - Componenti Blade
  - Livewire Components
  - Filament Resources
  - Theme Management

### Activity
- **Responsabilità**: Logging e audit
- **Features**:
  - Activity Log
  - Audit Trail
  - Event Sourcing

### Lang
- **Responsabilità**: Internazionalizzazione
- **Features**:
  - Gestione traduzioni
  - Language switcher
  - Auto-translation

## Best Practices

### Sviluppo Moduli
1. **Naming Conventions**:
   - Nomi dei moduli in PascalCase
   - Nomi delle classi in PascalCase
   - Nomi dei metodi in camelCase
   - Nomi delle variabili in camelCase

2. **Struttura delle Actions**:
   ```php
   class DoSomethingAction
   {
       public function execute($param)
       {
           // Logica dell'action
       }
   }
   ```

3. **Struttura dei Traits**:
   ```php
   trait SomeTrait
   {
       // Metodi e proprietà del trait
   }
   ```

### Testing
1. **Unit Test**:
   - Test per ogni Action
   - Test per ogni Service
   - Test per ogni Model

2. **Feature Test**:
   - Test end-to-end
   - Test di integrazione

### Documentazione
1. **PHPDoc**:
   - Documentare tutte le classi
   - Documentare tutti i metodi pubblici
   - Includere tipi di parametri e return type

2. **README**:
   - Descrizione del modulo
   - Istruzioni di installazione
   - Esempi di utilizzo

### Performance
1. **Query Optimization**:
   - Eager loading per relazioni
   - Indici appropriati
   - Query builder ottimizzato

2. **Caching**:
   - Cache per query frequenti
   - Cache per dati statici
   - Cache per view 
=======
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
>>>>>>> origin/dev
