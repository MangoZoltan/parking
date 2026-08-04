<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parkolóhely foglalás</title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="./assets/bootstrap/css/bootstrap.css" />
    <script src="./assets/bootstrap/js/bootstrap.js" defer></script>
    <script src="./assets/bootstrap/js/popper.min.js"></script>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-12 py-3"><h1>Parkolóhely foglalás</h1></div>
        </div>
        <div class="row">
            <div class="col-12 py-3">
                <h2>Helyek</h2>
                <div></div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 py-3">
                <h2>Foglalás</h2>
                <div>
                    <form>
                        <label for="rev_space">Parkoló hely:</label>
                        <input type="text" name="res_space" id="res_space" placeholder="pl.: a1" />
                        <label for="rev_reserver">Foglaló neve:</label>
                        <input type="text" name="res_reserver" id="res_reserver" placeholder="pl.: Anna" />
                        <label for="rev_reserver">Parkolás kezdete:</label>
                        <input type="date" name="res_start_date" id="res_start_date" />
                        <input type="time" name="res_start_time" id="res_start_time" />
                        <label for="rev_reserver">Parkolás vége:</label>
                        <input type="date" name="res_end_date" id="res_end_date" />
                        <input type="time" name="res_end_time" id="res_end_time" />
                        <button type="submit">Foglalás</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 py-3">
                <h2>Foglalások</h2>
                <a href="">Összes</a><br />
                <div>
                    <p>Szűrés parkolóhelyre:</p>
                    <form>
                        <input type="text" name="filter_by_space" id="filter_by_space" placeholder="Pl.: A1">
                        <button type="submit">Keresés</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>