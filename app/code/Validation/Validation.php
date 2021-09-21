<?php

namespace Validation;

class Validation
{
    static function isNotNull($value): bool
    {
        return ($value !== null && $value !== '');
    }
}
