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
        Schema::create('atividades', function (Blueprint $table) {
            $table->id();
            $table->text('titulo');
            $table->text('descricao')->nullable();
            $table->date('data_atividade')->nullable()->change();
            $table->date('data_criacao')->nullable()->default(now());
            $table->date('data_conclusao')->nullable();
            $table->string('status')->default('pendente');
            $table->integer('prioridade')->default(0);
            $table->string('responsavel')->nullable();
            $table->string('solicitante')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('atividades');
        Schema::table('atividades', function (Blueprint $table) {
            
        });
    }
};
