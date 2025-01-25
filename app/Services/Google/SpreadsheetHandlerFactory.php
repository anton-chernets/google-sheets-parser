<?php

namespace App\Services\Google;

use Exception;

class SpreadsheetHandlerFactory
{
    /**
     * @throws Exception
     */
    public static function make(string $scheme): SpreadsheetHandlerStrategy
    {
        return match ($scheme) {
            'config_files' => new ConfigSpreadsheetHandler(),
            'account_files' => new DriveSpreadsheetHandler(),
            default => throw new Exception('Invalid scheme.'),
        };
    }
}
