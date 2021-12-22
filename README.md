# cloudpbx_api_client
> Przykładowy klient API systemu CloudPBX


## General Information
- CloudPBX to zaawansowana platforma telekomunikacyjna udostępniająca wirtualne centrale dla biznesu w technologii VoIP. 
Cechą charakterystyczną systemu CloudPBX są zaawansowane możliwości przy niskich kosztach, niezawodność oraz prostota narzędzi zarządzających.

- Więcej informacji dostępnych jest na stronie https://www.cloudpbx.pl.

- Dokumentacja do API dostępna jest pod adresem https://wiki.poziom7.pl/doku.php?id=cloudpbx:apps:cloudpbx_api

## Wykorzystane technologie
- Przykładowy kod został napisany w języku PHP v7.4 z wykorzystaniem biblioteki textalk/websocket
- API wykorzystuje protokół REST do wysyłania komend i uzyskiwania danych
- API wykorzystuje protokuł WebSocket do obsługi zdarzeń

## Właściwości i cechy
- Kod klienta zawiera przykładowe wykorzystanie metod 'cdr' oraz 'record'
- Kod klienta zawiera przykład obsługi eventów zgłaszanych za pomocą protokołu WS


## Setup

- Pobierz repozytorium:
```
$ git clone https://github.com/grzegorziwaniec/cloudpbx_api_client.git
```
- Zainstaluj wymagane rozszerzenia:
```
$ composer install
```
- Utwórz plik konfiguracyjny o nazwie .env
```
API_URL=[API_URL]
API_KEY=[API_KEY]
WS_URL=[WSS_URL]
PBX_NAME=[YourPBXName]
```

Aby uzyskać niezbędne adresy i klucze skontaktuj się z działem wsparcia CloudPBX pod adresem support@cloudpbx.pl

## Wykorzystanie

Katalog 'public' zawiera dwa pliki z przykładowymi zastosowaniami interfejsów REST i WS

Plik websocket.php pokazuje możliwości wykorzystania zgłaszanych eventów poprzez wypisywanie na ekranie aktualnych zdarzeń i stanów urządzeń.
Aby uruchomić przykład WS, w linii komend wpisz 
```
 cd public/
 php ./websocket.php
```

Plik rest.php prezentuje użycie interfejsu REST 
Aby uruchomić przykład REST, w linii komend wpisz 
```
 cd public/
 php ./rest.php
```

## Wsparcie

Wsparcie w zakresie interfejsu API systemu CloudPBX: support@cloudpbx.pl

