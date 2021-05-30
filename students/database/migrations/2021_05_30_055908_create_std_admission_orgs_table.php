<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStdAdmissionOrgsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('std_admission_orgs', function (Blueprint $table) {
            $table->char('id',36)->primary();
            $table->char('std_admission_id', 36)->index();
            $table->uuid('application_id');
            $table->char('OrgOrganizationId',36);
            $table->date('date_of_application');
            $table->string('remarks')->nullable();
            $table->tinyInteger('std_decission')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();

            $table->foreign('std_admission_id')->references('id')->on('std_admissions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('std_admission_orgs');
    }
}
