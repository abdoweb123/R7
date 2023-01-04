<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrainingCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('training_courses', function (Blueprint $table) {
            $table->id();
            $table->string('content');
            $table->string('provided_by');
            $table->integer('provided_by_type');
            $table->unsignedBigInteger('company_id');
            $table->date('start_date');
            $table->date('end_date');
            $table->double('total_cost');
            $table->double('employee_cost')->nullable();
            $table->double('company_cost')->nullable();
            $table->double('app_cost')->nullable();
            $table->timestamps();
            $table->foreign('company_id')->references('id')->on('companies')
            ->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('training_courses');
    }
}
