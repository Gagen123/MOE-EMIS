<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;;

class StfPersonalDetails extends Migration{
    public function up(){
        Schema::create('stf_staff', function (Blueprint $table) {
            $table->char('id',36)->unique()->primary();
            $table->string('emp_id',20)->nullable(true);
            $table->char('emp_type_id',36)->nullable(false);
            $table->string('name',250)->nullable(false);
            $table->string('cid_work_permit',100)->nullable(false);
            $table->char('contract_category',36)->nullable(false);
            $table->string('sex_id',100)->nullable(true);
            $table->date('dob',20)->nullable(true);
            $table->char('working_agency_id',36)->nullable(false);
            $table->char('org_level',36)->nullable(false);
            $table->char('position_title_id',36)->nullable(false);
            $table->char('position_sub_level_id',36)->nullable(false);
            $table->char('merital_status',36)->nullable(true);
            $table->char('country_id',36)->nullable(false);
            $table->char('p_dzongkhag',36)->nullable(true);
            $table->char('p_gewog',36)->nullable(true);
            $table->char('p_village',36)->nullable(true);
            $table->char('dzo_id',36)->nullable(true);
            $table->char('geowg_id',36)->nullable(true);
            $table->char('village_id',36)->nullable(true);
            $table->string('address',255)->nullable(true);
            $table->string('email',100)->nullable(false);
            $table->string('alternative_email',100)->nullable(true);
            $table->string('contact_no',8)->nullable(false);
            $table->char('comp_sub_id',36)->nullable(true);
            $table->char('elective_sub_id1',36)->nullable();
            $table->char('elective_sub_id2',36)->nullable();
            $table->char('cureer_stagge_id',36)->nullable();
            $table->tinyInteger('is_sen')->nullable(true);
            $table->tinyInteger('is_trained_in_sen')->nullable(true);
            $table->char('employee_code',100)->nullable(true);
            $table->char('initial_appointment_date',50)->nullable();
            $table->string('sen_remarks')->nullable(true);
            $table->string('currier_stage_remarks')->nullable(true);
            $table->string('remarks')->nullable(true);
            $table->string('created_by',36)->nullable(true);
            $table->string('updated_by',36)->nullable(true);
            $table->timestamp('created_at')->nullable(true);
            $table->timestamp('updated_at')->nullable(true);
            $table->enum('status', ['Pending', 'Created'])->default('Pending')->nullable(false);
        });
    }

    public function down(){
        Schema::dropIfExists('stf_staff');
    }
}
