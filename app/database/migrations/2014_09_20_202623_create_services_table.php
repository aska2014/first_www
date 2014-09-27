<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('site_services', function(Blueprint $table)
		{
            $table->engine = 'InnoDB';
            $table->increments('id');

            $table->string('slug')->unique();

            // English information
            $table->string('en_title');
            $table->string('en_small_description');
            $table->string('en_long_description');

            // Arabic information
            $table->string('ar_title');
            $table->string('ar_small_description');
            $table->string('ar_long_description');

            $table->integer('category_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('site_service_categories')->onDelete('CASCADE')->onUpdate('CASCADE');

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
		Schema::drop('services');
	}

}
