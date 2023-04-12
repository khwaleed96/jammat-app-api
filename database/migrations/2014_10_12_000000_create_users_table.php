<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->autoIncrement();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->unique();
            $table->string('password');
            $table->string('postal_address')->nullable();
            $table->string('jammat')->nullable();
            $table->unsignedInteger('ammart_id')->nullable();
            $table->unsignedInteger('halqa_id')->nullable();
            $table->boolean('status')->default(false);
            $table->unsignedInteger('user_role_id');
            $table->string('city')->nullable();
            $table->timestampTz('email_verified_at')->nullable();
            $table->boolean('deleted')->default(false);
            $table->string('rememberToken')->nullable();
            $table->timestamps();

            $table->index('email');
            $table->index('phone');
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
};
