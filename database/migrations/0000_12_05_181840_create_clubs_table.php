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
        Schema::create('clubs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('location')->nullable(); // Club's location
            $table->date('founded_date')->nullable();
            $table->string('phone')->nullable(); // Contact phone number
            $table->string('email')->nullable(); // Contact email address
            $table->string('website')->nullable(); // Federation website URL
            $table->string('facebook_page')->nullable();
            $table->string('twitter_page')->nullable();

            $table->foreignId('sport_federation_id')->nullable()->constrained()->onDelete('set null'); // Associated sport federation
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clubs');
    }
};
