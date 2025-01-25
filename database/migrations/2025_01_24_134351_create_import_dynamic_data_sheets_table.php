<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImportDynamicDataSheetsTable extends Migration
{
    public function up(): void
    {
        Schema::create('import_dynamic_data_sheets', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('import_dynamic_data_sheets');
    }
}
