<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRuntimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('runtimes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('server_id');
            $table->integer('vault_id');
            $table->integer('script_id');
            $table->dateTime('end');
            $table->text('output');
            $table->string('status');
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
        Schema::drop('runtimes');
    }
}
