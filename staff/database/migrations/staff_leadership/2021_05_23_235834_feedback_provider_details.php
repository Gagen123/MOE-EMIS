<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FeedbackProviderDetails extends Migration
{
    public function up(){
        Schema::create('staff_leadership_nominee_feedback_detials', function (Blueprint $table) {
            $table->char('id',36)->unique()->primary();
            $table->char('application_number',36)->nullable(false);
            $table->char('partifipant_from',36)->nullable(true);
            $table->char('participant',36)->nullable(false);
            $table->foreign('participant')->references('id')->on('stf_staff');
            $table->string('positiontitle',200)->nullable();
            $table->char('staff_type',36)->nullable();
            $table->char('cid',36)->nullable(false);
            $table->char('name',36)->nullable(false);
            $table->char('email',36)->nullable();
            $table->char('contact',36)->nullable(false);
            $table->char('department',36)->nullable();
            $table->char('dzongkhag',36)->nullable();
            $table->char('feedback_type',36)->nullable();
            $table->char('school',36)->nullable();
            $table->char('status',50)->default('Pending')->nullable();
            $table->char('created_by',36)->nullable();
            $table->timestamp('created_at')->nullable(true);
            $table->char('updated_by',36)->nullable();
            $table->timestamp('updated_at')->nullable(true);
        });
    }
    public function down(){
        Schema::dropIfExists('staff_leadership_nominee_feedback_detials');
    }
}
