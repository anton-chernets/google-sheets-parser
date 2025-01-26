<?php

namespace App\DTO;

class GoogleSheetsConfigDTO
{
    /**
     * @param FileConfigDTO[] $files
     */
    public function __construct(
        public array $files
    ) {}
}
