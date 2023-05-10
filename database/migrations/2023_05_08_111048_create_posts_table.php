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
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('header')->unique();
            $table->string('slug')->unique();
            $table->string('description')->default('');
            $table->string('epilog')->default('');
            $table->string('thumbnails')->nullable();
            $table->text('content')->nullable();
            $table->unsignedInteger('category_id');
            $table->unsignedTinyInteger('status')->default(0);
            $table->integer('views')->unsigned()->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
