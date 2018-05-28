<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('task_id');
            $table->string('title')->comment('タスクのタイトル');
            $table->text('description')->nullable()->comment('タスクの説明');
            $table->boolean('completed')->default(false)->comment('タスクの状態');
            $table->integer('score')->default(0)->comment('タスク完了時の獲得スコア');
            $table->string('user_id');
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
        Schema::dropIfExists('tasks');
    }
}
