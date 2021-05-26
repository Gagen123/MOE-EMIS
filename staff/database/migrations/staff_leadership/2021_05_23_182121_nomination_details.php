<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class NominationDetails extends Migration{
    
    public function up(){
        Schema::create('staff_leadership_nomination_detials', function (Blueprint $table) {
            $table->char('id',36)->unique()->primary();
            $table->char('leadership_id',36)->nullable(false);
            $table->foreign('leadership_id')->references('id')->on('staff_leadership_detials');
            $table->char('staff_id',36)->nullable(false);
            $table->char('dzongkhag_id',36)->nullable(false);
            $table->char('org_id',36)->nullable(false);
        });
    }

    public function down(){
        Schema::dropIfExists('staff_leadership_nomination_detials');
    }
}
