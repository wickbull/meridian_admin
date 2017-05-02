<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnnoncesTranslationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('annonces_translations', function(Blueprint $table)
		{
			$table->increments('id');

			$table->integer('annonce_id')->unsigned();

			$table->string('title');

			$table->string('slug')->index();

			$table->string('subtitle');

			$table->longtext('body')->nullable();

			$table->tinyinteger('is_active')->default(0)->index();

			$table->string('locale')->index();

			$table->unique(['annonce_id','locale']);

    		$table->foreign('annonce_id')->references('id')->on('annonces')->onDelete('cascade');

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('annonces_translations');
	}

}
