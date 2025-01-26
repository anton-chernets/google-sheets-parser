<?php

namespace App\DTO;

class FileConfigDTO
{
    public const TABS_ALL = 'all';
    public function __construct(
        public string $id,
        public array $tabs,
        public array $tables
    ) {}
}
