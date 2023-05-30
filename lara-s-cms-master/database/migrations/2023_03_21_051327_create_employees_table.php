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
            $table->bigInteger('department_id')->index('FK_sys_departments')->nullable(true)->change();;
            $table->bigInteger('unit_id')->index('FK_sys_units')->nullable(true)->change();

            $table->bigInteger('designation_id')->index('FK_designations');
            $table->bigInteger('func_designation_id')->index('FK_functional_designations')->nullable(true)->change();;

            $table->string('gender')->nullable(true);
            $table->date('dob')->nullable(true)->change();
            $table->string('mobile')->nullable(true)->change();
            $table->integer('pabx_phone')->nullable(true)->change();
            $table->string('email')->nullable(true)->change();
            $table->integer('office_phone')->nullable(true)->change();
            $table->integer('ip_phone')->nullable(true)->change();
            $table->string('password')->default('12345678');
            $table->string('profile_image')->nullable(true)->change();
            $table->date('joinning_date')->nullable(true);
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
