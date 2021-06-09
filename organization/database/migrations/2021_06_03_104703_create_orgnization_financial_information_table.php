<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganizationFinancialInformationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organization_financial_information', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('organizationId',36);
            $table->uuid('financialInformationId',36);
            $table->char('amount');
            $table->char('date');
            $table->char('status');
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
        Schema::dropIfExists('organization_financial_informations');
    }
}
