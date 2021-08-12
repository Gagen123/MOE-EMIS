<?php

use Database\Seeders\DomainCategorySeeder;
use Database\Seeders\DomainSubCategorySeeder;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DomainSubCategory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spm_domain_sub_category', function (Blueprint $table) {
            $table->unsignedTinyInteger('id')->primary();
            $table->unsignedTinyInteger('spm_domain_category_id')->index();
            $table->char('org_class_id',36)->index()->nullable();
            $table->string('name',50);
            $table->char('created_by',36);
            $table->timestamps();

            $table->foreign('spm_domain_category_id')->references('id')->on('spm_domain_category');

        });
        $seeder = new DomainSubCategorySeeder();

        $seeder->run();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('spm_domain_sub_category');
    }
}
