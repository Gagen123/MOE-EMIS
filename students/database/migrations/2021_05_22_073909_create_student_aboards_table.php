<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentAboardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_aboards', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->char('organizationId',36);
            $table->char('cid_passport',36);
            $table->char('first_name',36);
            $table->char('middle_name',36)->nullable(true);
            $table->char('last_name',36);
            $table->char('dob',36);
            $table->char('sex_id',36);
            $table->char('mother_tongue',36);
            $table->tinyInteger('status');
            $table->string('fulladdress');
            $table->char('country',36);
            $table->char('city',36);
            // $table->char('created_by',36)->nullable(true);
            // $table->char('updated_by',36)->nullable(true);
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
        Schema::dropIfExists('student_aboards');
    }
}
