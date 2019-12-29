<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGsearchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gsearches', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('domainname');
            $table->string('keyword');
            $table->string('position');
            $table->dateTime('query_time')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gsearches');
    }
}
