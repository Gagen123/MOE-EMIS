<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganizationIncomeFacilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organization_income_facilities', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('organization_details_id',36);
            $table->char('amountgenerated');
            $table->char('date');
            $table->char('remarks');
            $table->char('created_by',36)->nullable(true);
            $table->char('updated_by',36)->nullable(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('organization_income_facilities');
    }
}
