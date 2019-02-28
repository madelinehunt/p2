<?php

require 'Piano.php';

use P2\Piano as Piano;

$get = $_GET;
$piano = new Piano($get);

// TODO validation
$circle_of_fifths = ['C','G','D','A','E','B','F#','Db','Ab','Eb','Bb','F'];

// TODO write JSON file with keys and their enharmonic notes

$twelve_tones = [
    "C-nat",
    "C-sharp",
    "D-nat",
    "D-sharp",
    "E-nat",
    "F-nat",
    "F-sharp",
    "G-nat",
    "G-sharp",
    "A-nat",
    "A-sharp",
    "B-nat",
];
$maj_scale_pattern = [0, 2, 4, 5, 7, 9, 11];
$min_scale_pattern = [0, 2, 3, 5, 7, 8, 10];


function derive_scale($root, $pattern)
{
    global $twelve_tones;
    $scale_max = sizeof($twelve_tones);

    $final_scale = [];

    $start = array_search($root, $twelve_tones);
    foreach ($pattern as $scale_pos) {
        $note = $start + $scale_pos;
        if ($note < $scale_max) {
            $final_scale[] = $twelve_tones[$note];
        } else { // if the index overflows:
            $note -= $scale_max; // wrap around to the beginning
            $final_scale[] = $twelve_tones[$note];
        }
    }

    return $final_scale;
}

session_unset();
