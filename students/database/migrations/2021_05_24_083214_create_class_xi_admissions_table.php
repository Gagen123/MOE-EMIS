<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassXiAdmissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('class_xi_admissions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->char('org_id',36)->nullable();
            $table->char('dzo_id',36)->nullable();
            $table->char('class_id',36)->nullable();
            $table->char('dateOfapply',36)->nullable();
            $table->char('remarks',36)->nullable();
            $table->char('stream_id',36)->nullable();
            $table->char('created_by',36)->nullable(true);
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
        Schema::dropIfExists('class_xi_admissions');
    }
}
