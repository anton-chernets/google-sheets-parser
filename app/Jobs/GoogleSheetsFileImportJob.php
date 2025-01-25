<?php

namespace App\Jobs;

use Google\Client;
use Google\Service\Exception;
use Google\Service\Sheets;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class GoogleSheetsFileImportJob implements ShouldQueue
{
    use Queueable;

    public Client $client;

    public function __construct() {}

    /**
     * @throws Exception
     * @throws \Google\Exception
     */
    public function handle(): void
    {
        $this->client = new Client();
        $this->client->setScopes([Sheets::SPREADSHEETS_READONLY]);
        $this->client->setAuthConfig(storage_path(env('GOOGLE_SHEET_FILE_PATH')));
        $this->client->setAccessType('offline');

        $this->readGoogleSheetById();
    }


    /**
     * @throws Exception
     * @throws \Google\Exception
     */
    private function readGoogleSheetById()
    {
        $service = new Sheets($this->client);//TODO move to service

        $spreadsheetId = '1r8QbWFkP5qvZWaVETpH7hkuR1yWGzpQ8E6Y6boWXP_w';//TODO to settings files
        $range = 'Sheet1';// Назва аркуша (або діапазон, наприклад, Sheet1!A1:Z1000)

        $response = $service->spreadsheets_values->get($spreadsheetId, $range);
        $values = $response->getValues();

        if (empty($values)) {
            return response()->json(['message' => 'No data found in the spreadsheet.']);
        }

        $columns = $values[0];// Перша строка — заголовки стовпців
        $data = array_slice($values, 1);// Решта строк — значення

        $formattedData = [];
        foreach ($data as $row) {
            $formattedData[] = array_combine($columns, $row);
        }

        logs()->debug(json_encode($formattedData));
    }
}
