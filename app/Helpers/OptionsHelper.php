<?php

namespace App\Helpers;

class OptionsHelper {

    function to_json($strOptions) {
        $jsonOptions = json_decode($strOptions);
        return $jsonOptions;
    }

    function to_string($jsonOptions) {
        $strOptions = '{}';
        if ($jsonOptions) {
            $strOptions = $jsonOptions->toString();
        }
        return $strOptions;
    }
}