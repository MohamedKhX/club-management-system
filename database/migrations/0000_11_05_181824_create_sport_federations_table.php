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
        Schema::create('sport_federations', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->text('description');
            $table->string('phone', 100)->nullable(); // Contact phone number
            $table->string('email', 100)->nullable(); // Contact email address
            $table->string('website')->nullable(); // Federation website URL
            $table->string('facebook_page')->nullable();
            $table->string('twitter_page')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sport_federations');
    }
};
