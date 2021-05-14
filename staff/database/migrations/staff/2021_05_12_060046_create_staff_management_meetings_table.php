<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffManagementMeetingsTable extends Migration
{

    public function up()
    {
        Schema::create('staff_management_meetings', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->date('meeting_date')->nullable(false);
            $table->string('start_time')->nullable(false);
            $table->string('end_time')->nullable(false);
            $table->string('venue')->nullable(false);
            $table->string('status')->nullable(false);
            $table->string('created_by',36)->nullable(true);
            $table->string('updated_by',36)->nullable(true);
            $table->timestamps();
        });

    }
    public function down()
    {
        Schema::dropIfExists('staff_management_meetings');
    }
}

