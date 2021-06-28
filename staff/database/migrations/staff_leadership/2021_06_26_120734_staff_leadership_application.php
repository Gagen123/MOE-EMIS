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
            $table->char('created_by',36)->nullable(true);
            $table->char('status',20)->default('Submitted');
            $table->char('updated_by',36)->nullable(true);
            $table->timestamp('created_at')->nullable(true);
            $table->timestamp('updated_at')->nullable(true);
        });
    }

    public function down(){
        Schema::dropIfExists('staff_leadership_application');
    }
}
