<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrdertypeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ordertype', function(Blueprint $table)
		{
			$table->integer('bango', true);
			$table->string('type', 50)->nullable();
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
		Schema::drop('ordertype');
	}

}
