<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateKakakuTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('kakaku', function(Blueprint $table)
		{
			$table->integer('syouhinbango')->nullable()->index();
			$table->integer('kakakutaibango')->nullable();
			$table->float('kakaku', 10, 0)->nullable();
			$table->integer('shinkuro')->nullable();
			$table->string('syutenbi', 20)->nullable();
			$table->integer('hanbaisu')->nullable();
			$table->smallInteger('jyougensu')->nullable();
			$table->smallInteger('pointritu')->nullable();
			$table->smallInteger('pcsyuten')->nullable();
			$table->smallInteger('mbsyuten')->nullable();
			$table->smallInteger('hyouji')->nullable();
			$table->smallInteger('kinsyousu')->nullable();
			$table->string('syutenjyouken', 50)->nullable();
			$table->dateTime('syutenstart')->nullable();
			$table->dateTime('syutenend')->nullable();
			$table->string('icon', 20)->nullable();
			$table->integer('yoyaku')->nullable()->default(0);
			$table->integer('yoyakusu')->nullable()->default(0);
			$table->integer('yoyakukanousu')->nullable()->default(0);
			$table->integer('sortbango')->nullable();
			$table->integer('dataint01')->nullable();
			$table->integer('dataint02')->nullable();
			$table->integer('dataint03')->nullable();
			$table->string('datachar01', 50)->nullable();
			$table->string('datachar02', 1000)->nullable();
			$table->string('datachar03', 50)->nullable();
            $table->string('datatxt0080', 50)->nullable();
            $table->string('datatxt0081', 50)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('kakaku');
	}

}
