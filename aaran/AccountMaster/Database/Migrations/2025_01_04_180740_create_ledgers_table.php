<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('ledgers', function (Blueprint $table) {
            $table->id();
            $table->text('vname');
            $table->longText('description')->nullable();
            $table->foreignId('ledger_group_id')->references('id')->on('ledger_groups')->onDelete('cascade');
            $table->string('opening')->nullable();
            $table->string('opening_date')->nullable();
            $table->string('current')->nullable();
            $table->string('active_id', 3)->nullable();
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ledgers');
    }
};
