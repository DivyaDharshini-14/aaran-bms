<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('conclusion_task_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('conclusion_task_id')->references('id')->on('conclusion_tasks')->onDelete('cascade');
            $table->string('mode')->nullable();
            $table->foreignId('task_item_id');
            $table->foreignId('contact_id')->references('id')->on('contacts');
            $table->boolean('verified')->default(false);
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('conclusion_task_items');
    }
};
