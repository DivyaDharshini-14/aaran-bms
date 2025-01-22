<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (Aaran\Aadmin\Src\Customise::hasCommon()) {

            Schema::create('commons', function (Blueprint $table) {
                $table->id();
                $table->foreignId('label_id')->references('id')->on('labels')->onDelete('cascade');
                $table->string('vname');
                $table->string('desc')->nullable();
                $table->string('desc_1')->nullable();
                $table->smallInteger('active_id')->nullable();
                $table->unique(['vname', 'label_id']);
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('commons');
    }
};
