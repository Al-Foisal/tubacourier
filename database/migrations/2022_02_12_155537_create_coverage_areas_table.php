<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoverageAreasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coverage_areas', function (Blueprint $table) {
            
            $table->bigIncrements('id');    
            $table->string('district');
            $table->string('area');
            $table->string('post_code');
            $table->string('home_delivery');
            $table->string('charge_1kg');
            $table->string('charge_2kg');
            $table->string('charge_3kg');
            $table->string('code_charge');

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
        Schema::dropIfExists('coverage_areas');
    }
}
