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
        Schema::create('employee_salary_break_ups', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('employee_id');
            $table->foreign('employee_id')->references('id')->on('employee_details');
            $table->bigInteger('salary_type_id');
            $table->foreign('salary_type_id')->references('id')->on('salary_types');
            $table->bigInteger('salary_component_id');
            $table->foreign('salary_component_id')->references('id')->on('salary_component_types');
            $table->integer('amount');
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
        Schema::dropIfExists('employee_salary_break_ups');
    }
};
