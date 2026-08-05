# Tesztelés

A teszt fájlok a `/project/tests` mappában találhatóak.
Az alkalmazás indítása után a tesztek is futtathatóak.

## Unit teszt

A project nem használ olyan komplexebb functiont, amit tesztelni lehetne unit tesztel.
Ennek oka, hogy a logikai megvalósítás, szűrés SQL-ben történik.

A `functions.php` az idő intervallumok átfedését ellenörző kódot tartalmazza, ami PHP-ban valósítja meg a valójában SQL-ben használt logikát.
Ennek tesztelésére szolgál a `test_overlap.php`.

A teszt két fixen megadott foglalás kezdeti és befejezési időpontjának összehasonlításakor, egy szitén előre megadott eredményt vár.
A konkrét teszt esetben ütközés van és azt is vár, thát teljesíti a tesztet.

## Integration teszt

Az integration teszt már az adatbázis használatát is magába foglalja.
A teszt előre megadott paraméterekkel ellenőrzi az alkalmazásban is használt SQl queryket.
A konkrét teszt sorozat: létrehoz, lekérdez, majd töröl.
Szintén átmegy a teszten.