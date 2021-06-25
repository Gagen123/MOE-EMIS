<<<<<<< HEAD
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class StaffLeaveConfig extends Migration
{
    public function up(){
    
        Schema::create('master_staff_transfer_config_details', function (Blueprint $table){
            $table->char('id',36)->unique()->primary();
            $table->char('transfer_config_id',36)->nullable(false);
            $table->char('authority_type_id',36)->nullable(false);
            $table->char('sequence',11)->nullable(false);
            $table->string('role_id',36)->nullable(true);
        });
    }

    public function down(){
        Schema::dropIfExists('master_staff_transfer_config_details');
    }
}
=======
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class StaffLeaveConfig extends Migration
{
    public function up(){
    
        Schema::create('master_staff_transfer_config_details', function (Blueprint $table){
            $table->char('id',36)->unique()->primary();
            $table->char('transfer_config_id',36)->nullable(false);
            $table->char('authority_type_id',36)->nullable(false);
            $table->char('sequence',11)->nullable(false);
            $table->string('role_id',36)->nullable(true);
        });
    }

    public function down(){
        Schema::dropIfExists('master_staff_transfer_config_details');
    }
}
>>>>>>> bf0bede62ca5b1425e5a9cb6c5f4674a839f5aba
