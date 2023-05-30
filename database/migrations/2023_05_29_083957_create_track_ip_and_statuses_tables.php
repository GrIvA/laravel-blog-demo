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
        Schema::create('ip_statuses', function (Blueprint $table) {
            $table->unsignedTinyInteger('id')->autoIncrement();
            $table->string('name', 25);
            $table->timestamps();
        });
        Schema::create('track_ips', function (Blueprint $table) {
            $table->unsignedInteger('id')->autoIncrement();
            $table->string('remote_addr')->nullable();
            $table->unsignedTinyInteger('ip_status_id')->nullable();
            $table->timestamps();

            $table->foreign('ip_status_id')
                ->references('id')->on('ip_statuses');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('track_ips');
        Schema::dropIfExists('ip_statuses');
    }
};
