<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tickets_group_id');
            $table->integer('status');
            $table->integer('resolved_by');
            $table->integer('assigned_to');
            $table->integer('priority');
            $table->string('title');
            $table->string('email');
            $table->string('name');
            $table->string('last_name');
            $table->string('phone');
            $table->text('description');
            $table->integer('project_id');
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
        Schema::drop('tickets');
    }
}
