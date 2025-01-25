<?php

namespace App\Services\Google;

interface SpreadsheetHandlerStrategy
{
    public function getSpreadsheetIds(): array;
}
