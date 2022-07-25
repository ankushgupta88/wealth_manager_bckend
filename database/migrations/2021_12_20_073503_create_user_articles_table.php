<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_articles', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable(); 
            $table->string('name')->nullable(); 
            $table->longText('desc')->nullable(); 
            $table->string('image')->nullable(); 
            $table->enum('status', ['DeActive', 'Active'])->default('Active')->nullable();
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
        Schema::dropIfExists('user_articles');
    }
}
