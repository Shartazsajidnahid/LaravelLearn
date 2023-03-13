<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDivisionAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('division_admins', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('admin_id')->index('FK_sys_users');
            $table->bigInteger('division_id')->index('FK_sys_divisions');
            $table->bigInteger('department_id')->index('FK_sys_departments');
            $table->bigInteger('unit_id')->index('FK_sys_units');
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
        Schema::dropIfExists('division_admins');
    }
}
