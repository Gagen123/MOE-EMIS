<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class StaffLeadershipApplication extends Migration
{
    public function up(){
        Schema::create('staff_leadership_application', function (Blueprint $table) {
            $table->char('id',36)->unique()->primary();
            $table->char('application_number',36)->nullable(false);
            $table->char('leadership_id',36)->nullable(false);
            $table->foreign('leadership_id')->references('id')->on('staff_leadership_detials');
            $table->char('staff_id',36)->nullable(false);
            $table->char('dzongkhag_id',36)->nullable(false);
            $table->char('org_id',36)->nullable(false);
            $table->char('accessLevel',50)->nullable(false);
            $table->char('remarks',255)->nullable(true);
            $table->char('shortlisted_remarks',255)->nullable(true);
            $table->char('shortlisted_by',36)->nullable(true);
            $table->timestamp('shortlisted_at')->nullable(true);
            $table->string('feedback_remarks',255)->nullable(true);
            $table->string('feedback_details',255)->nullable(true);
            $table->date('feedback_start_date')->nullable(true);
            $table->date('feedback_end_date')->nullable(true);
            $table->char('feedback_updated_by',36)->nullable(true);
            $table->date('interniew_date')->nullable(true);
            $table->string('interniew_score',11)->nullable(true);
            $table->timestamp('interview_updated_at')->nullable(true);
            $table->char('interview_updated_by',36)->nullable(true);
            $table->timestamp('rejected_at')->nullable(true);
            $table->char('rejected_by',36)->nullable(true);
            $table->string('rejected_remarks',255)->nullable(true);
            $table->timestamp('feedback_updated_date')->nullable(true);
            $table->char('selected_by',36)->nullable(true);
            $table->string('selected_remarks',255)->nullable(true);
            $table->timestamp('selected_at')->nullable(true);
            $table->char('created_by',36)->nullable(true);
            $table->char('status',100)->default('Submitted');
            $table->char('updated_by',36)->nullable(true);
            $table->timestamp('created_at')->nullable(true);
            $table->timestamp('updated_at')->nullable(true);
            $table->date('effective_data')->nullable(true);

        });
    }

    public function down(){
        Schema::dropIfExists('staff_leadership_application');
    }
}
