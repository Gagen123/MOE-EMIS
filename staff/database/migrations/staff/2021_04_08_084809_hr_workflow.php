<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class HrWorkflow extends Migration
{
    public function up(){
        Schema::create('staff_program_workflow', function (Blueprint $table) {
            $table->char('id',36)->unique()->primary();
            $table->char('program_id',36)->nullable(false);
            $table->integer('sequence')->length(11)->unsigned()->nullable(false);
            $table->char('authority_type',36)->nullable(false);
            $table->char('sys_role_id',36)->nullable(false);
        });
        Schema::create('staff_program_workflow_audit', function (Blueprint $table) {
            $table->increments('id');
            $table->char('work_id',36);
            $table->char('program_id',36)->nullable();
            $table->integer('sequence')->length(11)->unsigned()->nullable();
            $table->char('authority_type',36)->nullable();
            $table->char('sys_role_id',36)->nullable();
            $table->char('audited_by',36)->nullable();
            $table->timestamp('audited_at')->nullable();
        });

        DB::unprepared('
            DROP PROCEDURE IF EXISTS emis_program_detils_audit_proc;
            CREATE PROCEDURE emis_program_detils_audit_proc(
                IN record_id VARCHAR(36),
                IN userId VARCHAR(36),
                IN type VARCHAR(36)
            )
            BEGIN
                IF type ="program_details" THEN 
                    INSERT INTO staff_program_details_audit(program_id,training_type,course_title,organizer,start_date,end_date,related_programme,
                    category,donor_agency,projectofdonor,study_country,coursemode,degree,subject1,subject2,thesis_title,
                    programme_level,programme_type,course_type,course_provider,vanue,total_budget,total_hrs,financial_source,
                    nomination_start_date,nomination_end_date,nature_of_participant,target_group,org_level,remarks,created_by,
                    updated_by,created_at,updated_at,published_date,status,audited_by,audited_at)
                    SELECT id,training_type,course_title,organizer,start_date,end_date,related_programme,
                    category,donor_agency,projectofdonor,study_country,coursemode,degree,subject1,subject2,thesis_title,
                    programme_level,programme_type,course_type,course_provider,vanue,total_budget,total_hrs,financial_source,
                    nomination_start_date,nomination_end_date,nature_of_participant,target_group,org_level,remarks,created_by,
                    updated_by,created_at,updated_at,published_date,status,userId,CURRENT_TIMESTAMP FROM staff_program_details WHERE id=record_id;
                ELSEIF type ="workflow" THEN 
                    INSERT INTO staff_program_workflow_audit(work_id,program_id,sequence,authority_type,sys_role_id,audited_by,audited_at)
                    SELECT id,program_id,sequence,authority_type,sys_role_id,userId,CURRENT_TIMESTAMP FROM staff_program_workflow WHERE program_id=record_id;
                END IF;
            END;
        ');
    }
    public function down(){
        Schema::dropIfExists('staff_program_workflow');
        Schema::dropIfExists('staff_program_workflow_audit');
    }
}
