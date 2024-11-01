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
        if (Schema::hasTable('documento')) { // Verifica se a tabela 'remessa' existe

            Schema::create('documento_item', function (Blueprint $table) {
                $table->increments('id');
                $table->bigInteger('documento_id')->nullable(false);
                $table->string('titulo', 50);
                $table->text('conteudo');

                $table->timestamp('created_at')->useCurrent();
                $table->timestamp('updated_at')->nullable(true);
                $table->softDeletes();

                $table->foreign('documento_id')
                    ->references('id')
                    ->on('documento')
                    ->onDelete('cascade');
            });
        } else {
            throw new Exception("A tabela 'documento' não existe. Execute a migration de 'documento' antes de 'documento_item'.");
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documento_item');
    }
};

