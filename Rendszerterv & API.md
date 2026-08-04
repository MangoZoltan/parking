# Parkolóhely foglalás - Rendszerterv

Az oldal célja, hogy egy parkoló helyeinek foglalását lehessen menedzselni vele.
A felhasználók könnyedén választhatnak maguknak helyet, ehhez megadják saját nevük, valamint foglalásuk kezdeti és befejezési idejét.
Ezen foglalások listázhatóak egyben vagy parkolóhely szerint egyaránt.
Szükség esetén törölhető egy-egy foglalás.

## Technológiák
**Front-End:** HTML, CSS - Bootstrap 5

**Back-End:** PHP - 8.3

**Adatbázis:** MySQL - 8.4

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
