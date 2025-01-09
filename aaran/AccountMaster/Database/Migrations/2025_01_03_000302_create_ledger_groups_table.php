<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        if (Aaran\Aadmin\Src\Customise::hasAccountMaster()) {

            Schema::create('ledger_groups', function (Blueprint $table) {
                $table->id();
                $table->string('vname')->unique();;
                $table->longText('description')->nullable();
                $table->foreignId('account_head_id')->references('id')->on('account_heads')->onDelete('cascade');
                $table->string('opening')->nullable();
                $table->string('opening_date')->nullable();
                $table->string('current')->nullable();
                $table->string('active_id', 3)->nullable();
                $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('ledger_groups');
    }
};
