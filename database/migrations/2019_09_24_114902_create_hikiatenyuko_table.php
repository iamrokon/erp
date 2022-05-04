<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateHikiatenyukoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('hikiatenyuko', function(Blueprint $table)
		{
			$table->integer('orderbango')->nullable();
			$table->integer('syouhinbango')->nullable();
			$table->integer('yoteisu')->nullable();
			$table->dateTime('yoteibi')->nullable();
			$table->integer('nyukosu')->nullable();
			$table->dateTime('kanryoubi')->nullable();
			$table->float('kingaku', 10, 0)->nullable();
			$table->float('genka', 10, 0)->nullable();
			$table->smallInteger('syouhizeiritu')->nullable();
			$table->integer('soukobango')->nullable();
			$table->integer('ukeiremotobango')->nullable();
			$table->integer('ukeiresakibango')->nullable();
			$table->integer('nyukosoukobango')->nullable();
			$table->string('tanabango', 250)->nullable();
			$table->string('tantousyabango', 20)->nullable();
			$table->integer('shiharaibango')->nullable();
			$table->integer('denpyobango')->nullable();
			$table->dateTime('denpyohakkoubi')->nullable();
			$table->integer('season')->nullable();
			$table->integer('nengetsu')->nullable();
			$table->integer('weeks')->nullable();
			$table->integer('day')->nullable();
			$table->float('tanka', 10, 0)->nullable();
			$table->integer('zaiko')->nullable();
			$table->string('idoutanabango', 20)->nullable();
			$table->integer('yoteimeter')->nullable();
			$table->integer('nyukometer')->nullable();
			$table->integer('zaikometer')->nullable();
			$table->string('barcode', 100)->nullable();
			$table->string('codename', 20)->nullable();
			$table->dateTime('denpyoshimebi')->nullable();
			$table->float('kawaserate', 10, 0)->nullable();
			$table->string('kawasename', 10)->nullable();
			$table->integer('syouhizeikubun')->nullable();
			$table->string('syouhinname')->nullable();
			$table->dateTime('yoyakubi')->nullable();
			$table->string('kaiinid', 20)->nullable();
			$table->string('syouhinid', 100)->nullable();
			$table->smallInteger('syouhinsyu')->nullable();
			$table->smallInteger('hantei')->nullable();
			$table->string('recordnumber', 50)->nullable();
			$table->string('tankano', 20)->nullable();
			$table->string('syouhinbukacd', 20)->nullable();
			$table->string('hanbaibukacd', 20)->nullable();
			$table->integer('dataint01')->nullable();
			$table->integer('dataint02')->nullable();
			$table->integer('dataint03')->nullable();
			$table->integer('dataint04')->nullable();
			$table->integer('dataint05')->nullable();
			$table->integer('dataint06')->nullable();
			$table->integer('dataint07')->nullable();
			$table->integer('dataint08')->nullable();
			$table->integer('dataint09')->nullable();
			$table->integer('dataint10')->nullable();
			$table->float('dataint11', 10, 0)->nullable();
			$table->float('dataint12', 10, 0)->nullable();
			$table->float('dataint13', 10, 0)->nullable();
			$table->float('dataint14', 10, 0)->nullable();
			$table->float('dataint15', 10, 0)->nullable();
			$table->float('dataint16', 10, 0)->nullable();
			$table->float('dataint17', 10, 0)->nullable();
			$table->float('dataint18', 10, 0)->nullable();
			$table->float('dataint19', 10, 0)->nullable();
			$table->float('dataint20', 10, 0)->nullable();
			$table->float('dataint21', 10, 0)->nullable();
			$table->float('dataint22', 10, 0)->nullable();
			$table->float('dataint23', 10, 0)->nullable();
			$table->float('dataint24', 10, 0)->nullable();
			$table->float('dataint25', 10, 0)->nullable();
			$table->float('dataint26', 10, 0)->nullable();
			$table->float('dataint27', 10, 0)->nullable();
			$table->float('dataint28', 10, 0)->nullable();
			$table->float('dataint29', 10, 0)->nullable();
			$table->float('dataint30', 10, 0)->nullable();
			$table->string('datachar01', 50)->nullable();
			$table->string('datachar02', 50)->nullable();
			$table->string('datachar03', 50)->nullable();
			$table->string('datachar04', 1000)->nullable();
			$table->string('datachar05', 1000)->nullable();
			$table->string('datachar06', 1000)->nullable();
			$table->string('datachar07', 1000)->nullable();
			$table->string('datachar08', 1000)->nullable();
			$table->string('datachar09', 1000)->nullable();
			$table->string('datachar10', 1000)->nullable();
			$table->string('datachar11', 1000)->nullable();
			$table->string('datachar12', 1000)->nullable();
			$table->string('datachar13', 1000)->nullable();
			$table->string('datachar14', 1000)->nullable();
			$table->string('datachar15', 1000)->nullable();
			$table->string('datachar16', 1000)->nullable();
			$table->string('datachar17', 1000)->nullable();
			$table->string('datachar18', 1000)->nullable();
			$table->string('datachar19', 1000)->nullable();
			$table->string('datachar20', 1000)->nullable();
			$table->string('datachar21', 1000)->nullable();
			$table->string('datachar22', 1000)->nullable();
			$table->string('datachar23', 1000)->nullable();
			$table->string('datachar24', 1000)->nullable();
			$table->string('datachar25', 1000)->nullable();
			$table->string('datachar26', 1000)->nullable();
			$table->string('datachar27', 1000)->nullable();
			$table->string('datachar28', 1000)->nullable();
			$table->string('datachar29', 1000)->nullable();
			$table->string('datachar30', 1000)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('hikiatenyuko');
	}

}
