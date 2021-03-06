<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffManagementMeetingMinutesTable extends Migration
{
    public function up()
    {
        Schema::create('staff_management_meeting_minutes', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->char('meeting_id',36)->nullable(false);
            $table->string('minutes')->nullable(false);
            $table->string('status')->nullable(false);
            $table->string('created_by',36)->nullable(true);
            $table->string('updated_by',36)->nullable(true);
            $table->timestamps();
        });

    }
    public function down()
    {
        Schema::dropIfExists('staff_management_meeting_minutes');
    }
}
