# Architettura Modulare

## Filosofia
- Ogni modulo è una unità funzionale indipendente
- I moduli comunicano attraverso interfacce ben definite
- Separazione delle responsabilità (SRP)
- DRY (Don't Repeat Yourself)

### Modulo Geo
Il modulo Geo è un esempio perfetto di questa filosofia:
- Centralizza tutte le operazioni geografiche
- Offre Actions riutilizzabili
- Gestisce multiple fonti di dati con fallback
- Incapsula la complessità dei servizi esterni 