<?php
namespace P2;

session_start();

class Piano
{
    public $builtPiano;

    public function __construct(array $piano_params)
    {
        if (!isset($piano_params['highlights'])) {
            $this->buildMeAPiano([]);
        } else {
            $this->root = $piano_params['root'];
            $this->buildMeAPiano($piano_params['highlights']);
        }
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
    }
}


//
// function buildMeAPiano($highlights = [])
// {
//     // add CSS class to divs
//     $head = '<div id="piano">';
//     $tail = '</div>';
//     $raw_keys = [
//         'C-nat'=> '<div class="whitekey #REPLACEME" id="C-nat"></div>',
//         'C-sharp'=> '<div class="blackkey #REPLACEME" id="C-sharp"></div>',
//         'D-nat'=> '<div class="whitekey #REPLACEME" id="D-nat"></div>',
//         'D-sharp'=> '<div class="blackkey #REPLACEME" id="D-sharp"></div>',
//         'E-nat'=> '<div class="whitekey #REPLACEME" id="E-nat"></div>',
//         'F-nat'=> '<div class="whitekey #REPLACEME" id="F-nat"></div>',
//         'F-sharp'=> '<div class="blackkey #REPLACEME" id="F-sharp"></div>',
//         'G-nat'=> '<div class="whitekey #REPLACEME" id="G-nat"></div>',
//         'G-sharp'=> '<div class="blackkey #REPLACEME" id="G-sharp"></div>',
//         'A-nat'=> '<div class="whitekey #REPLACEME" id="A-nat"></div>',
//         'A-sharp'=> '<div class="blackkey #REPLACEME" id="A-sharp"></div>',
//         'B-nat'=> '<div class="whitekey #REPLACEME" id="B-nat"></div>',
//     ];
//     $final_keys = [];
//
//     // highlights each key that needs to be highlighted
//     foreach ($raw_keys as $tone => $div) {
//         if (in_array($tone, $highlights)) {
//             $div = str_replace('#REPLACEME','highlighted',$div);
//             $final_keys[] = $div;
//         } else {
//             $div = str_replace('#REPLACEME','',$div);
//             $final_keys[] = $div;
//         }
//     }
//
//     // overwrites class for the root note
//     if (sizeof($highlights) > 0) {
//         $root_div = $raw_keys[$highlights[0]];
//         $root_div = str_replace('highlighted','highlighted-root',$root_div);
//         $raw_keys[$highlights[0]] = $root_div;
//     }
//
//     // extends notes to two octaves
//     $final_keys = array_merge($final_keys, $final_keys);
//
//     // collapses array into an html string
//     $html_piano = $head . join('', $final_keys) . $tail;
//     return $html_piano;
// }
//
// $highlights = [
//     'C-sharp',
//     'D-sharp',
//     'F-nat',
//     'F-sharp',
//     'G-sharp',
//     'A-sharp',
//     'C-nat'
// ];
//
// $test = buildMeAPiano($highlights);
// echo $test;
