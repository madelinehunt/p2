<?php

require 'Piano.php';
require 'Form.php';

use P2\Piano as Piano;
use DWA\Form as Form;

session_start();

$hasErrors = false;
$inNats = true;

$return = $_SESSION['returned'] ?? null;

if (isset($return['piano'])) {
    $completePiano = $_SESSION['returned']['piano'];
    $display_piano = $completePiano->builtPiano;
    $explanation = '<ul>
    <li><div class="whitekey highlighted-root"><b>Root note</b></br>'. $completePiano->root . '</div></li>
    <li><div class="whitekey highlighted"><b>Scale tones</b></div></li>
    </ul>';
} else {
    $piano = new Piano([]);
    $display_piano = $piano->builtPiano;
}

if ($return){
    $hasErrors = $return['hasErrors'];
    $inNats = $return['inNats'];
    $root = $return['root'];
    // var_dump($root);
    // die();
}

session_unset();
