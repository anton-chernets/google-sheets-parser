<?php

namespace App\Jobs;

use App\DTO\FileConfigDTO;
use App\Services\Google\SpreadSheetsService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class ProcessGoogleSheetImportJob implements ShouldQueue
{
    use Queueable;

    private string $spreadsheetId;
    private FileConfigDTO $fileConfigDTO;

    public function __construct(
        FileConfigDTO $fileConfigDTO
    ) {
        $this->fileConfigDTO = $fileConfigDTO;
    }

    /**
     * @throws \Exception
     */
    public function handle(SpreadSheetsService $service): void
    {
        $service->import($this->fileConfigDTO);
    }
}
