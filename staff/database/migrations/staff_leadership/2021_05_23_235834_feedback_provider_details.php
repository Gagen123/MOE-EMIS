<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FeedbackProviderDetails extends Migration
{
    public function up(){
        Schema::create('staff_leadership_nominee_feedback_detials', function (Blueprint $table) {
            $table->char('id',36)->unique()->primary();
            $table->char('leadership_id',36)->nullable(false);
            $table->foreign('leadership_id')->references('id')->on('staff_leadership_detials');
            $table->char('staff_id',36)->nullable(true);
            $table->foreign('staff_id')->references('id')->on('stf_staff');
            $table->char('staff_type',36)->nullable(false);
            $table->char('cid',36)->nullable(false);
            $table->char('name',36)->nullable(false);
            $table->char('email',36)->nullable(false);
            $table->char('feedback_id',36)->nullable(false);
            $table->char('nominees_id',36)->nullable(false);
            $table->foreign('nominees_id')->references('id')->on('staff_leadership_nomination_detials');
            $table->char('created_by',36)->nullable(false);
        });
    }

    public function down(){
        Schema::dropIfExists('staff_leadership_nominee_feedback_detials');
    }
}
