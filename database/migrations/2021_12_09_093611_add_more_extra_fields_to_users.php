<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMoreExtraFieldsToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('listing_type')->after('postal_code')->nullable();
            $table->string('address1')->after('listing_type')->nullable();
            $table->string('address2')->after('address1')->nullable();
            $table->string('city')->after('address2')->nullable();
            $table->string('state_code')->after('city')->nullable();
            $table->string('country_code')->after('state_code')->nullable();
            $table->string('profession_name')->after('country_code')->nullable();  
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
