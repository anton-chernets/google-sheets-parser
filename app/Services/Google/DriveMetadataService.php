<?php

namespace App\Services\Google;

use Google\Service\Drive;
use Google\Service\Exception;
use Google\Service\Sheets;

class DriveMetadataService extends BaseApiClientService
{
    public Sheets $service;
    public function __construct()
    {
        parent::__construct();
        $this->client->setScopes([Drive::DRIVE_METADATA_READONLY]);
        new Sheets($this->client);
    }

    /**
     * @throws Exception
     * @return array
     */
    public function readSheetIdsFromGoogle(): array
    {
        $this->client->setScopes([Drive::DRIVE_METADATA_READONLY]);
        $response = $this->requestListGoogleSheets();

        $files = $response->getFiles();

        if (empty($files)) {
            logs()->error('No Google Sheets files found.');
        }

        $sheets = [];
        foreach ($files as $file) {
            $sheets[] = $file->getId();
        }

        return $sheets;
    }

    /**
     * @throws Exception
     */
    private function requestListGoogleSheets(): Drive\FileList
    {
        return (new Drive($this->client))->files->listFiles([
            'q' => "mimeType='application/vnd.google-apps.spreadsheet'",
            'fields' => 'files(id, name)',
        ]);
    }
}
