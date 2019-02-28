<?php
namespace P2;

session_start();

class Piano
{
    private $whitekeys;
    private $blackkeys;
    private $highlighted;
    public $builtPiano;

    public function __construct(array $request)
    {
        if (!isset($_SESSION['scale-highlighting']))
        {
            $this->buildMeAPlainPiano();
        }
    }

    public function buildMeAPlainPiano()
    {
        $this->builtPiano = '<div id="piano">
            <div class="whitekey" id="C-nat"></div>
            <div class="blackkey" id="C-sharp"></div>
            <div class="whitekey" id="D-nat"></div>
            <div class="blackkey" id="D-sharp"></div>
            <div class="whitekey" id="E-nat"></div>
            <div class="whitekey" id="F-nat"></div>
            <div class="blackkey" id="F-sharp"></div>
            <div class="whitekey" id="G-nat"></div>
            <div class="blackkey" id="G-sharp"></div>
            <div class="whitekey" id="A-nat"></div>
            <div class="blackkey" id="A-sharp"></div>
            <div class="whitekey" id="B-nat"></div>
        </div>';
    }

    public function highlightTheKeys()
    {
        // add CSS class to divs
    }


}
