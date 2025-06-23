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
        Schema::create('sub_acquirers', function (Blueprint $table) {
            $table->id();
            $table->string('prefix_url')->nullable(true);
            $table->decimal('commission_rate', 5, 2)->nullable();
            $table->string('name')->nullable(false);
            $table->string('slug')->nullable(false);
            $table->string('street')->nullable();
            $table->string('neighborhood')->nullable();
            $table->string('city')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('number')->nullable();
            $table->string('complement')->nullable();
            $table->foreignIdFor(\App\Models\User::class);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_acquirers');
    }
};
