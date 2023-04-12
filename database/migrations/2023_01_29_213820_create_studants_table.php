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
        Schema::create('studants', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->autoIncrement();
            $table->string('name');
            $table->string('father_name');
            $table->date('date_of_birth');
            $table->string('temporary_address')->nullable();
            $table->string('permanent_address');
            $table->string('city');
            $table->string('tajneed_number');
            $table->unsignedBigInteger('ammart_id');
            $table->unsignedBigInteger('halqa_id');
            $table->string('phone_number');
            $table->string('email');
            $table->string('current_class');
            $table->string('group');
            $table->string('subject');
            $table->string('name_of_institution');
            $table->boolean('current_education_status');
            $table->string('year_of_education_completed');
            $table->unsignedBigInteger('added_by');
            $table->unsignedBigInteger('edited_by')->nullable();
            $table->boolean('deleted')->default(false);
            $table->timestamps();

            $table->index('ammart_id');
            $table->index('halqa_id');
            $table->index('current_class');
            $table->index('group');
            $table->index('subject');
            $table->index('city');
            $table->index('tajneed_number');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('studants');
    }
};
