# Scripts Reference Guide

## Git Management Scripts

### Repository Organization
- `git_change_org.sh`: Gestione organizzazione repository
- `git_pull_org.sh`: Pull da organizzazione
- `git_push_org.sh`: Push verso organizzazione
- `git_up.sh`: Aggiornamento repository
- `git_up_noai.sh`: Aggiornamento repository senza AI
- `git_up_oco.sh`: Aggiornamento specifico OCO

### Maintenance
- `git_delete_history_recursive.sh`: Pulizia storia Git
- `git_prune.sh`: Pulizia riferimenti remoti
- `git_rebase.sh`: Rebase automatizzato
- `git_rebase_noai.sh`: Rebase senza AI
- `sync_submodules.sh`: Sincronizzazione submoduli

## Development Setup
- `composer_init.sh`: Inizializzazione ambiente Composer
- `get_composer.sh`: Download Composer

## Backup and Sync
- `backup.sh`: Script di backup
- `copy_to_mono.sh`: Copia verso ambiente mono

## Configuration Files
- `composer.json`: Configurazione dipendenze PHP
- `package.json`: Configurazione dipendenze Node.js
- `phpunit.xml`: Configurazione testing
- `postcss.config.js`: Configurazione PostCSS
- `tailwind.config.js`: Configurazione TailwindCSS
- `rector.php`: Configurazione Rector per refactoring PHP

## Note Importanti
1. Gli script di gestione Git sono divisi in due categorie:
   - Standard: operazioni base
   - NoAI: versioni senza integrazione AI

2. La sincronizzazione dei submoduli è gestita separatamente con `sync_submodules.sh`

3. Il setup dello sviluppo richiede l'esecuzione di:
   ```bash
   ./get_composer.sh
   ./composer_init.sh
   ```

4. Per il backup e la sincronizzazione, usare:
   ```bash
   ./backup.sh
   ./copy_to_mono.sh
   ```
