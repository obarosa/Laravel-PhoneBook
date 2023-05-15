<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('pri_nome')->nullable();
            $table->string('apelido')->nullable();
            $table->string('username');
            $table->string('email')->unique();
            $table->string('empresa')->nullable();
            $table->enum('tipo', ['nenhum', 'vip', 'lista_negra'])->default('nenhum')->nullable();
            $table->enum('grupo', ['nenhum', 'amigos', 'familia', 'trabalho', 'lista_colegas'])->default('nenhum')->nullable();
            $table->boolean('favorito')->nullable();
            $table->string('nmr_escritorio')->default(NULL)->nullable();
            $table->string('nmr_telemovel')->default(NULL)->nullable();
            $table->string('nmr_casa')->default(NULL)->nullable();
            $table->boolean('usar_nmr_telemovel')->default(0)->nullable();
            $table->boolean('usar_nmr_escritorio')->default(0)->nullable();
            $table->text('notas')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contacts');
    }
}
