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
            $table->string('name', 100);
            $table->date('date_of_birth');
            $table->string('position', 100)->nullable();
            $table->string('nationality', 100)->nullable();
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
