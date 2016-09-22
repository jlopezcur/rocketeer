<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMilestonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('milestones', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
			$table->string('slug')->unique();
			$table->text('description');
			$table->integer('project_id');
			$table->integer('user_id');
            $table->date('due_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('milestones');
    }
}
