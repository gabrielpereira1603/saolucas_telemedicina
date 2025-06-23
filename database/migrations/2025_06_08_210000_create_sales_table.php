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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Plan::class);
            $table->foreignIdFor(\App\Models\SubAcquirer::class)->nullable(true);
            $table->foreignIdFor(\App\Models\Client::class);
            $table->unsignedInteger('value');
            $table->string('preference_id')->nullable(true);
            $table->enum('status', ['pending', 'paid', 'cancelled'])->default('pending');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
