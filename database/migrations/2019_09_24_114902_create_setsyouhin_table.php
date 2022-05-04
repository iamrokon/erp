<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSetsyouhinTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('setsyouhin', function(Blueprint $table)
		{
			$table->string('name', 100)->nullable();
			$table->smallInteger('setsu')->nullable();
			$table->integer('setbango')->nullable();
			$table->smallInteger('syoyousu')->nullable();
			$table->string('setsyouhin', 5000)->nullable();
			$table->integer('kakaku')->nullable();
			$table->integer('kakaku2')->nullable();
			$table->integer('kakaku3')->nullable();
			$table->string('name2', 100)->nullable();
			$table->string('name3', 100)->nullable();
			$table->string('name4', 100)->nullable();
			$table->string('name5', 100)->nullable();
			$table->string('setsyouhin2', 5000)->nullable();
			$table->string('setsyouhin3', 5000)->nullable();
			$table->integer('kakaku4')->nullable();
			$table->integer('kakaku5')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('setsyouhin');
	}

}
