<?php
return array (
  'seo' =>
  array (
    'upload' => 'Nadzorna ploča - Učitaj CSV datoteku - :site_name',
    'csv-data-index' => 'Nadzorna ploča - Povijest prijenosa CSV-a - :site_name',
    'csv-data-edit' => 'Nadzorna ploča - Raščlanjivanje CSV podataka - :site_name',
    'item-index' => 'Nadzorna ploča - Uvoz unosa - :site_name',
    'item-edit' => 'Nadzorna ploča - Uredi uvoz uvoza - :site_name',
  ),
  'alert' =>
  array (
    'upload-success' => 'Datoteka je uspješno prenesena',
    'upload-empty-file' => 'Prenesena datoteka ima prazan sadržaj',
    'fully-parsed' => 'CSV datoteka je u potpunosti raščlanjena, ne može se ponovno raščlaniti',
    'parsed-success' => 'Podaci CSV datoteke uspješno su raščlanjeni na privremenu bazu podataka popisa, idite na Izbornik bočne trake> Alati> Uvoznik> Unos da biste započeli konačni uvoz',
    'csv-file-deleted' => 'CSV datoteka je izbrisana iz spremišta poslužiteljske datoteke',
    'import-item-updated' => 'Uvoz podataka o popisu uspješno je ažuriran',
    'import-item-deleted' => 'Uvoz podataka o popisu uspješno je izbrisan',
    'import-process-success' => 'Podaci o popisu uspješno su uvezeni na popis web stranica',
    'import-process-error' => 'Došlo je do pogreške prilikom obrade uvoza, za detalje provjerite zapisnik pogrešaka',
    'import-all-process-completed' => 'Uvoz svih uvrštenih procesa završen',
    'import-item-cannot-edit-success-processed' => 'Ne možete uređivati podatke o uvozu koji su uspješno uvezeni',
    'import-process-completed' => 'Postupak uvoza završen',
    'import-process-no-listing-selected' => 'Odaberite popise prije početka postupka uvoza',
    'import-process-no-categories-selected' => 'Odaberite jednu ili više kategorija prije početka postupka uvoza',
    'import-listing-process-in-progress' => 'U tijeku, pričekajte završetak',
    'delete-import-listing-process-no-listing-selected' => 'Odaberite popise prije početka postupka brisanja',
  ),
  'sidebar' =>
  array (
    'importer' => 'Uvoznik',
    'upload-csv' => 'Prenesite CSV',
    'upload-history' => 'Povijest prijenosa',
    'listings' => 'Popisi',
  ),
  'show-upload' => 'Prenesite CSV datoteku',
  'show-upload-desc' => 'Ova vam stranica omogućuje prijenos CSV datoteke i njezino raščlanjivanje na sirove podatke s popisa za uvoz u kasnijim koracima.',
  'csv-for-model' => 'CSV datoteka za',
  'csv-for-model-listing' => 'Popis',
  'choose-csv-file' => 'Odaberite datoteku',
  'choose-csv-file-help' => 'vrsta datoteke za podršku: csv, txt, maksimalna veličina: 10mb',
  'upload' => 'Učitaj',
  'csv-skip-first-row' => 'Preskoči prvi red',
  'filename' => 'Naziv datoteke',
  'progress' => 'Analizirani napredak',
  'uploaded-at' => 'Otpremljeno u',
  'model-for' => 'Model',
  'import-csv-data-index' => 'Povijest prijenosa CSV datoteka',
  'import-csv-data-index-desc' => 'Ova stranica prikazuje sve prenesene CSV datoteke i njihov raščlanjeni napredak.',
  'parse' => 'Raščlani',
  'import-csv-data-edit' => 'Analizirajte podatke CSV datoteke',
  'import-csv-data-edit-desc' => 'Ova vam stranica omogućuje raščlanjivanje podataka CSV datoteke koju ste prenijeli.',
  'start-parse' => 'Počnite raščlaniti',
  'import-csv-data-parse-error' => 'Došlo je do pogreške. Ponovo učitajte stranicu da biste nastavili raščlanjivati preostale retke.',
  'parsed-percentage' => 'raščlanjeno :parsed_count od :total_count zapisa',
  'column' => 'Stupac',
  'column-item-title' => 'naslov popisa',
  'column-item-slug' => 'popis puža',
  'column-item-address' => 'adresa s popisa',
  'column-item-city' => 'popis grada',
  'column-item-state' => 'popis država',
  'column-item-country' => 'popis zemlje',
  'column-item-lat' => 'popis lat',
  'column-item-lng' => 'popis lng',
  'column-item-postal-code' => 'popis poštanskog broja',
  'column-item-description' => 'opis popisa',
  'column-item-phone' => 'popis telefona',
  'column-item-website' => 'popis web stranica',
  'column-item-facebook' => 'popis facebook-a',
  'column-item-twitter' => 'popis twitter',
  'column-item-linkedin' => 'navođenje linkedin',
  'column-item-youtube-id' => 'popis youtube id',
  'delete-file' => 'Izbrisati dateoteku',
  'csv-file' => 'CSV datoteka',
  'import-errors' =>
  array (
    'user-not-exist' => 'Korisnik ne postoji',
    'item-status-not-exist' => 'Popis mora biti u statusu predan, objavljen ili obustavljen',
    'item-featured-not-exist' => 'Istaknuti unos mora biti da ili ne',
    'country-not-exist' => 'Država ne postoji, dodajte zemlju u Lokacija> Država> Dodaj zemlju',
    'state-not-exist' => 'Država ne postoji, dodajte državu u Lokacija> Država> Dodaj državu',
    'city-not-exist' => 'Grad ne postoji, dodajte grad u Lokacija> Grad> Dodaj grad',
    'item-title-required' => 'Naslov unosa je obavezan',
    'item-description-required' => 'Opis unosa je obavezan',
    'item-postal-code-required' => 'Potreban je poštanski broj',
    'categories-required' => 'Popis mora biti dodijeljen jednoj ili više kategorija',
    'import-item-cannot-process-success-processed' => 'Ne možete obraditi podatke o popisu za uvoz koji su uspješno uvezeni',
  ),
  'import-listing-index' => 'Uvozni popisi',
  'import-listing-index-desc' => 'Ova stranica prikazuje sve raščlanjene podatke popisa iz CSV datoteke. To su sirovi podaci s popisa, koji su spremni za uvoz na popise web stranica.',
  'import-listing-status-not-processed' => 'Nije obrađeno',
  'import-listing-status-success' => 'Obrađeno uspjehom',
  'import-listing-status-error' => 'Obrađeno s pogreškom',
  'import-listing-order-newest-processed' => 'Najnovije obrađeno',
  'import-listing-order-oldest-processed' => 'Najstarije obrađeno',
  'import-listing-order-newest-parsed' => 'Najnovije raščlanjeno',
  'import-listing-order-oldest-parsed' => 'Najstariji raščlanjeni',
  'import-listing-order-title-a-z' => 'Naslov (AZ)',
  'import-listing-order-title-z-a' => 'Naslov (ZA)',
  'import-listing-order-city-a-z' => 'Grad (AZ)',
  'import-listing-order-city-z-a' => 'Grad (ZA)',
  'import-listing-order-state-a-z' => 'Država (AZ)',
  'import-listing-order-state-z-a' => 'Država (ZA)',
  'import-listing-order-country-a-z' => 'Država (AZ)',
  'import-listing-order-country-z-a' => 'Država (ZA)',
  'select' => 'Odaberi',
  'import-listing-title' => 'Titula',
  'import-listing-city' => 'Grad',
  'import-listing-state' => 'država',
  'import-listing-country' => 'Zemlja',
  'import-listing-status' => 'Status',
  'import-listing-detail' => 'Detalj',
  'import-listing-slug' => 'Puž',
  'import-listing-address' => 'Adresa',
  'import-listing-lat' => 'Zemljopisna širina',
  'import-listing-lng' => 'Zemljopisna dužina',
  'import-listing-postal-code' => 'Poštanski broj',
  'import-listing-description' => 'Opis',
  'import-listing-phone' => 'Telefon',
  'import-listing-website' => 'Web stranica',
  'import-listing-facebook' => 'Facebook',
  'import-listing-twitter' => 'Cvrkut',
  'import-listing-linkedin' => 'LinkedIn',
  'import-listing-youtube-id' => 'YouTube Id',
  'import-listing-do-not-parse' => 'NE RAZBIJATI',
  'import-listing-source' => 'Izvor',
  'import-listing-source-csv' => 'Učitavanje CSV datoteke',
  'import-listing-error-log' => 'Zapisnik pogrešaka',
  'import-listing-edit' => 'Uredi uvoz uvoza',
  'import-listing-edit-desc' => 'Ova stranica omogućuje vam uređivanje podataka o popisu uvoza, kao i obradu pojedinačnih podataka popisa za uvoz na popis web stranica.',
  'import-listing-information' => 'Uvoz podataka o popisu',
  'choose-import-listing-preference' => 'Uvoz na popis',
  'choose-import-listing-categories' => 'Odaberite jednu ili više kategorija',
  'choose-import-listing-owner' => 'Vlasnik unosa',
  'choose-import-listing-status' => 'Status popisa',
  'choose-import-listing-featured' => 'Popis Istaknuto',
  'import-listing-button' => 'Uvezi odmah',
  'choose-import-listing-preference-selected' => 'Uvezi odabrano na popis',
  'import-listing-selected-button' => 'Uvoz odabran',
  'import-listing-selected-modal-title' => 'Uvoz odabranih popisa',
  'import-listing-selected-total' => 'Ukupno za uvoz',
  'import-listing-selected-success' => 'Uspjeh',
  'import-listing-selected-error' => 'Pogreška',
  'import-listing-per-page-10' => '10 redaka',
  'import-listing-per-page-25' => '25 redaka',
  'import-listing-per-page-50' => '50 redaka',
  'import-listing-per-page-100' => '100 redaka',
  'import-listing-per-page-250' => '250 redaka',
  'import-listing-per-page-500' => '500 redaka',
  'import-listing-per-page-1000' => '1000 redaka',
  'import-listing-select-all' => 'Odaberi sve',
  'import-listing-un-select-all' => 'Poništi odabir svih',
  'csv-parse-in-progress' => 'U tijeku je raščlanjivanje CSV datoteke, pričekajte dovršetak',
  'error-notify-modal-close-title' => 'Pogreška',
  'error-notify-modal-close' => 'Zatvoriti',
  'csv-file-upload-listing-instruction' => 'Uputa',
  'csv-file-upload-listing-instruction-columns' => 'Stupci za popis: naslov, puž (opcija), adresa (opcija), grad, država, država, geografska širina (opcija), zemljopisna dužina (opcija), poštanski broj, opis, telefon (opcija), web stranica (opcija), facebook (opcija) ), twitter (opcija), linkedin (opcija), youtube id (opcija).',
  'csv-file-upload-listing-instruction-tip-1' => 'Iako će postupak raščlanjivanja CSV datoteka pokušati najbolje pogoditi, pobrinite se da naziv grada, države i države odgovara podacima o lokaciji (bočna traka> Lokacija> država, država, grad) vašeg web mjesta.',
  'csv-file-upload-listing-instruction-tip-2' => 'Ako je vaša web lokacija domaćin zajedničkom hostingu, pokušajte svaki put prenijeti CSV datoteku s manje od 15 000 redaka kako biste izbjegli maksimalno premašeno vrijeme izvršavanja.',
  'csv-file-upload-listing-instruction-tip-3' => 'Molimo grupišite CSV datoteke po kategorijama radi praktičnosti. Na primjer, restorani u jednoj CSV datoteci pod nazivom restaurant.csv, a hoteli u drugoj CSV datoteci pod nazivom hotel.csv.',
  'import-listing-delete-selected' => 'Obriši odabrano',
  'import-listing-delete-progress' => 'Brisanje ... pričekajte',
  'import-listing-delete-progress-deleted' => 'obrisano',
  'import-listing-delete-complete' => 'Gotovo',
  'import-listing-delete-error' => 'Došlo je do pogreške. Ponovo učitajte stranicu da biste nastavili brisati preostale zapise.',
  'import-listing-import-button-progress' => 'Uvoz ... molim pričekajte',
  'import-listing-import-button-complete' => 'Gotovo',
  'import-listing-import-button-error' => 'Došlo je do pogreške. Ponovo učitajte stranicu da biste nastavili s uvozom preostalih zapisa.',
  'import-listing-markup' => 'Označavanje',
  'import-listing-markup-help' => 'Dajte neke riječi koje će se razlikovati od ostalih skupina datoteka',
  'import-listing-markup-all' => 'Sve nadoknade',
);