<?php

namespace App\Services\Google;

use Google\Client;
use Google\Exception;

class BaseApiClientService
{
    public Client $client;

    /**
     * @throws Exception
     */
    public function __construct()
    {
        $this->client = new Client();
        $this->client->setAuthConfig(
            storage_path(env('GOOGLE_SHEET_API_AUTH_FILE_PATH'))
        );
        $this->client->setAccessType('offline');
    }
}
