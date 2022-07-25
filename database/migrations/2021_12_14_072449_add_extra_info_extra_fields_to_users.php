<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddExtraInfoExtraFieldsToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
           $table->string('prsnl_website')->after('firm_id')->nullable(); 
           $table->string('cover_color')->after('prsnl_website')->nullable(); 
           $table->string('twitter')->after('cover_color')->nullable(); 
           $table->string('linked_in')->after('twitter')->nullable(); 
           $table->string('others')->after('linked_in')->nullable();  
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
