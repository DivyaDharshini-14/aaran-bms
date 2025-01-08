<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('conclusion_tasks', function (Blueprint $table) {
            $table->id();
            $table->string('vname')->nullable();
            $table->date('vdate')->nullable();
            $table->decimal('active_id',3)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('conclusion_tasks');
    }
};
