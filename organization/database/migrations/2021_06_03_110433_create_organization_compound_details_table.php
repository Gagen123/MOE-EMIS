<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganizationCompoundDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *   
     * @return void
     */
    public function up()
    {
        Schema::create('organization_compound_details', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->char('organizationId',36);
            $table->char('thramNo',36);
            $table->char('plotNo',36);
            $table->string('pegInformation');
            $table->char('compoundArea',36);
            $table->char('playgroundArea',36);
            $table->char('playgroundAreaUsable',36);
            $table->char('status',36);
            $table->char('agricultureArea',36);
            $table->char('agricultureAreaUsed',36);
            $table->char('created_by',36)->nullable(true);
            $table->char('updated_by',36)->nullable(true);
            $table->timestamps('created_at',36)->nullable(true);
            $table->timestamps('updated_at',36)->nullable(true);
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('organization_compound_details');
    }
}
