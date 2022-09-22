<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDateBirthToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->string('date_birth')->after('lastname')->nullable();
            $table->string('place_birth')->after('date_birth')->nullable();
            $table->string('nationality')->after('place_birth')->nullable();
            $table->string('gender')->after('nationality')->nullable();
            $table->string('address')->after('gender')->nullable();
            $table->string('course')->after('address')->nullable();
            $table->string('year')->after('course')->nullable();
            // $table->string('guardian')->after('year')->nullable();
            $table->string('contact')->after('guardian')->nullable();
            $table->string('contact_guardian')->after('contact')->nullable();
            $table->string('photo')->after('contact_guardian')->nullable();

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
