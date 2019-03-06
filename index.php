<?php
require 'includes/helpers.php';
require 'logic.php'
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Nathan Hunt</title>
    <meta charset="utf-8">
    <link href='./local.css' rel='stylesheet'>

</head>
<body>
    <div id="roundrect-container">
        <div id="intro">
            <h1 id="scales_title">🎵 Fun with Musical Scales 🎵</h1>
        </div>


        <div id="explanation">
            <h4>Derive a musical scale here, and see it on the piano!  🎹</h4>
        </div>

        <div id="options">
            <form action="./scales.php" method="get">
                <label>
                    Root note: <input type="text" name="root" value="C" size="4" maxlength="1">
                </label>
                <input type="radio" name="root_opts" value="nat" checked>♮
                <input type="radio" name="root_opts" value="sharp">♯
                <input type="radio" name="root_opts" value="flat">♭<br>
                <br>
                <!-- <input type="checkbox" name="display_opts" value="solfege">Solfege<br> -->
                <select name="scale_type"> <!-- replace with radio buttons? or checkboxes? -->
                    <option value="major">Major</option>
                    <option value="minor">Minor</option>
                </select>
                <br>
                <input type="submit" value="Submit" id="submit-button">
            </form>
            <?php if($hasErrors): ?>
                <div id="errors">
                    <b> Errors found!</b>
                </div>
            <?php elseif(!$inNats): ?>
                <div id="errors">
                    <b><?= $root ?> is not a musical note!</b>
                </div>
            <?php endif ?>
        </div>
        <!-- TODO provide fail message -->


        <div id="piano-div">
            <?= $display_piano ?>
        </div>

        <div id="explain-notes">
            <?= $explanation ?? '' ?>
        </div>
    </div>
</body>
