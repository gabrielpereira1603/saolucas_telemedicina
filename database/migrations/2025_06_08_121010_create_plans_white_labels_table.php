<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('plans_white_labels', function (Blueprint $table) {
            $table->id();

            // chave estrangeira para plans
            $table->foreignId('plan_id')
                ->constrained('plans')
                ->cascadeOnDelete();

            // chave estrangeira para white_label
            $table->foreignId('white_label_id')
                ->constrained('white_labels') // se sua tabela estiver no singular
                ->cascadeOnDelete();

            $table->timestamps();

            // opcional: evita duplicação de vínculo
            $table->unique(['plan_id', 'white_label_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('plans_white_labels');
    }
};
