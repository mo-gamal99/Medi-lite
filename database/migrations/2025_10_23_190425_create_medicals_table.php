<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('medicals', function (Blueprint $table) {
            $table->id();
            $table->string('barcode')->nullable();
            $table->string('name_ar')->nullable();
            $table->text('indication')->nullable();
            $table->string('dosage')->nullable();
            $table->string('name_en')->nullable();
            $table->string('composistion')->nullable();
            $table->string('strength')->nullable();
            $table->string('company')->nullable();
            $table->decimal('net', 10, 2)->nullable();
            $table->decimal('public', 10, 2)->nullable();
            $table->string('pregnancy')->nullable();
            $table->timestamps();

            // 🧩 إضافة فهرس FullText للبحث السريع
            $table->fullText(['name_ar', 'name_en', 'company', 'strength', 'indication']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medicals');
    }
};
