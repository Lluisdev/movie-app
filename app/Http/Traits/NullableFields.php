<?php

namespace App\Http\Traits;

trait NullableFields {

    protected function nullIfEmpty($input)
    {
        return trim($input) == '' ? null : trim($input);
    }
}

?>