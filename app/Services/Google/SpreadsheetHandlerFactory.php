<?php

namespace App\Services\Google;

use Exception;

class SpreadsheetHandlerFactory
{
    /**
     * @throws Exception
     */
    public static function make(string $scheme = 'default'): SpreadsheetHandlerStrategy
    {
        return match ($scheme) {
            'default' => new ConfigSpreadsheetHandler(),
            default => throw new Exception("Scheme '{$scheme}' have not supported yet"),
        };
    }
}
