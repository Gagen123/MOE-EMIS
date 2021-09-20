<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubstitutedTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('substituted_teachers', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->char('staff_id',36)->nullable(false);
            $table->foreign('staff_id')->references('id')->on('stf_staff');
            $table->char('subsTeacher',36)->nullable(false);
            $table->foreign('subsTeacher')->references('id')->on('staff_substitution');
            $table->date('from_date',20)->nullable(false);
            $table->date('to_date',20)->nullable(false);
            $table->string('teaching_subject',255)->nullable();
            $table->string('remarks')->nullable();
            $table->string('isextended')->nullable();
            $table->char('created_by',36)->nullable();
            $table->char('updated_by',36)->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('substituted_teachers');
    }
}

