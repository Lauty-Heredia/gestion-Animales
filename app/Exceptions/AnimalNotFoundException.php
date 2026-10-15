<?php

namespace App\Exeptions;

use Exception;

class AnimalNotFoundException extends Exception
{
    public static function forId(int $id): self
    {
        return new self("Animal with ID {$id} not found.");
    }
}