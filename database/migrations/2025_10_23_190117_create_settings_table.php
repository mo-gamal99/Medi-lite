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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('website_name')->nullable();
            $table->string('website_name_en')->nullable();
            $table->string('subscription_title')->nullable();
            $table->string('phone')->nullable();
            $table->string('image')->nullable();
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->text('description')->nullable();
            $table->string('address')->nullable();
            $table->string('email')->nullable();
            $table->string('google_play')->nullable();
            $table->string('apple_store')->nullable();
            $table->string('logo')->nullable();
            $table->string('instagram')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('snap')->nullable();
            $table->string('tiktok')->nullable();
            $table->string('tax_number')->nullable();
            $table->decimal('value_added_tax', 5, 2)->nullable(); // 99.99 max
            $table->string('publishable_key')->nullable();
            $table->string('secret_key')->nullable();
            $table->string('sms_api_key')->nullable();
            $table->string('sms_user_name')->nullable();
            $table->string('sms_sender')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
