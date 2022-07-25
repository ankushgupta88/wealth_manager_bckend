<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_videos', function (Blueprint $table) {
            $table->id(); 
            $table->integer('user_id')->nullable(); 
            $table->string('name')->nullable(); 
            $table->string('video_link')->nullable(); 
            $table->string('file_name')->nullable(); 
            $table->enum('status', ['DeActive', 'Active'])->default('Active')->nullable();
             $table->string('upload_type')->default('Video')->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_videos');
    }
}
