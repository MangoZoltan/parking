<?php

include "./db_connect.php";

if ($_SERVER['REQUEST_METHOD'] != "POST") {
    echo "A főoldalon foglalhat!";
    header("Location: index.php");
    die();
} else {
    $noerror = true;
    $reserve_status = "-";
    $space = $_POST['res_space'] ?? null;
    $reserver = $_POST['res_reserver'] ?? null;
    $start_date = $_POST['res_start_date'] ?? null;
    $start_time = $_POST['res_start_time'] ?? null;
    $end_date = $_POST['res_end_date'] ?? null;
    $end_time = $_POST['res_end_time'] ?? null;

    // Időpontok átalakítása az adatbázishoz
    $start_time_str = $start_date . ' ' . $start_time . ':00';
    $end_time_str = $end_date . ' ' . $end_time . ':00';

    // Csak létező parkolóhely foglalható
    $sql = "SELECT `name` FROM `spaces` WHERE `name` = ?";
    $stmt = CONN->prepare($sql);
    $stmt->bindParam(1, $space, PDO::PARAM_STR);
    if (!$stmt->execute()) {
        $reserve_status = "Sikertelen: hiba a parkolóhely meglétének ellenőrzésekor.";
        $noerror = false;
    } else {
        $occurrence = count($stmt->fetchAll());
        if (!($occurrence > 0)) {
            $reserve_status = "Sikertelen: a megadott parkolóhely nem létezik.";
            $noerror = false;
        }
    }

    // Átfedések ellenőrzése
    if ($noerror) {
        $sql = "SELECT COUNT(*) as 'count' FROM `reservations` WHERE
            (
                (start_time < ? AND end_time > ?)
            ) AND space  = ?";
        $stmt = CONN->prepare($sql);
        $stmt->bindParam(1, $end_time_str, PDO::PARAM_STR);
        $stmt->bindParam(2, $start_time_str, PDO::PARAM_STR);
        $stmt->bindParam(3, $space, PDO::PARAM_STR);

        if (!$stmt->execute()) {
            $reserve_status = "Sikertelen: hiba átfedés keresés közben.";
            $noerror = false;
        } else {
            $collision_count = $stmt->fetch()['count'];
            if ($collision_count > 0) {
                $reserve_status = "Sikertelen: egybeesik egy másik foglalással.";
                $noerror = false;
            }
        }
    }

    // Rögzítés az adatbáziban
    if ($noerror) {
        $sql = "INSERT INTO `reservations` (`space`, `reserver`, `start_time`, `end_time`) VALUES (?, ?, ?, ?);";
        $stmt = CONN->prepare($sql);
        $stmt->bindParam(1, $space, PDO::PARAM_STR);
        $stmt->bindParam(2, $reserver, PDO::PARAM_STR);
        $stmt->bindParam(3, $start_time_str, PDO::PARAM_STR);
        $stmt->bindParam(4, $end_time_str, PDO::PARAM_STR);

        if (!$stmt->execute()) {
            $reserve_status = "Sikertelen: hiba rögzítés közben.";
            $noerror = false;
        } else {
            $reserve_status = "Sikeres foglalás!";
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
                <h2>Foglalás adatai</h2>
                <p><b>Foglalási név: </b><?= $reserver ?></p>
                <p><b>Parkolóhely: </b><?= $space ?></p>
                <p><b>Időtartam</b></p>
                <p><b>Kezdete: </b><?= $start_date . ' | ' . $start_time ?></p>
                <p><b>Vége: </b><?= $end_date . ' | ' . $end_time ?></p>
            </div>
            <div class="col-12 py-3">
                <h2>Státusz</h2>
                <h1><?= $reserve_status ?></h1>
            </div>
            <div class="col-12 py-3">
                <a href='./index.php'>Vissza</a>
            </div>
        </div>
    </div>
</body>