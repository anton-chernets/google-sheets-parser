<?php

namespace App\Services\Google;

use Google\Service\Exception;

class DriveSpreadsheetHandler implements SpreadsheetHandlerStrategy
{
    /**
     * @throws Exception
     */
    public function getSpreadsheetIds(): array
    {
        return (new DriveMetadataService)->readSheetIdsFromGoogle();
    }
}
