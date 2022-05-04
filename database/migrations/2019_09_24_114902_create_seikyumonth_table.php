<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSeikyumonthTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('seikyumonth', function(Blueprint $table)
		{
			$table->integer('kokyakubango')->nullable();
			$table->bigInteger('kingaku')->nullable();
			$table->bigInteger('nyukinkingaku')->nullable();
			$table->dateTime('shimebi')->nullable();
			$table->bigInteger('syouhizei')->nullable();
			$table->string('bikou', 10)->nullable();
			$table->bigInteger('kurikoshi')->nullable();
			$table->bigInteger('sougaku')->nullable();
			$table->integer('syouhizeikubun')->nullable();
			$table->smallInteger('syouhizeiritu')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('seikyumonth');
	}

}
