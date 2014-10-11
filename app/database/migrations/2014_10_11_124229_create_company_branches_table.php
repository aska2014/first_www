<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyBranchesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('company_branches', function(Blueprint $table)
		{
			$table->increments('id');

            $table->string('en_title');
            $table->string('en_sub_title');
            $table->text('en_address');

            $table->string('ar_title');
            $table->string('ar_sub_title');
            $table->text('ar_address');

            $table->string('gps_latitude');
            $table->string('gps_longitude');

            $table->string('mobile_no');
            $table->string('email');

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
		Schema::drop('company_branches');
	}

}
