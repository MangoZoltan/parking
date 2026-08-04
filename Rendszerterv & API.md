# Parkolóhely foglalás - Rendszerterv

Az oldal célja, hogy egy parkoló helyeinek foglalását lehessen menedzselni vele.
A felhasználók könnyedén választhatnak maguknak helyet, ehhez megadják saját nevük, valamint foglalásuk kezdeti és befejezési idejét.
Ezen foglalások listázhatóak egyben vagy parkolóhely szerint egyaránt.
Szükség esetén törölhető egy-egy foglalás.

## Technológiák
**Front-End:** HTML, CSS - Bootstrap 5

**Back-End:** PHP - 8.3

**Adatbázis:** MySQL - 8.4

## Teljesítmény optimalizálás
A feladat önmagában nem tartalmaz olyan részeket, amelyek túlzottan erőforrás-igényesek lennének.
Ennek ellenére mindig lehet javítani az optimalizáltságon.

### Foglalás optimalizálása
- Ha egy kritériumnak nem felel meg a foglalási kérés, akkor a többit már nem ellenőrzi.
- Csak akkor hajt végra adatbázis-lekérést, amikor az elengedhetetlen.
- Az időpontok összehasonlításánál elengedhetetlen az adatbázis lekérdezése. Itt viszont ahelyett, hogy csak lekérdezne, majd PHP-ban végezné az összehasonlítást, mindez már a queryben megtörténik. Ez kevesebb lépés, valamint az ilyen jellegű feladatokat az adatbázis gyorsabban tudja elvégezni.

### Foglalás szűrése
Alap értelmezetten minden foglalás megjelenik, szűréskor azonban csak azok a mezők kerülnek lekérdezésre, melyek megfelelnek a kritériumnak, így nem terheli feleslegesen nagy adatlekérés az adatbázist.

## Adatbázis - Táblák
### spaces
id - INT, PRIMARY-KEY

name - VARCHAR(120), UNIQUE

### reservations
id - INT, PRIMARY-KEY

space - VARCHAR(120), UNIQUE

reserver - VARCHAR(255)

start_time - DATETIME

end_time - DATETIME

## API leírás
A megvalósításnál nem tényleges API készült, a különböző funkciók HTTP Requestek segítségével érhetők el.

| URL | HTTP metódus | Leírás |
| --- | ------------ | ------ | 
| /index.php | GET | A parkolóban található helyek listázása. |
| /index.php | GET | Az összes foglalás listázása. |
| /index.php?filter_by_space= | GET | Egy adott parkolóhoz tartoző foglalások listázása. |
| /index.php?delete_by_id= | GET | Megadott foglalás törlése ID alapján. |
| /add_reservation.php | POST | Új foglalás létrehozása (index.php oldalon található űrlapból induló kérés). |
