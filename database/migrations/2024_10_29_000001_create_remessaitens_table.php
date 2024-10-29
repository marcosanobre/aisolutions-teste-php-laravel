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
        if (Schema::hasTable('remessa')) { // Verifica se a tabela 'remessa' existe
            Schema::create('remessa_item', function (Blueprint $table) {
                $table->increments('id');
                $table->bigInteger('remessa_id')->nullable(false);
                $table->bigInteger('categoria_id')->nullable(false);
                $table->string('periodo_referencia', 15);
                $table->string('cod_documento', 10);
                $table->string('titulo', 50);
                $table->text('conteudo');
                $table->timestamp('created_at')->useCurrent();
                $table->timestamp('updated_at')->nullable(true);
                $table->softDeletes();

                $table->foreign('remessa_id')
                    ->references('id')
                    ->on('remessa')
                    ->onDelete('cascade');

                $table->foreign('categoria_id')
                    ->references('id')
                    ->on('categoria')
                    ->onDelete('cascade');
            });
        } else {
            throw new Exception("A tabela 'remessa' não existe. Execute a migration de 'remessa' antes de 'remessa_itens'.");
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('remessa_item');
    }
};

