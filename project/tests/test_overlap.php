<?php

require './functions.php';

echo "Test 1\n";

$result = reservationsOverlap(

    '2026-08-05 10:00',
    '2026-08-05 12:00',

    '2026-08-05 11:00',
    '2026-08-05 13:00'

);

echo $result ? "PASS\n" : "FAIL\n";