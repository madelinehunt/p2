<?php
require 'includes/helpers.php';
require 'scales.php';
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
        <section id="intro">
            <h1 id="scales_title">🎵 Fun with Musical Scales 🎵</h1>
        </section>


        <section id="explanation">
            <h4>Derive a musical scale here, and see it on the piano!  🎹</h4>
        </section>

        <section id="options">
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
                <?php if ($hasErrors): ?> <!-- TODO update this section -->
                    <div class='errors alert alert-danger'>
                        <ul>
                            <?php foreach ($errors as $error): ?>
                                <li><?= $error ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif ?>
            </form>
        </section>

        <!-- TODO provide fail message -->

        <section id="piano-section">
            <?php if (isset($_SESSION['piano'])): ?>
                <b>highlighted</b><br>
                <?php echo $_SESSION['piano'];  ?>
            <?php endif; ?>
            <!-- TODO define default behavior better -->
        </section>
    </div>
</body>
