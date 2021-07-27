<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffAppealsTable extends Migration
{
    public function up(){
        Schema::create('staff_appeals', function (Blueprint $table) {
            $table->varchar('id',36)->unique()->primary();
            $table->char('transferType',36);
            $table->char('name',150);
            $table->char('application_no',36);
            $table->char('description',250);
            $table->varchar('org_id',36);
            $table->char('status',10);
            $table->varchar('created_by',36);
            $table->varchar('updated_by',36);
            $table->timestamp('created_at')->nullable(true);
            $table->timestamp('updated_at')->nullable(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('staff_appeals');
    }
}
