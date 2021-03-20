<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Country extends Migration{
    public function up(){
        Schema::create('country_master', function (Blueprint $table) {
            $table->char('id',36)->unique()->primary();
            $table->string('country_name',150)->nullable(false);
            $table->string('nationality',150)->nullable(false);
            $table->char('code',4)->nullable(false);
            $table->boolean('status')->default(1);
            $table->string('created_by',36)->nullable(true);
            $table->string('updated_by',50)->nullable(true);
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }
    public function down() {
        Schema::dropIfExists('country_master');
    }
}
//create migration 
//php artisan make:migration country --path database/migrations/global_masters
//migrate migration
//php artisan migrate:refresh --path database/migrations/global_masters
