<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('login');
            $table->string('api_token')->nullable();
            $table->bigInteger('github_id')->nullable();
            $table->string('location')->nullable();
            $table->string('name')->nullable();
            $table->string('repos_url')->nullable();
            $table->string('url')->nullable();
            $table->string('avatar')->nullable();
            $table->string('access_token')->nullable();
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
        Schema::dropIfExists('users');
    }
}
