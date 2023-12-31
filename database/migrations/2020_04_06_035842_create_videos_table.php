<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('model');
            $table->string('title');
            $table->unsignedBigInteger('model_id');
            $table->string('full_url');
            $table->string('video_id');
            $table->boolean('autoplay')->default(false);
            $table->boolean('loop')->default(false);
            $table->boolean('controls')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('videos');
    }
}
