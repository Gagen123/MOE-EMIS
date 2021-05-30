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

            $table->date('nomination_start_date',10)->nullable();
            $table->date('nomination_end_date',10)->nullable();
            $table->string('nature_of_participant')->nullable();
            $table->string('target_group')->nullable();
            $table->string('org_level')->nullable();

            $table->string('remarks')->nullable(true);
            $table->string('created_by',36)->nullable(true);
            $table->string('updated_by',36)->nullable(true);
            $table->timestamp('created_at')->nullable(true);
            $table->timestamp('updated_at')->nullable(true);
            $table->timestamp('published_date')->nullable(true);
            $table->enum('status', ['Pending', 'Created'])->default('Pending')->nullable(false);
        });

        Schema::create('staff_program_details_audit', function (Blueprint $table) {
            $table->increments('id');
            $table->char('program_id',36);
            $table->char('training_type',36)->nullable();
            $table->string('course_title',200)->nullable();
            $table->char('organizer',36)->nullable();
            $table->date('start_date',10)->nullable();
            $table->date('end_date',10)->nullable();
            $table->char('related_programme',36)->nullable();
            
            $table->char('category',36)->nullable();
            $table->char('donor_agency',36)->nullable();
            $table->char('projectofdonor',36)->nullable();
            $table->char('study_country',36)->nullable();
            $table->char('coursemode',36)->nullable();
            $table->char('degree',36)->nullable();
            $table->char('subject1',36)->nullable();
            $table->char('subject2',36)->nullable();
            $table->string('thesis_title')->nullable();

            $table->char('programme_level',36)->nullable();
            $table->char('programme_type',36)->nullable();
            $table->char('course_type',36)->nullable();
            $table->char('course_provider',36)->nullable();
            $table->string('vanue',200)->nullable();
            $table->integer('total_budget')->length(11)->unsigned()->default(0)->nullable();
            $table->string('total_hrs',10)->nullable();
            $table->char('financial_source',36)->nullable()->default(0);

            $table->date('nomination_start_date',10)->nullable();
            $table->date('nomination_end_date',10)->nullable();
            $table->string('nature_of_participant')->nullable();
            $table->string('target_group')->nullable();
            $table->string('org_level')->nullable();

            $table->string('remarks')->nullable();
            $table->string('created_by',36)->nullable();
            $table->string('updated_by',36)->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('published_date')->nullable();
            $table->enum('status', ['Pending', 'Created']);
            $table->char('audited_by',36)->nullable();
            $table->timestamp('audited_at')->nullable();
        });
    }

    public function down(){
        Schema::dropIfExists('staff_program_details');
        Schema::dropIfExists('staff_program_details_audit');
    }
}
