<?php

namespace App\Exceptions;

use Exception;

class SessionNotFoundException extends Exception
{
    public static function forId(string $id)
    {
        return new self("La especie  con ID \"$id\" no fue encontrado.");
    }
}