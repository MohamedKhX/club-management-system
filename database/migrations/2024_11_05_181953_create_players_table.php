<?php

use App\Enums\PlayerStateEnum;
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
        Schema::create('players', function (Blueprint $table) {
            $table->id();
            $table->string('first_name', 100);
            $table->string('middle_name', 100);
            $table->string('grandfather_name', 100);
            $table->string('last_name', 100);
            $table->string('place_of_birth', 100)->nullable();
            $table->date('date_of_birth');
            $table->string('position', 100)->nullable();
            $table->string('nationality', 100)->nullable();
            $table->string('national_number', 12);
            $table->string('tunic_number');

            $table->boolean('is_active')->default(true);

            $table->enum('state', PlayerStateEnum::values())
                ->default(PlayerStateEnum::Inactive);  // Player status

            $table->foreignId('sport_federation_id')->constrained('sport_federations')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('players');
    }
};
