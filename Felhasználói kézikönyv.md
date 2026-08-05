# Felhasználói kézikönyv

## Webalkalmazás indítása
1. Töltse le vagy klónozza a repositoryt.
2. A gyökérmappában az alábi parancsot kell lefuttatni: `docker compose up --build`
3. Az oldal elérhetővé válik itt: http://localhost

## Parkolóhelyek listázása
Az összes parkolóhely megjelenik az index.php oldalon a Helyek blokkban.

## Foglalások listázása
Alap helyzetben az összes parkolóhely megjelenik az index.php oldalon a Foglalások blokkban.
Ez szűrhető egy mező kitöltésével, ami a parkolóhely nevét várja.
Szűrés után csak a megadott helyhez tartozó foglalások jelennek meg.
Ha nem létező hely kerül megadásra, arról az oldal tájékoztatja a felhasználót.
A szűrésnél elhelyezett Összes gomb megnyomásával eltávolításra kerül a szűrés.

## Foglalás törlése
A foglalások listázásánál minden elem mellett megjelenik egy Törlés gomb.
Ennek a megnyomásával törölhető az adott foglalás.
Ha az ID érvénytelen vagy már törölve lett, azt a "Nincs érintett sor." üzenet jelzi.

## Foglalás rögzítés
A foglalás létrehozásához 4 adatra van szüség.
1. parkolóhely
2. foglaló neve
3. kezdeti időpont
4. befejezési időpont
Az időpontokat két-két mezőben kell beállítani a dátum, valamit óra és perc megadásához.
### Kritériumok
- csak létező parkolóhely foglalható
- kötelező egy legalább 3 karakter hosszú név megadása
- kezdeti és befejezési idő szükséges
- egy időben azonos helyen nem szerepelhet több foglalás
- a befejezési idő nem lehet előbb a kezdetinél
