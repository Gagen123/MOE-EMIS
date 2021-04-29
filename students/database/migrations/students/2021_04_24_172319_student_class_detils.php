<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class StudentClassDetils extends Migration
{
    public function up(){
        Schema::create('std_class_detils', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->char('student_id',36)->nullable(false);
            $table->char('dzo_id',36)->nullable(false);
            $table->char('org_id',36)->nullable(false);
            $table->char('class_stream_id',36)->nullable(false);
            $table->char('section',36)->nullable(false);
            $table->string('student_type')->nullable(false);
            $table->string('no_meals');
            $table->string('scholarship')->nullable();
            $table->string('special_benifit')->nullable();
            $table->char('disability',36)->nullable(false);
            $table->char('created_by',36)->nullable(true);
            $table->char('updated_by',36)->nullable(true);
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
        Schema::create('std_class_detils_audit', function (Blueprint $table) {
            $table->increments('id');
            $table->char('std_class_id',36)->nullable();
            $table->char('student_id',36)->nullable();
            $table->char('dzo_id',36)->nullable();
            $table->char('org_id',36)->nullable();
            $table->char('class_stream_id',36)->nullable();
            $table->char('section',36)->nullable();
            $table->string('student_type')->nullable();
            $table->string('no_meals');
            $table->string('scholarship')->nullable();
            $table->string('special_benifit')->nullable();
            $table->char('disability',36)->nullable();
            $table->char('created_by',36)->nullable();
            $table->char('updated_by',36)->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->char('audited_by',36)->nullable();
            $table->timestamp('audited_at')->nullable();
        });
        DB::unprepared('
            DROP PROCEDURE IF EXISTS emis_std_detils_audit_proc;
            CREATE PROCEDURE emis_std_detils_audit_proc(
                IN record_id VARCHAR(36),
                IN userId VARCHAR(36),
                IN type VARCHAR(36)
            )
            BEGIN
                IF type ="personal" THEN 
                    INSERT INTO std_personal_detils_audit(std_personal_id,snationality,cid_passport,first_name,middle_name,last_name,dob,sex_id,
                    village_id,address,mother_tongue,attachments,status,created_by,updated_by,created_at,updated_at,audited_by,audited_at)
                    SELECT id,snationality,cid_passport,first_name,middle_name,last_name,dob,sex_id,
                    village_id,address,mother_tongue,attachments,status,created_by,updated_by,created_at,updated_at,userId,CURRENT_TIMESTAMP FROM std_personal_detils WHERE id=record_id;
                ELSEIF type ="guardain" THEN 
                    INSERT INTO std_guardain_detils_audit(student_guardain_id,student_id,contact_type,nationality,cid_passport,name,village_id,address,present_village_id,
                    work_address,residence_address,occupation,email,cntct_no,created_by,updated_by,created_at,updated_at,audited_by,audited_at)
                    SELECT id,student_id,contact_type,nationality,cid_passport,name,village_id,address,present_village_id,
                    work_address,residence_address,occupation,email,cntct_no,created_by,updated_by,created_at,updated_at,userId,CURRENT_TIMESTAMP FROM std_guardain_detils WHERE student_id=record_id;
                ELSEIF type ="classes" THEN 
                    INSERT INTO std_class_detils_audit(std_class_id,student_id,dzo_id,org_id,class_stream_id,section,student_type,
                    no_meals,scholarship,special_benifit,disability,created_by,updated_by,created_at,updated_at,audited_by,audited_at)
                    SELECT id,student_id,dzo_id,org_id,class_stream_id,section,student_type,
                    no_meals,scholarship,special_benifit,disability,created_by,updated_by,created_at,updated_at,userId,CURRENT_TIMESTAMP FROM std_class_detils WHERE student_id=record_id;
                END IF;
            END;
        ');
    }
    public function down(){
        Schema::dropIfExists('std_class_detils');
        Schema::dropIfExists('std_class_detils_audit');
        
    }
}
