<?php

namespace App\Services\Google;

class ConfigSpreadsheetHandler implements SpreadsheetHandlerStrategy
{
    protected array $sheetFiles;

    public function getSpreadsheetIds(): array
    {
        $spreadsheetIds = [];
        foreach ($this->sheetFiles as $file) {
            $spreadsheetIds[] = $this->extractSpreadsheetId($file['file_url']);
        }
        return $spreadsheetIds;
    }

    private function extractSpreadsheetId(string $url): ?string
    {
        $pattern = '/\/d\/([a-zA-Z0-9-_]+)/';
        if (preg_match($pattern, $url, $matches)) {
            return $matches[1];
        }
        return null;
    }
}
