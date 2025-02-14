<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (Aaran\Aadmin\Src\Customise::hasTaskManager()) {

            Schema::create('activities', function (Blueprint $table) {
                $table->id();
                $table->foreignId('task_id')->references('id')->on('tasks');
                $table->string('cdate');
                $table->text('vname');
                $table->string('estimated')->nullable();
                $table->string('duration')->nullable();
                $table->string('start_on')->nullable();
                $table->string('end_on')->nullable();
                $table->text('remarks')->nullable();
                $table->tinyInteger('active_id')->nullable();
                $table->foreignId('user_id')->references('id')->on('users');
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('activities');
    }
};
