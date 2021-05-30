<<<<<<< HEAD
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockReceivedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_receiveds', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->date('dateOfreceived',36);
            $table->char('quarter_id',36);
            $table->string('remarks');
            $table->char('organizationId',36)->nullable(false);
            $table->char('created_by',36)->nullable(true);
            $table->char('updated_by',36)->nullable(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stock_receiveds');
    }
}
=======
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockReceivedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_receiveds', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->date('dateOfreceived',36);
            $table->char('term_id',36);
            $table->string('remarks');
            $table->char('organizationId',36)->nullable(false);
            $table->char('created_by',36)->nullable(true);
            $table->char('updated_by',36)->nullable(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stock_receiveds');
    }
}
>>>>>>> 19c11771b5c9e7268c1cd32088b5e69342ffa6ab
