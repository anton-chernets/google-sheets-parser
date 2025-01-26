<?php

namespace App\Console\Commands;

use App\Jobs\ProcessGoogleSheetImportJob;
use App\Services\Google\SpreadsheetHandlerFactory;
use Illuminate\Console\Command;

class GoogleSheetsFileImportCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'google-sheets-parser:command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Description of your command';

    /**
     * Execute the console command.
     *
     * @return void
     * @throws \Exception
     */
    public function handle(): void
    {
        $handler = SpreadsheetHandlerFactory::make();
        foreach ($handler->getFilesConfigDTO() as $file) {
            ProcessGoogleSheetImportJob::dispatch($file);
        }
    }
}
