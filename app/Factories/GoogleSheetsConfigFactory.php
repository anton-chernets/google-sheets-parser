<?php

namespace App\Factories;

use App\DTO\FileConfigDTO;
use App\DTO\GoogleSheetsConfigDTO;

class GoogleSheetsConfigFactory
{
    public static function fromArray(array $config): GoogleSheetsConfigDTO
    {
        $files = array_map(function ($file) {
            return new FileConfigDTO(
                static::extractSpreadsheetId($file['url']),
                $file['tabs'],
                $file['tables'],
            );
        }, $config['files']);

        return new GoogleSheetsConfigDTO($files);
    }

    private static function extractSpreadsheetId(string $url): ?string
    {
        $pattern = '/\/d\/([a-zA-Z0-9-_]+)/';
        if (preg_match($pattern, $url, $matches)) {
            return $matches[1];
        }
        return null;
    }
}
