<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('iks_vauchers', function (Blueprint $table) {
            $table->id();

            $table->string('key');
            $table->string('web_flags');
            $table->string('flags');
            $table->integer('immunity');
            $table->integer('group_id');
            $table->boolean('active')->default(true);
            $table->timestamp('activated')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('iks_vauchers');
    }
};
