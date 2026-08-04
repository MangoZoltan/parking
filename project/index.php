<?php

include "./db_connect.php";

// Parkolóhelyek lekérése
function get_spaces()
{
    $sql = "SELECT * FROM `spaces` ORDER BY `id`";
    $result = CONN->query($sql);
    return $result->fetchAll();
}

// Foglalások lekérése
function get_reservations()
{
    $sql = "SELECT * FROM `reservations` ORDER BY `space`, `start_time`";
    $result = CONN->query($sql);
    return $result->fetchAll();
}

// Foglalások lekérése parkolóhely alapján
function get_reservations_by_space($space)
{
    $sql = "SELECT * FROM `reservations` WHERE `space` = ? ORDER BY `start_time`";
    $stmt = CONN->prepare($sql);
    $stmt->bindParam(1, $space, PDO::PARAM_STR);
    $stmt->execute();

    return $stmt->fetchAll();
}

// Foglalások szűrése
$filter_status = null;
$reservations = array();

if (!empty($_GET['filter_by_space'])) {

    $space = $_GET['filter_by_space'];
    $noerror = true;

    // Csak létező parkolóhely listázása
    $sql = "SELECT `name` FROM `spaces` WHERE `name` = ?";
    $stmt = CONN->prepare($sql);
    $stmt->bindParam(1, $space, PDO::PARAM_STR);
    if (!$stmt->execute()) {
        $filter_status = "Sikertelen: hiba a parkolóhely meglétének ellenőrzésekor.";
        $noerror = false;
    } else {
        $occurrence = count($stmt->fetchAll());
        if (!($occurrence > 0)) {
            $filter_status = "A megadott parkolóhely nem létezik.";
            $noerror = false;
        }
    }

    if ($noerror)
        $reservations = get_reservations_by_space($space);
} else {
    $reservations = get_reservations();
}

// Foglalás törlése
$delete_status = null;
if (!empty($_GET['delete_by_id'])) {

    echo $id = $_GET['delete_by_id'];
    $sql = "DELETE FROM `reservations` WHERE `id` = ?";
    $stmt = CONN->prepare($sql);
    $stmt->bindParam(1, $id, PDO::PARAM_STR);
    if (!$stmt->execute()) {
        $delete_status = "Sikertelen: hiba törlés közben.";
    } else {
        $effect = $stmt->rowCount();
        if ($effect > 0) {
            $delete_status = "A foglalás törölve lett!";
        } else {
            $delete_status = "Nincs érintett sor!";
        }
    }
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
                            <button class="btn btn-primary" type="submit">Foglalás</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 py-3">
                <h2>Foglalások</h2>
                <a href="index.php">Összes</a><br />
                <div>
                    <p class="m-0">Szűrés parkolóhelyre:</p>
                    <form method="GET" action="index.php">
                        <input type="text" name="filter_by_space" id="filter_by_space" placeholder="Pl.: A1" value="<?= empty($_GET['filter_by_space']) ? "" : $_GET['filter_by_space'] ?>">
                        <button class="btn btn-primary" type="submit">Keresés</button>
                    </form>
                </div>
                <?php if ($filter_status != null) echo "<div class='my-2 py-2 px-3 bg-primary rounded text-white'>" . $filter_status . "</div>"; ?>
                <?php if ($delete_status != null) echo "<div class='my-2 py-2 px-3 border border-2 border-warning rounded'><h4>Törlés</h4>" . $delete_status . "</div>";
                unset($_SESSION['delete_by_id']); ?>
                <table class="table">
                    <tr>
                        <th>#</th>
                        <th>Foglaló</th>
                        <th>Hely</th>
                        <th>Kezdete</th>
                        <th>Vége</th>
                        <th>Kezelés</th>
                    </tr>
                    <?php

                    foreach ($reservations as $reservation) {
                        echo "<tr><td>" . $reservation["id"] . "</td><td>" . $reservation["reserver"] . "</td><td>" . $reservation["space"] . "</td><td>" . $reservation["start_time"] . "</td><td>" . $reservation["end_time"] . "</td><td><a class='btn btn-sm btn-danger' href='index.php?delete_by_id=" . $reservation["id"] . "'>Törlés</a></td></tr>";
                    }
                    if (count($reservations) <= 0) {
                        echo "<tr><td colspan='6' >Nincsen foglalás ezen a parkolóhelyen.</td></tr>";
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>
</body>

</html>