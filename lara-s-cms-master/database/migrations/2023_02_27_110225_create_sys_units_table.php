<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSysUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sys_units', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('department_id')->index('FK_sys_departments');
            $table->string('name');
            $table->string('location')->nullable();
            $table->string('phone')->nullable();
            $table->boolean('status')->default(1);
            $table->unsignedInteger('ordinal')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sys_units');
    }
}
