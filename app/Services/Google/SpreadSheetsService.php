<?php

namespace App\Services\Google;

use App\DTO\FileConfigDTO;
use App\Services\DataBaseService;
use Google\Service\Exception;
use Google\Service\Sheets;
use Illuminate\Support\Facades\DB;

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
     * @param FileConfigDTO $fileConfigDTO
     * @throws Exception
     */
    public function import(FileConfigDTO $fileConfigDTO): void
    {
        if (in_array(FileConfigDTO::TABS_ALL, $fileConfigDTO->tabs)) {
            $ranges = $this->getGoogleSheetTabs($fileConfigDTO->id);
        } else {
            $ranges = $fileConfigDTO->tabs;
        }

        foreach ($ranges as $range) {
            $responseRows = $this->service->spreadsheets_values->get($fileConfigDTO->id, $range)->getValues();

            if (empty($responseRows)) {
                logs()->info('No data found in the spreadsheet:', ['id' => $fileConfigDTO->id]);
                break;
            }

            $allFormattedData = $this->formattedData($fileConfigDTO, $responseRows);
            $this->saveToDB($allFormattedData);
        }
    }

    /**
     * @param array $allFormattedData
     */
    private function saveToDB(array $allFormattedData): void
    {
        DB::transaction(function () use ($allFormattedData) {
            foreach ($allFormattedData as $tableName => $insertDataRows) {
                DataBaseService::createTable($tableName);
                if (!empty($insertDataRows)) {
                    DataBaseService::addedFields($tableName, array_keys($insertDataRows[0]));
                    DataBaseService::writeNewData($tableName, $insertDataRows);
                }
            }
        });
    }

    /**
     * @param FileConfigDTO $fileConfigDTO
     * @param array $rows
     * @return array
     */
    private function formattedData(FileConfigDTO $fileConfigDTO, array $rows): array
    {
        $allFormattedData = [];
        foreach ($fileConfigDTO->tables as $tableName => $tableConfig) {
            if (empty($rows)) {
                throw new \InvalidArgumentException('Rows array is empty.');
            }

            $headers = $rows[0];
            $mappedHeaders = array_map(function ($header) use ($tableConfig) {
                return $tableConfig[$header] ?? $header;
            }, $headers);

            $formattedData = [];
            foreach ($rows as $index => $row) {
                if ($index === 0) {
                    continue;
                }

                if (count($mappedHeaders) !== count($row)) {
                    throw new \InvalidArgumentException("Row at index $index does not match headers count.");
                }

                $formattedData[] = array_combine($mappedHeaders, $row);
            }

            $allFormattedData[$tableName] = $formattedData;
        }

        return $allFormattedData;
    }

    /**
     * @throws Exception
     */
    private function getGoogleSheetTabs(string $spreadsheetId): array
    {
        $spreadsheet = $this->service->spreadsheets->get($spreadsheetId);
        $sheets = $spreadsheet->getSheets();

        $ranges = [];
        foreach ($sheets as $sheet) {
            $sheetTitle = $sheet->getProperties()->getTitle();
            $ranges[] = $sheetTitle;
        }

        return $ranges;
    }
}
