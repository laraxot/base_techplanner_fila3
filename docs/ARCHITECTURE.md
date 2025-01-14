# Architettura del Progetto

## Modularità
- **Descrizione**: Il progetto è suddiviso in moduli chiari, ciascuno con una responsabilità specifica.
- **Moduli Principali**:
  - **Geo**: Gestisce tutte le operazioni geografiche.
  - **TechPlanner**: Gestisce la logica di pianificazione tecnica.
- **Interfacce**: I moduli comunicano tramite interfacce ben definite.

## Pattern di Progettazione
- **MVC**: Utilizzato per separare la logica di business dalla presentazione.
- **Repository**: Utilizzato per l'accesso ai dati.
- **Actions**: Utilizzato per operazioni specifiche e riutilizzabili.

## Scalabilità
- **Descrizione**: L'architettura supporta l'aggiunta di nuovi moduli senza modifiche significative al codice esistente. 