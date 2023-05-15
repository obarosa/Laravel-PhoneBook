<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExportDefinicionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('export_definicions', function (Blueprint $table) {
            $table->id();
            $table->string('yealink_name')->nullable();
            $table->string('yealink_directory')->nullable();
            $table->string('microsip_name')->nullable();
            $table->string('microsip_directory')->nullable();
            $table->string('grandstream_name')->nullable();
            $table->string('grandstream_directory')->nullable();
            $table->string('gigaset_name')->nullable();
            $table->string('gigaset_directory')->nullable();
            $table->timestamps();
        });
        DB::table('export_definicions')->insert(
            [
                'yealink_name' => 'yealink_xml',
                'yealink_directory' => 'C:\phonebook\yealink',
                'microsip_name' => 'microsip_xml',
                'microsip_directory' => 'C:\phonebook\microsip',
                'grandstream_name' => 'grandstream_xml',
                'grandstream_directory' => 'C:\phonebook\grandstream',
                'gigaset_name' => 'gigaset_xml',
                'gigaset_directory' => 'C:\phonebook\gigaset',
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
        Schema::dropIfExists('export_definicions');
    }
}
