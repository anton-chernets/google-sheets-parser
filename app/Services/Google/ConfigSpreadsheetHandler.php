<?php

namespace App\Services\Google;

use App\DTO\GoogleSheetsConfigDTO;
use App\Factories\GoogleSheetsConfigFactory;

class ConfigSpreadsheetHandler implements SpreadsheetHandlerStrategy
{
    protected GoogleSheetsConfigDTO $filesConfigDTO;

    public function __construct()
    {
        $configArray = config('google-sheets');
        $this->filesConfigDTO = GoogleSheetsConfigFactory::fromArray($configArray);
    }

    public function getFilesConfigDTO(): array
    {
        return $this->filesConfigDTO->files;
    }
}
