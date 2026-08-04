# Döntési napló
| Döntési pont | Amit választottam | Miért | Lehetséges alternatíva |
| ------------ | ----------------- | ----- | ---------------------- |
| Lehetséges parkolóhelyek | Adatbázisban előre megadott parkolóhelyek | A leírás annyit adott meg, hogy a rendszer "nyilvántartja a parkolóhelyeket". Nem részletezte, hogy ezek módosíthatóak, bővíthetőek stb. A relatív kevés, javasolt 3-4 óra időtartam miatt úgy döntöttem, hogy a helyek előre megadottan az adatbázisba kerülnek és az oldalon nem módosíthatóak. | Kezelhető parkolóhelyek |
| Időpont megadás | Két részből álló (dátum, óra & perc) rögzítés. | Pontosabban lehet foglalni. Mivel nem csak óra, perc van, így nem korlátozódik egy napra az intervallum. | Feltételezni, hogy csak az aktuális napra lehet foglalni és csak óra, perc megadást használni. |
| Foglalás validálás | A kezdet és befejezés nem felcserélhető. | Megengedőbb megoldás lenne, de egyben több felhasználói hibára, téves elírásra adna lehetőséget. | Amennyiben a vég időpont nagyobb a kezdetinél, akkor ezek automatikusan felcserélődjenek. |

# Reflexió

Két problémával találtam szembe magam: ezek az idő intervallum validáció és az időpontok kezelése voltak.
Mivel a dátum és idő formátumot választottam így két külön mezőből kelett egy értéket létrehoznom úgy, hogy ez megfeleljen az adatbázis dátum formájának is.
Az azonos parkolóhelyen lévő foglalások idejének ellenőrzése, hogy ezek ne érintkezzenek, elég trükkösnek bizonyult.
Néhány variáció tesztelése után megszületett a jelenlegi megoldás. Ehhez főként a Stackoverflow nyújtott segítséget.
A legnagyobb kihívás a racionális eszköz és technológia használat volt.
Eredetileg mindent meg akartam valósítani, ami egy "teljes" projekthez elengedhetetlen pl.: mobil optimalizálás, JS fetch az oldal újratöltésének blokkolása érdekében.
A Bootstrap használatát így sem tudtam elengedni.

A feladat lényegi részéhez nem használtam AI-t, a programot magam írtam, némi Google keresés segítségével.
A ChatGPT-t a dokumentáció körvonalainak megadásához használtam.
