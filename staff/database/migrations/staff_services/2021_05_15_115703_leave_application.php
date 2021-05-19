<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class LeaveApplication extends Migration
{
    public function up(){
        Schema::create('staff_leave_application', function (Blueprint $table) {
            $table->char('id',36)->unique()->primary();
            $table->char('application_number',20)->nullable(false);
            $table->char('leave_type_id',36)->nullable(false);
            $table->char('staff_id',36)->nullable(false);
            $table->char('year',4)->nullable(false);
            $table->date('date_of_application')->nullable(false);
            $table->string('reason')->nullable()->nullable(false);
            $table->date('from_date')->nullable()->nullable(false);
            $table->date('to_date')->nullable()->nullable(false);
            $table->string('no_days',11)->nullable()->nullable(false);
            $table->string('remarks')->nullable();
            $table->char('org_id',36)->nullable(false);
            $table->char('dzongkhag_id',36)->nullable(false);
            $table->char('status',100)->nullable(false);
            $table->string('created_by',36)->nullable(true);
            $table->string('updated_by',36)->nullable(true);
            $table->timestamp('created_at')->nullable(true);
            $table->timestamp('updated_at')->nullable(true);

        });
    }

    public function down(){
        Schema::dropIfExists('staff_leave_application');
    }
}
