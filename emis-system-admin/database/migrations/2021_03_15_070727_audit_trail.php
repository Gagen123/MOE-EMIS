<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AuditTrail extends Migration{
    public function up(){
        Schema::create('emis_audit', function (Blueprint $table) {
            $table->increments('id');
            $table->string('db_name',150)->nullable(false);
            $table->string('table_name',150)->nullable(false);
            $table->char('record_id',36);
            $table->text('record_details')->nullable(true);
            $table->char('audited_by',36);
            $table->char('audited_for',36);
            $table->timestamp('created_at')->nullable();
        });

        DB::unprepared('
            DROP PROCEDURE IF EXISTS emis_audit_proc;
            CREATE PROCEDURE emis_audit_proc(
                IN db_name VARCHAR(50),
                IN table_name VARCHAR(50),
                IN record_id VARCHAR(36),
                IN record_details TEXT(1000),
                IN audited_by VARCHAR(36),
                IN audited_for VARCHAR(36)
            )
            BEGIN
                INSERT INTO emis_audit(db_name,table_name,record_id,record_details,audited_by,audited_for,created_at)
                VALUES(db_name,table_name,record_id,record_details,audited_by,audited_for,CURRENT_TIMESTAMP);
            END;
        ');
    }

    public function down(){
        Schema::dropIfExists('emis_audit');
    }
}
