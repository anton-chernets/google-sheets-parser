<?php

namespace App\Services;

use Google\Service\Exception;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DataBaseService
{
    /**
     * @param string $tableName
     */
    public static function createDynamicTable(string $tableName): void
    {
        Schema::create($tableName, function (Blueprint $table) { });
    }

    /**
     * @param string $tableName
     * @param array $columns
     * @throws Exception
     */
    public static function addColumnsToDynamicDataTable(string $tableName, array $columns): void
    {
        Schema::table($tableName, function ($table) use ($tableName, $columns) {
            foreach ($columns as $column) {
                if (!Schema::hasColumn($tableName, $column)) {
                    $table->string($column)->nullable();
                }
            }
        });
    }

    /**
     * @param string $tableName
     * @param array $dataRows
     * @return void
     */
    public static function writeOrUpdateData(string $tableName, array $dataRows): void
    {
        foreach ($dataRows as $row) {
            DB::table($tableName)->insertOrIgnore($row);
        }
    }
}
