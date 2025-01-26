<?php

namespace App\Services;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DataBaseService
{
    /**
     * @param string $tableName
     */
    public static function createTable(string $tableName): void
    {
        if (!Schema::hasTable($tableName)) {
            Schema::create($tableName, function (Blueprint $table) {
                $table->timestamp('created_at')->nullable();
            });
        }
    }

    /**
     * @param string $tableName
     * @param array $columns
     */
    public static function addedFields(string $tableName, array $columns): void
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
    public static function writeNewData(string $tableName, array $dataRows): void
    {
        foreach ($dataRows as $row) {
            if (!self::checkExistsRow($tableName, $row)) {
                $row['created_at'] = now();
                DB::table($tableName)->insert($row);
            }
        }
    }

    private static function checkExistsRow(string $tableName, array $row): bool
    {
        return DB::table($tableName)
            ->where($row)
            ->exists();
    }
}
