<?php
include "./db_connect.php";

// Parkolóhelyek lekérése
function get_spaces()
{
    $sql = "SELECT * FROM `spaces`";
    $result = CONN->query($sql);
    return $result->fetchAll();
}

// Foglalások lekérése
function get_reservations()
{
    $sql = "SELECT * FROM `reservations`";
    $result = CONN->query($sql);
    return $result->fetchAll();
}
?>
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
            <div class="col-12 py-3">
                <h1>Parkolóhely foglalás</h1>
            </div>
        </div>
        <!-- Parkolóhelyek listázása -->
        <div class="row">
            <div class="col-12 py-3">
                <h2>Helyek</h2>
                <div class="d-flex">
                    <?php
                    $spaces = get_spaces();
                    foreach ($spaces as $space) {
                        echo "<div class='border border-2 border-primary py-1 px-2 rounded me-2'>" . $space["name"] . "</div>";
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 py-3">
                <h2>Foglalás</h2>
                <div>
                    <form class="row" action="add_reservation.php" method="POST">
                        <div class="mb-2">
                            <label for="rev_space">Parkoló hely:</label>
                            <input type="text" name="res_space" id="res_space" placeholder="pl.: a1" />

                            <label for="rev_reserver">Foglaló neve:</label>
                            <input type="text" name="res_reserver" id="res_reserver" placeholder="pl.: Anna" />
                        </div>
                        <div class="mb-2">
                            <label for="rev_reserver">Parkolás kezdete:</label>
                            <input type="date" name="res_start_date" id="res_start_date" />
                            <input type="time" name="res_start_time" id="res_start_time" />
                        </div>
                        <div class="mb-2">
                            <label for="rev_reserver">Parkolás vége:</label>
                            <input type="date" name="res_end_date" id="res_end_date" />
                            <input type="time" name="res_end_time" id="res_end_time" />
                        </div>
                        <div class="mb-2">
                            <button type="submit">Foglalás</button>
                        </div>
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
                <table class="table">
                    <tr>
                        <th>#</th>
                        <th>Foglaló</th>
                        <th>Hely</th>
                        <th>Kezdete</th>
                        <th>Vége</th>
                    </tr>
                    <?php
                    $reservations = get_reservations();
                    foreach ($reservations as $reservation) {
                        echo "<tr><td>" . $reservation["id"] . "</td><td>" . $reservation["reserver"] . "</td><td>" . $reservation["space"] . "</td><td>" . $reservation["start_time"] . "</td><td>" . $reservation["end_time"] . "</td></tr>";
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>
</body>

</html>