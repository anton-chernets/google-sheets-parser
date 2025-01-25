<?php

namespace App\Jobs;

use App\Services\Google\SpreadsheetHandlerFactory;
use App\Services\Google\SpreadSheetsService;
use Google\Service\Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class GoogleSheetsFileImportJob implements ShouldQueue
{
    use Queueable;

    /**
     * @throws Exception
     * @throws \Google\Exception
     * @throws \Exception
     */
    public function handle(): void
    {
        foreach (SpreadsheetHandlerFactory::make()->getSpreadsheetIds() as $spreadsheetId) {
            $this->processSpreadsheet($spreadsheetId);
        }
    }

    /**
     * @throws \Google\Exception
     * @throws Exception
     */
    protected function processSpreadsheet(string $spreadsheetId): void
    {
        $this->readGoogleSheetById($spreadsheetId);
    }

    /**
     * @throws Exception
     * @throws \Google\Exception
     * @param string $spreadsheetId
     */
    private function readGoogleSheetById(string $spreadsheetId): void
    {
        $rows = (new SpreadSheetsService)->getGoogleSheetRows($spreadsheetId);

        $columns = $rows[0];
        $information = array_slice($rows, 1);
        $formattedData = [];
        foreach ($information as $row) {
            $formattedData[] = array_combine($columns, $row);
        }

        logs()->debug('formattedData '  . json_encode($formattedData));//TODO db logic
    }
}
