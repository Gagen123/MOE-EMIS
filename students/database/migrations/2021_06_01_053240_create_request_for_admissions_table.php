<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestForAdmissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_for_admissions', function (Blueprint $table) {
            $table->uuid('id',36)->primary();
            $table->char('dzongkhag');
            $table->char('school');
            $table->char('class');
            $table->char('stream');
            $table->date('dateOfapply'); 
            $table->char('snationality');
            $table->string('reasons')->nullable();
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
        Schema::dropIfExists('request_for_admissions');
    }
}
