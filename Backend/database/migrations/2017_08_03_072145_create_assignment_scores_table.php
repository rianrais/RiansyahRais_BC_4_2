<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssignmentScoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assignment_scores', function (Blueprint $table) {
            $table->increments('asc_id');
            $table->integer('assignment_id')->unsigned();
            $table->foreign('assignment_id')->references('assignment_id')->on('assignments');
            $table->integer('student_id')->unsigned();
            $table->foreign('student_id')->references('student_id')->on('students');
            $table->string('asc_score');
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
        Schema::dropIfExists('assignment_scores');
    }
}
