# Icone di Navigazione in Filament

## Utilizzo degli SVG nelle Navigation Icons

Le icone di navigazione in Filament possono utilizzare SVG per una migliore qualità e consistenza visiva.

### Formato Corretto
```php
protected static ?string $navigationIcon = 'heroicon-o-user-group'; // Per icone Heroicon
// oppure
protected static ?string $navigationIcon = 'custom-icon-name'; // Per icone SVG personalizzate
```

### Icone Consigliate per Tipo di Risorsa

1. **Client/Utenti**
   - `heroicon-o-users`
   - `heroicon-o-user-group`
   - `heroicon-o-building-office`

2. **Appuntamenti/Eventi**
   - `heroicon-o-calendar`
   - `heroicon-o-clock`
   - `heroicon-o-calendar-days`

3. **Dispositivi/Attrezzature**
   - `heroicon-o-computer-desktop`
   - `heroicon-o-device-phone-mobile`
   - `heroicon-o-device-tablet`

4. **Uffici/Sedi**
   - `heroicon-o-building-office-2`
   - `heroicon-o-building-storefront`
   - `heroicon-o-home`

5. **Rappresentanti/Direttori**
   - `heroicon-o-identification`
   - `heroicon-o-user-circle`
   - `heroicon-o-academic-cap`

6. **Chiamate/Comunicazioni**
   - `heroicon-o-phone`
   - `heroicon-o-chat-bubble-left-right`
   - `heroicon-o-envelope`

### Note Importanti
1. Utilizzare preferibilmente le icone Heroicon outline (-o-)
2. Mantenere consistenza visiva tra risorse correlate
3. Le icone devono essere intuitive e rappresentative della risorsa
4. Evitare icone troppo simili per risorse diverse
5. Preferire icone semplici e ben riconoscibili
