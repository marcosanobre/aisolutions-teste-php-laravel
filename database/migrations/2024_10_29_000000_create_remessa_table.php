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
        Schema::create('remessa', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('exercicio_remessa')->nullable(false);
            $table->integer('sequencial_remessa')->nullable(false);
            $table->string('status',20);
            $table->integer('qtd_documentos')->nullable(true);
            $table->text('log')->nullable(true);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable(true);
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('remessa_item');
        Schema::dropIfExists('remessa');
    }
};

