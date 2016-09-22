<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKanbanPortletsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('kanban_portlets', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('workflow_item_id');
            $table->integer('kanban_board_id');
            $table->string('7');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('kanban_portlets');
    }
}
