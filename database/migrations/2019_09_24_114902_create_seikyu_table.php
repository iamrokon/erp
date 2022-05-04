<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSeikyuTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('seikyu', function(Blueprint $table)
		{
			$table->integer('bango', true);
			$table->integer('kokyakubango')->nullable();
			$table->bigInteger('kingaku')->nullable();
			$table->bigInteger('nyukinkingaku')->nullable();
			$table->dateTime('shimebi')->nullable();
			$table->dateTime('seikyubi')->nullable();
			$table->dateTime('nyukinyoteibi')->nullable();
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
		Schema::drop('seikyu');
	}

}
