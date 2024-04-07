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
        Schema::create('address_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('employee_id');
            $table->foreign('employee_id')->references('id')->on('employee_details');
            $table->bigInteger('address_type_id');
            $table->foreign('address_type_id')->references('id')->on('address_types');
            $table->bigInteger('country_id');
            $table->foreign('country_id')->references('id')->on('countries');
            $table->bigInteger('state_id');
            $table->foreign('state_id')->references('id')->on('states');
            $table->bigInteger('district_id');
            $table->foreign('district_id')->references('id')->on('districts');
            $table->text('land_mark');
            $table->text('house_name');
            $table->boolean('status')->default(true);
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
        Schema::dropIfExists('address_details');
    }
};
