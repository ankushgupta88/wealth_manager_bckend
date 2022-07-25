<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddExtraFieldsToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
             //Member fiel
            $table->string('mobile')->after('remember_token')->nullable();
            $table->string('avatar')->default('default_user.png')->after('mobile')->nullable();
            $table->enum('user_type', ['Admin', 'Customer', 'Subscriber','Guest','Advisor '])->default('Customer')->after('avatar')->nullable();
            $table->enum('user_status', ['Pending', 'Suspend', 'Verified', 'Hold', 'Active'])->default('Active')->after('user_type')->nullable();
            $table->string('first_name')->after('user_status')->nullable();
            $table->string('last_name')->after('first_name')->nullable();
            $table->string('location')->after('last_name')->nullable();
            $table->string('postal_code')->after('location')->nullable();
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
