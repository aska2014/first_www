<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSliderItemsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('site_slider_items', function(Blueprint $table)
		{
			$table->increments('id');
            // English information
            $table->string('en_title');
            $table->string('en_description');

            // Arabic information
            $table->string('ar_title');
            $table->string('ar_description');

            $table->integer('slider_id')->unsigned();
            $table->foreign('slider_id')->references('id')->on('site_sliders')->onDelete('CASCADE')->onUpdate('CASCADE');

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
		Schema::drop('slider_items');
	}

}
