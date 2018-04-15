<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email', 191)->unique();
            $table->string('facebook_email', 191)->unique()->nullable();
            $table->string('linkedin_email', 191)->unique()->nullable();
            $table->string('temp_email', 191)->unique()->nullable();
            $table->string('phone_number');
            $table->string('company');
            $table->string('interest');
            $table->string('address')->nullable();
            $table->boolean('verified')->default(false);
            $table->rememberToken();
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
        Schema::dropIfExists('members');
    }
}
