<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateShiharaiTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('shiharai', function(Blueprint $table)
		{
			$table->integer('bango', true);
			$table->integer('kokyakubango')->nullable();
			$table->bigInteger('kingaku')->nullable();
			$table->bigInteger('shiharaikingaku')->nullable();
			$table->dateTime('shimebi')->nullable();
			$table->dateTime('shiharaibi')->nullable();
			$table->dateTime('shiharaiyoteibi')->nullable();
			$table->bigInteger('syouhizei')->nullable();
			$table->string('bikou', 10)->nullable();
			$table->bigInteger('kurikoshi')->nullable();
			$table->bigInteger('sougaku')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('shiharai');
	}

}
