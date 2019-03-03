<?php

require 'includes/helpers.php';
require 'Piano.php';
require 'Form.php';

use P2\Piano as Piano;
use DWA\Form as Form;

// basic vars
$nats = [
    'C',
    'D',
    'E',
    'F',
    'G',
    'A',
    'B'
];

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

$get = $_GET;

if (isset($get['root']))
{
    $root = $get['root'];
    $root_mod = $get['root_opts'];
    $root = processRoot($root, $root_mod);

    if ($get['scale_type'] == 'minor') {
        $scale = $min_scale_pattern;
    } else {
        $scale = $maj_scale_pattern;
    }
    $scale_highlights = deriveScale($root, $scale);

    $piano_params = [];
    $piano_params['root'] = $root;
    $piano_params['highlights'] = $scale_highlights;
    $litpiano = new Piano($piano_params);
    var_dump($litpiano);
    echo $litpiano->builtPiano;
    die();
    header('Location: index.php');
} else
{
    $plainpiano = new Piano([]);
}

// TODO validation

// TODO write JSON file with keys and their enharmonic notes? or is this too much work?

function deriveScale($root, $pattern)
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

function processRoot($root, $opt)
{
    global $twelve_tones;
    global $nats;
    // TODO validate root as text
    // TODO validate root in [A-G]

    $root = strtoupper($root);
    if (in_array($root, $nats)) {
        $root = findRoot($root, $opt);
    } else {
        $errors = TRUE;
    }

    return $root;
}

function findRoot($note, $opt)
{
    global $twelve_tones;

    $scale_max = sizeof($twelve_tones);

    // normalizes to the natural note before applying sharp or flat modifier
    $rindex = array_search($note . '-nat', $twelve_tones);

    if ($opt == 'sharp') {
        $offset = +1;
    } elseif ($opt == 'flat') {
        $offset = -1;
    } else {
        $offset = 0;
    }

    if ($rindex + $offset >= $scale_max) {
        // because #sharp modifier can only increase index by 1,
        // it's safe to hard-code a 0 if the index >= $scale_max
        // in order to wrap around
        $ix = 0;
    } elseif ($rindex + $offset < 0) {
        // sets index to reference last element in $twelve_tones
        // to wrap around the other direction if flat modifier
        // is causing overflow
        $ix = $scale_max-1;
    } else {
        $ix = $rindex + $offset;
    }

    return $twelve_tones[$ix];
}

session_unset();
