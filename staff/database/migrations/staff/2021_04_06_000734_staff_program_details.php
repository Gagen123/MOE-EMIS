<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class StaffProgramDetails extends Migration{
    public function up(){
        Schema::create('staff_program_details', function (Blueprint $table) {
            $table->char('id',36)->unique()->primary();
            $table->char('training_type',36)->nullable(false);
            $table->string('course_title',200)->nullable(false);
            $table->char('organizer',36)->nullable(false);
            $table->date('start_date',10)->nullable(false);
            $table->date('end_date',10)->nullable(false);
            $table->char('related_programme',36)->nullable(true);
            
            $table->char('category',36)->nullable(true);
            $table->char('donor_agency',36)->nullable(true);
            $table->char('projectofdonor',36)->nullable(true);
            $table->char('study_country',36)->nullable(true);
            $table->char('coursemode',36)->nullable(true);
            $table->char('degree',36)->nullable(true);
            $table->char('subject1',36)->nullable(true);
            $table->char('subject2',36)->nullable(true);
            $table->string('thesis_title')->nullable(true);

            $table->char('programme_level',36)->nullable(true);
            $table->char('programme_type',36)->nullable(true);
            $table->char('course_type',36)->nullable(true);
            $table->char('course_provider',36)->nullable(true);
            $table->string('vanue',200)->nullable(true);
            $table->integer('total_budget')->length(11)->unsigned()->default(0)->nullable(true);
            $table->string('total_hrs',10)->nullable(true);
            $table->char('financial_source',36)->nullable(true)->default(0);

            $table->date('nomination_start_date',10)->nullable(false);
            $table->date('nomination_end_date',10)->nullable(false);
            $table->string('nature_of_participant')->nullable(true);
            $table->string('target_group')->nullable(true);
            $table->string('org_level')->nullable(true);

            $table->string('remarks')->nullable(true);
            $table->string('created_by',36)->nullable(true);
            $table->string('updated_by',36)->nullable(true);
            $table->timestamp('created_at')->nullable(true);
            $table->timestamp('updated_at')->nullable(true);
            $table->timestamp('published_date')->nullable(true);
            $table->enum('status', ['Pending', 'Created'])->default('Pending')->nullable(false);
        });
    }

    public function down(){
        Schema::dropIfExists('staff_program_details');
    }
}
