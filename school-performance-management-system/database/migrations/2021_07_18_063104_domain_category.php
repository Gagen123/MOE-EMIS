<?php

use Database\Seeders\DomainCategorySeeder;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DomainCategory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spm_domain_category', function (Blueprint $table) {
            $table->unsignedTinyInteger('id')->primary();
            $table->string('name',50);
            $table->char('created_by',36);
            $table->timestamps();

        });
        $seeder = new DomainCategorySeeder();
        $seeder->run();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('spm_domain_category');
    }
}
