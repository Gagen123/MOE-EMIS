<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class OrgProfile extends Migration{
    public function up() {
        Schema::create('organization_profile', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->char('org_id',36);
            $table->string('mission');
            $table->string('vission');
            $table->string('logo_path');
            $table->char('created_by',36)->nullable(true);
            $table->char('updated_by',36)->nullable(true);
            $table->timestamps();
        });
    }

    public function down()    {
        Schema::dropIfExists('organization_profile');
    }
}
