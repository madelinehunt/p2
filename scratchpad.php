<?php
function indexRoot($root, $opt)
{
    global $twelve_tones;
    $scale_max = sizeof($twelve_tones);
    $rindex = array_search($root, $twelve_tones);

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
        $ix = 0;
    } elseif ($rindex + $offset < 0) {
        // sets index to reference last element in $twelve_tones
        // to wrap around the other direction
        $ix = $scale_max-1;
    } else {
        $ix = $rindex + $offset;
    }

    return $twelve_tones[$ix];
}

function convertRoot($root, $opt)
{
    global $twelve_tones;
    // TODO validate root as text
    // TODO validate root in [A-G]


    $root = strtoupper($root);
    if ($opt == 'nat' && in_array($root, $nats)) {
        return $root . '-nat';
    }

    if ($opt == 'sharp') {
        $offset = +1;
    } elseif ($opt == 'flat') {
        $offset = -1;

    $rindex = array_search($root, $nats);



}


function sharp($note)
{
    if ($note == 'E'){
        return 'F-nat';
    } else if ($note == 'B') {
        return 'C-nat';
    } else {
        $note .= '-sharp';
        return $note;
    }
}

function flat($note)
{
    global $nats;
    global $twelve_tones;

    $scale_max = sizeof($twelve_tones);

    $rindex = array_search($note . '-nat', $twelve_tones);
    $offset = -1;

    if ($rindex + $offset < 0) {
        // sets index to reference last element in $twelve_tones
        // to wrap around the other direction
        $ix = $scale_max-1;
    } else {
        $ix = $rindex + $offset;
    }

    return $twelve_tones[$ix]
}



<?php else: ?>
    <?php echo $plainpiano->builtPiano;  ?>
