<?php

require_once '../db_connect.php';

echo "=== Integration Test ===\n\n";

try {

    // 1. Teszt adatok
    $space = "A1";
    $reserver = "Integration Test";
    $start = "2026-08-05 10:00:00";
    $end = "2026-08-05 11:00:00";

    // 2. Régi teszt rekord törlése
    CONN->exec("DELETE FROM reservations WHERE reserver = 'Integration Test'");

    // 3. Beszúrás
    $stmt = CONN->prepare("
        INSERT INTO reservations
        (space, reserver, start_time, end_time)
        VALUES (?, ?, ?, ?)
    ");

    $stmt->execute([
        $space,
        $reserver,
        $start,
        $end
    ]);

    echo "PASS - Reservation inserted\n";

    // 4. Lekérdezés
    $stmt = CONN->prepare("
        SELECT COUNT(*) AS count
        FROM reservations
        WHERE reserver = ?
    ");

    $stmt->execute([$reserver]);

    $count = $stmt->fetch()['count'];

    if ($count == 1) {
        echo "PASS - Reservation found\n";
    } else {
        echo "FAIL - Reservation not found\n";
    }

    // 5. Törlés
    $stmt = CONN->prepare("
        DELETE FROM reservations
        WHERE reserver = ?
    ");

    $stmt->execute([$reserver]);

    echo "PASS - Reservation deleted\n";

} catch (Exception $e) {

    echo "FAIL\n";
    echo $e->getMessage();

}