<?php

namespace App\Services\Google;

use Google\Service\Exception;
use Google\Service\Sheets;

class SpreadSheetsService extends BaseApiClientService
{
    public Sheets $service;
    public function __construct()
    {
        parent::__construct();
        $this->client->setScopes([Sheets::SPREADSHEETS_READONLY]);
        $this->service = (new Sheets($this->client));
    }

    /**
     * @throws Exception
     */
    public function getGoogleSheetRows(string $spreadsheetId): array
    {
        $range = 'Sheet1';// Назва аркуша (або діапазон, наприклад, Sheet1!A1:Z1000)

        $response = $this->service->spreadsheets_values->get($spreadsheetId, $range);

        $values = $response->getValues();

        if (empty($values)) {
            logs()->error('No data found in the spreadsheet.');
        } return $values;
    }
}
