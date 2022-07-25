<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddExtraNewFieldsToFirms extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('firms', function (Blueprint $table) {
            $table->longText('phone_number')->after('quote_info')->nullable();
            $table->longText('address1')->after('phone_number')->nullable();
            $table->longText('city')->after('address1')->nullable();
            $table->longText('postal_code')->after('city')->nullable();
            $table->longText('country_code')->after('postal_code')->nullable();
            $table->longText('state_code')->after('country_code')->nullable(); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('firms', function (Blueprint $table) {
            //
        });
    }
}
