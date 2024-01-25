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
        Schema::create('iks_servers', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('ip');
            $table->unsignedInteger('port');
            $table->string('rcon');
            $table->char('serverId');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('iks_servers');
    }
};
