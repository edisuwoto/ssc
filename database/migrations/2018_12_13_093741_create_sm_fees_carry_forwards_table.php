<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmFeesCarryForwardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sm_fees_carry_forwards', function (Blueprint $table) {
            $table->increments('id');
            $table->double('balance', 16, 2);
            $table->tinyInteger('active_status')->default(1);
            $table->string('notes',191)->default("Fees Carry Forward");
            $table->timestamps();

            $table->integer('student_id')->nullable()->unsigned();
            $table->foreign('student_id')->references('id')->on('sm_students')->onDelete('cascade');

            $table->integer('created_by')->nullable()->default(1)->unsigned();

            $table->integer('updated_by')->nullable()->default(1)->unsigned();

            $table->integer('school_id')->nullable()->default(1)->unsigned();
            $table->foreign('school_id')->references('id')->on('sm_schools')->onDelete('cascade');
            
            $table->integer('academic_id')->nullable()->default(1)->unsigned();
            $table->foreign('academic_id')->references('id')->on('sm_academic_years')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sm_fees_carry_forwards');
    }
}
