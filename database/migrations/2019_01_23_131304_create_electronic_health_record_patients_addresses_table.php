<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateElectronicHealthRecordPatientsAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('electronic_health_record_patients_addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('street', 256)->nullable(true);
            $table->string('number', 10)->nullable(true);
            $table->string('apartment_number', 10)->nullable(true);
            $table->string('neighbourhood', 256)->nullable(true);
            $table->string('city', 256)->nullable(true);
            $table->string('zip_code', 10)->nullable(true);
            $table->string('state', 10)->nullable(true);
            $table->timestamps();
            $table->integer('created_user')->nullable(true);
            $table->integer('updated_user')->nullable(true);
            $table->integer('deleted_user')->nullable(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('electronic_health_record_patients_addresses');
    }
}
