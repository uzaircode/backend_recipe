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
        Schema::create('ingredient_wiki', function (Blueprint $table) {
            $table->id();
            $table->string('name', 200);
            $table->string('thumbnail', 150);
            $table->text('description');
            $table->string('seasonality');
            $table->string('storage');
            $table->string('cooking_tips');
            $table->string('health_benefits');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ingredient_wiki');
    }
};