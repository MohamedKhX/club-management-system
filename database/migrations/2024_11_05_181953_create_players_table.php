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
            $table->string('name');
            $table->date('date_of_birth');
            $table->string('position')->nullable();
            $table->string('nationality')->nullable();
            $table->enum('state', PlayerStateEnum::values())
                ->default(PlayerStateEnum::Active);  // Player status

            $table->foreignId('club_id')->constrained('clubs');
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
