<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCsvContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('csv_contacts', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->string('pri_nome')->nullable();
            $table->string('email')->unique();
            $table->string('empresa')->nullable();
            $table->string('nmr_escritorio')->nullable();
            $table->string('nmr_telemovel')->nullable();
            $table->string('nmr_casa')->nullable();
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
        Schema::dropIfExists('csv_contacts');
    }
}
