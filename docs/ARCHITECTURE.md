# Architettura del Sistema

## Overview
Il sistema è costruito su Laravel utilizzando un'architettura modulare. Ogni modulo è indipendente e ha responsabilità specifiche.

## Pattern Architetturali
1. **Action Pattern**: Ogni operazione complessa è incapsulata in una classe Action
2. **Repository Pattern**: Accesso ai dati attraverso repository
3. **Service Layer**: Logica di business in servizi dedicati

## Moduli

### TechPlanner
- **Responsabilità**: Core business logic
- **Dipendenze**: Geo, User, Activity
- **Pattern**: CQRS per la gestione dei comandi

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