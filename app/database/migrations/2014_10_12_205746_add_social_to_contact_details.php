<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSocialToContactDetails extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('contact_details', function(Blueprint $table)
		{
            $table->string('facebook');
            $table->string('twitter');
            $table->string('youtube');
            $table->string('instagram');
            $table->string('linkedin');
            $table->string('google');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('contact_details', function(Blueprint $table)
		{
            $table->dropColumn(['facebook', 'twitter', 'youtube', 'instagram', 'linkedin']);
		});
	}

}
