<?php
namespace P2;

class Piano
{
    public $builtPiano;
    private $nats = [
        'C',
        'D',
        'E',
        'F',
        'G',
        'A',
        'B'
    ];

    private $twelve_tones = [
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
    private $maj_scale_pattern = [0, 2, 4, 5, 7, 9, 11];
    private $min_scale_pattern = [0, 2, 3, 5, 7, 8, 10];
    public $root;
    public $scale;

    public function __construct(array $piano_params)
    {
        if (!isset($piano_params['root'])) {
            $this->buildMeAPiano([]);
        } else {
            $root = $piano_params['root'];
            $root_mod = $piano_params['root_opts'];

            $root = $this->processRoot($root, $root_mod);
            if ($piano_params['scale_type'] == 'minor') {
                $scale = $this->min_scale_pattern;
            } else {
                $scale = $this->maj_scale_pattern;
            }
            $scale_highlights = $this->deriveScale($root, $scale);

            $this->root = $root;
            $this->scale = $scale;

            $this->buildMeAPiano($scale_highlights);
        }
    }

    private function deriveScale($root, $pattern)
    {
        $twelve_tones = $this->twelve_tones;
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

    private function processRoot($root, $opt)
    {
        $twelve_tones = $this->twelve_tones;
        $nats = $this->nats;
        // TODO validate root as text
        // TODO validate root in [A-G]

        $root = strtoupper($root);
        if (in_array($root, $nats)) {
            $root = $this->findRoot($root, $opt);
        } else {
            $errors = TRUE;
        }

        return $root;
    }

    private function findRoot($note, $opt)
    {
        $twelve_tones = $this->twelve_tones;

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

    private function buildMeAPiano($highlights = [])
    {
        // add CSS class to divs
        $head = '<div id="piano">';
        $tail = '</div>';
        $raw_keys = [
            'C-nat'=> '<div class="whitekey #REPLACEME" id="C-nat"></div>',
            'C-sharp'=> '<div class="blackkey #REPLACEME" id="C-sharp"></div>',
            'D-nat'=> '<div class="whitekey #REPLACEME" id="D-nat"></div>',
            'D-sharp'=> '<div class="blackkey #REPLACEME" id="D-sharp"></div>',
            'E-nat'=> '<div class="whitekey #REPLACEME" id="E-nat"></div>',
            'F-nat'=> '<div class="whitekey #REPLACEME" id="F-nat"></div>',
            'F-sharp'=> '<div class="blackkey #REPLACEME" id="F-sharp"></div>',
            'G-nat'=> '<div class="whitekey #REPLACEME" id="G-nat"></div>',
            'G-sharp'=> '<div class="blackkey #REPLACEME" id="G-sharp"></div>',
            'A-nat'=> '<div class="whitekey #REPLACEME" id="A-nat"></div>',
            'A-sharp'=> '<div class="blackkey #REPLACEME" id="A-sharp"></div>',
            'B-nat'=> '<div class="whitekey #REPLACEME" id="B-nat"></div>',
        ];
        $final_keys = [];

        // highlights each key that needs to be highlighted
        foreach ($raw_keys as $tone => $div) {
            if (in_array($tone, $highlights)) {
                if ($tone == $this->root) {
                    $div = str_replace('#REPLACEME','highlighted-root',$div);
                } else {
                    $div = str_replace('#REPLACEME','highlighted',$div);
                }
                $final_keys[] = $div;
            } else {
                $div = str_replace('#REPLACEME','',$div);
                $final_keys[] = $div;
            }
        }

        // extends notes to two octaves
        $final_keys = array_merge($final_keys, $final_keys);

        // collapses array into an html string
        $html_piano = $head . join('', $final_keys) . $tail;
        $this->builtPiano = $html_piano;
        // echo $this->builtPiano;
        // die();
    }

}
