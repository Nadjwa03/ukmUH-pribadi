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
        Schema::create('club_documentations', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title');
            $table->date('date')->nullable();
            $table->string('image');
            $table->uuid('club_id')->nullable(); // Use UUID as the foreign key for clubs
            $table->foreign('club_id')->references('id')->on('clubs')->onDelete('set null');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('club_documentations', function (Blueprint $table) {
            $table->dropForeign(['club_id']);
        });

        Schema::dropIfExists('club_documentations');
    }
};
