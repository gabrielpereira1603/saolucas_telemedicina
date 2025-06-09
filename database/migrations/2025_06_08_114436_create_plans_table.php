<?php

use App\Models\User;
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
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->string('preference_id')->nullable(true);
            $table->string('slug')->unique();
            $table->string('name');
            $table->decimal('value');
            $table->text('simple_description')->nullable();
            $table->longText('description')->nullable();
            $table->string('image_url')->nullable();
            $table->string('logo_url')->nullable();
            $table->string('icon')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plans');
    }
};
