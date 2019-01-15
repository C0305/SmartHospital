<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_users', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('profile_picture')->nullable(true);
            $table->boolean('status')->default(true);
            $table->rememberToken();
            $table->timestampTz('created_at')->useCurrent();
            $table->timestampTz('updated_at')->nullable(true);
            $table->timestampTz('deleted_at')->nullable(true);
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_users');
    }
}
