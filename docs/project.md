# Specifiche del Progetto

> **REGOLA FONDAMENTALE**: In questa directory `/var/www/html/base_techplanner_fila3/docs` è severamente vietato creare nuovi file o cartelle. Sono permessi solo due file: `project.md` (questo file) per le specifiche del progetto e `laraxot.md` per le specifiche generiche dello strumento. Questi file devono essere continuamente letti, analizzati e aggiornati.

> **DOCUMENTAZIONE MODULI**: Ogni modulo deve avere la propria cartella `docs` con la documentazione specifica. Prima di accedere o modificare qualsiasi file del modulo, è obbligatorio consultare il `composer.json` del modulo stesso per verificare i percorsi corretti e i namespace.

## Panoramica
TechPlanner è un'applicazione basata su Laravel per la gestione dei clienti con funzionalità di geolocalizzazione e calcolo distanze.

## Struttura del Progetto
### Directory Principali
- `laravel/`: Core dell'applicazione Laravel
- `public_html/`: Directory pubblica per il web server
- `bashscripts/`: Script di utilità per gestione progetto
- `docs/`: Documentazione e configurazioni
- `cache/`: File di cache temporanei

### Stack Tecnologico
- Laravel (Framework PHP)
- Apache con SSL
- TailwindCSS per lo styling
- PHPUnit per testing
- OSRM per calcolo percorsi
- Filament 3 per admin panel

## Configurazione
### Requisiti di Sistema
- PHP 8.x
- Apache con mod_ssl
- Composer
- Git

### Setup Iniziale
1. Configurare virtual host con `techplanner.local.conf`
2. Generare e installare certificati SSL
3. Eseguire setup Composer
4. Configurare TailwindCSS
5. Popolare le coordinate dei clienti

### Configurazioni Server
- Server Name: techplanner.local
- SSL abilitato con certificati self-signed
- Log files:
  - Error log: `/var/www/html/_bases/base_techplanner_fila3/error.log`
  - Access log: `/var/www/html/_bases/base_techplanner_fila3/access.log`

## Funzionalità Core
### Geolocalizzazione
- Widget per impostare coordinate di riferimento
- Calcolo distanza in km da punto di riferimento
- Calcolo tempo di percorrenza in auto (via OSRM API)
- Ordinamento clienti per distanza
- Persistenza coordinate in sessione e cookie (30 giorni)

### Gestione Clienti
- Lista clienti con distanze
- Ordinamento per distanza
- Azioni bulk per gestione coordinate

## Database
### Struttura
- Tabelle clienti con campi per coordinate
- Ottimizzazione SQL per calcoli geografici
- Indici su latitude/longitude

## Testing
- Framework: PHPUnit
- Test automatizzati per:
  - Calcolo distanze
  - Gestione coordinate
  - API OSRM
  - Widget Filament

## Punti di Attenzione
- Coordinate dei clienti devono essere popolate
- OSRM API richiede connessione internet
- Rate limiting possibile su OSRM API pubblica
- Gestione certificati SSL self-signed 