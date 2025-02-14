<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('demo_requests', function (Blueprint $table) {
            $table->id();
            $table->string('vname');
            $table->string('phone')->unique();
            $table->string('email')->unique();
            $table->string('subject')->nullable();
            $table->longText('message')->nullable();
            $table->tinyInteger('active_id')->nullable();
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('demo_requests');
    }
};
