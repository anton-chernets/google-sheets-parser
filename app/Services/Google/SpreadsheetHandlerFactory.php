<?php

namespace App\Services\Google;

use Exception;

class SpreadsheetHandlerFactory
{
    /**
     * @throws Exception
     */
    public static function make(): SpreadsheetHandlerStrategy
    {
        return new ConfigSpreadsheetHandler();
    }
}
