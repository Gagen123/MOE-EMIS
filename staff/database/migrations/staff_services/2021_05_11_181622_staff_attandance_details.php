<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class StaffAttandanceDetails extends Migration
{
    public function up(){
        Schema::create('staff_attendance_dtls', function (Blueprint $table) {
            $table->char('id',36)->unique()->primary();
            $table->char('att_id',36)->nullable(false);
            $table->char('staff_id',36)->nullable(false);
            $table->char('cid_work_permit',50)->nullable();
            $table->string('no_present_days',5)->nullable(false);
            $table->string('no_absent_days',5)->nullable(false);
        });
    }

    public function down(){
        Schema::dropIfExists('staff_attendance_dtls');
    }
}
