<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApiRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('api_requests', function (Blueprint $table) {
            $table->id();
            $table->string('hlgest')->nullable();
            $table->boolean('usar_hlgest')->nullable();
            $table->string('primavera')->nullable();
            $table->boolean('usar_primavera')->nullable();
            $table->string('phc')->nullable();
            $table->boolean('usar_phc')->nullable();
            $table->enum('atualizacao', ['horas', 'manualmente'])->default('horas');
            $table->timestamps();
        });
        DB::table('api_requests')->insert(
            [
                'hlgest' => 'http://192.168.100.5:5001/Service1.asmx?WSDL',
                'usar_hlgest' => 1,
                'primavera' => 'http://phonebook.test/dashboard/admin/primavera',
                'usar_primavera' => 0,
                'phc' => 'http://phonebook.test/dashboard/admin/phc',
                'usar_phc' => 0,
                'atualizacao' => 'manualmente',
            ]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('api_requests');
    }
}
