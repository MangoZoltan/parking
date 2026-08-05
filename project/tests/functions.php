<?php

function reservationsOverlap(
    string $existingStart,
    string $existingEnd,
    string $newStart,
    string $newEnd
): bool {

    return (
        strtotime($existingStart) < strtotime($newEnd) &&
        strtotime($existingEnd) > strtotime($newStart)
    );

}