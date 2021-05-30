<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStdAdmissionsTable extends Migration
{
    public function up()
    {
        Schema::create('std_admissions', function (Blueprint $table) {
            $table->char('id',36)->primary();
            $table->uuid('application_id');
            $table->char('OrgOrganizationId',36);
            $table->string('snationality');
            $table->char('student_code',36)->nullable();
            $table->char('CidNo',11)->nullable(false);
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('DateOfBirth',10)->nullable(false);
            $table->char('CmnSexId',36)->nullable(false);
            $table->char('dzongkhag')->nullable();
            $table->char('class_id')->nullable();
            $table->char('stream_id')->nullable();
            $table->char('student_type')->nullable();
            $table->char('dateOfapply')->nullable();
            // $table->char('Remarks')->nullable();
            $table->char('CmnCountryId',36)->nullable();
            $table->char('CmnGewogId',36)->nullable();
            $table->char('CmnChiwogId',36)->nullable();
            $table->char('CmnLanguageId',36)->nullable();
            $table->char('village_id',36)->nullable();
            $table->string('Address')->nullable();
            $table->char('CmnParentsMaritalStatusId')->nullable();
            $table->char('IsNewAdmission')->nullable();
            $table->char('IsTransferred')->nullable();
            $table->char('IsRejoined')->nullable();
            $table->char('PhotoPath')->nullable();
            $table->string('attachments')->nullable();
            $table->string('Status')->nullable();
            $table->char('parent_marital_status',36)->nullable();
            $table->string('primary_contact',50)->nullable();
            $table->char('updated_by',36)->nullable(true);
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
        Schema::create('std_admissions_audit', function (Blueprint $table) {
            $table->uuid('application_id')->nullable();
            $table->uuid('id')->primary();
            $table->char('OrgOrganizationId')->nullable();
            $table->string('snationality');
            $table->char('student_code',36)->nullable();
            $table->char('CidNo',11)->nullable(false);
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('DateOfBirth',10)->nullable(false);
            $table->char('CmnSexId',36)->nullable(false);
            $table->char('dzongkhag')->nullable();
            $table->char('class_id')->nullable();
            $table->char('stream_id')->nullable();
            $table->char('student_type')->nullable();
            $table->char('dateOfapply')->nullable();
            $table->char('Remarks')->nullable();
            $table->char('CmnCountryId',36)->nullable();
            $table->char('CmnGewogId',36)->nullable();
            $table->char('CmnChiwogId',36)->nullable();
            $table->char('CmnLanguageId',36)->nullable();
            $table->char('village_id',36)->nullable();
            $table->string('Address')->nullable();
            $table->char('CmnParentsMaritalStatusId')->nullable();
            $table->char('IsNewAdmission')->nullable();
            $table->char('IsTransferred')->nullable();
            $table->char('IsRejoined')->nullable();
            $table->char('PhotoPath')->nullable();
            $table->string('attachments')->nullable();
            $table->string('Status')->nullable();
            $table->char('parent_marital_status',36)->nullable();
            $table->string('primary_contact',50)->nullable();
            $table->char('updated_by',36)->nullable(true);
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
            Schema::dropIfExists('std_admissions');
            Schema::dropIfExists('std_admissions_audit');
    }
}
