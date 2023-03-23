<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use PhpOffice\PhpSpreadsheet\Calculation\LookupRef\Unique;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('user_name');

            $table->bigInteger('division_id')->index('FK_sys_divisions');
            $table->bigInteger('branch_id')->index('FK_sys_branches');
            $table->bigInteger('department_id')->index('FK_sys_departments');
            $table->bigInteger('unit_id')->index('FK_sys_units');

            $table->bigInteger('designation_id')->index('FK_designations');
            $table->bigInteger('func_designation_id')->index('FK_functional_designations');

            $table->string('gender');
            $table->date('dob');
            $table->integer('mobile');
            $table->integer('pabx_phone');
            $table->string('email')->unique();
            $table->integer('office_phone');
            $table->integer('ip_phone');
            $table->string('password');
            $table->string('profile_image');
            $table->date('joinning_date');
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
        Schema::dropIfExists('employees');
    }
}
