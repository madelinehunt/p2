<?php
# Filename: MyForm.php

namespace Buck; # Choose your own namespace for this class. Could be your last name, your app name, etc.

use DWA\Form; # Use statement here will allow us to extend Form below

class MyForm extends Form
{
    /**
     * The value must contain at least one letter, digit, and special character
     * @param $value
     * @return bool
     */
    protected function password($value)
    {
        $containsLetter = preg_match('/[a-zA-Z]/', $value);
        $containsDigit = preg_match('/\d/', $value);
        $containsSpecial = preg_match('/[^a-zA-Z\d]/', $value);

        return $containsLetter and $containsDigit and $containsSpecial;
    }
    protected function passwordMessage()
    {
        return 'does not contain at least one letter, digit, and special character.';
    }
}