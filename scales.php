<?php

require 'Piano.php';
require 'Form.php';

use P2\Piano as Piano;
use DWA\Form as Form;

session_start();

$nats = [
    'C',
    'D',
    'E',
    'F',
    'G',
    'A',
    'B'
];

$form = new Form($_GET);
$root = $form->get('root');
$errors = $form->validate([
    'root' => 'required|alpha|maxLength:1'
]);
// add'l validation
$inNats = in_array(strtoupper($root), $nats);

if(!$form->hasErrors && $inNats) {
    $piano = new Piano($_GET);
}

$_SESSION['returned'] = [
    'piano' => $piano ?? null,
    'hasErrors' => $form->hasErrors,
    'inNats' => $inNats,
    'root' => strtoupper($root),
];

header('Location: index.php');
