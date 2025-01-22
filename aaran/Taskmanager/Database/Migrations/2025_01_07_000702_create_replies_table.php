<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        if (Aaran\Aadmin\Src\Customise::hasTaskManager()) {

            Schema::create('replies', function (Blueprint $table) {
                $table->id();
                $table->foreignId('task_id')->references('id')->on('tasks');
                $table->text('vname');
                $table->string('verified')->nullable();
                $table->string('verified_on')->nullable();
                $table->foreignId('user_id')->references('id')->on('users');
                $table->tinyInteger('active_id')->nullable();
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('replies');
    }
};
