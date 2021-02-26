<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTodoItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('todo_items', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->boolean('status')->nullable();
            $table->string('priority')->nullable();
            $table->string('author')->nullable();
            $table->string('deadline')->nullable();
            $table->timestamps();
        });

        Schema::table('todo_items', function ($table) {
            $table->bigInteger('todo_list_id')->unsigned()->nullable();
            $table->foreign('todo_list_id')
                ->references('id')->on('todo_lists')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('todo_items');
    }
}
