<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Answer extends Migration{
    
    public function up(){
        Schema::create('question_answers', function (Blueprint $table){
            $table->char('id',36);
            $table->char('parent_id',36)->nullable(false);
            $table->text('name')->nullable(false);
            $table->boolean('status')->default(1);
            $table->string('created_by',36)->nullable(true);
            $table->string('updated_by',50)->nullable(true);
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
        Schema::create('question_answers_audit', function (Blueprint $table){
            $table->increments('id');
            $table->char('record_id',36)->nullable(false);
            $table->char('parent_id',36)->nullable(false);
            $table->text('name')->nullable(false);
            $table->boolean('status')->default(1);
            $table->char('created_by',36)->nullable(true);
            $table->char('updated_by',36)->nullable(true);
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->char('audited_by',36)->nullable(true);
            $table->timestamp('audited_on')->nullable();
            $table->char('action_type',36)->nullable(true);
        });

        DB::unprepared('
            DROP PROCEDURE IF EXISTS emis_question_answers_audit_proc;
            CREATE PROCEDURE emis_question_answers_audit_proc(
                IN record_id VARCHAR(36),
                IN userId VARCHAR(36),
                IN type VARCHAR(36)
            )
            BEGIN
                IF type ="add" THEN 
                    INSERT INTO question_answers_audit(record_id,parent_id,name,status,created_by,updated_by,created_at,updated_at,audited_by,audited_on,action_type)
                    SELECT id,parent_id,name,status,created_by,updated_by,created_at,updated_at,userId,CURRENT_TIMESTAMP,"add" FROM question_answers WHERE parent_id=record_id;
                ELSEIF type ="delete" THEN 
                    INSERT INTO question_answers_audit(record_id,parent_id,name,status,created_by,updated_by,created_at,updated_at,audited_by,audited_on,action_type)
                    SELECT id,parent_id,name,status,created_by,updated_by,created_at,updated_at,userId,CURRENT_TIMESTAMP,"delete" FROM question_answers WHERE id=record_id;
                ELSEIF type ="edit" THEN 
                    INSERT INTO question_answers_audit(record_id,parent_id,name,status,created_by,updated_by,created_at,updated_at,audited_by,audited_on,action_type)
                    SELECT id,parent_id,name,status,created_by,updated_by,created_at,updated_at,userId,CURRENT_TIMESTAMP,"edit" FROM question_answers WHERE id=record_id;
                END IF;
            END;
        ');
    }
    public function down(){
        Schema::dropIfExists('question_answers');
        Schema::dropIfExists('question_answers_audit');
    }
}
