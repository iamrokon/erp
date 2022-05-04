<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTuhanorderTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tuhanorder', function(Blueprint $table)
		{
			$table->integer('orderbango')->primary('tuhanorder_pkey');
			$table->string('juchubango', 50)->nullable();
			$table->string('chumonbango', 50)->nullable();
			$table->string('juchukubun1', 1000)->nullable();
			$table->string('juchukubun2', 50)->nullable();
			$table->dateTime('chumondate')->nullable();
			$table->dateTime('otodokedate')->nullable();
			$table->string('otodoketime', 20)->nullable();
			$table->integer('chumonsyabango')->nullable();
			$table->integer('soufusakibango')->nullable();
			$table->string('kessaihouhou', 50)->nullable();
			$table->string('housoukubun', 20)->nullable();
			$table->string('chumonsyajouhou', 100)->nullable();
			$table->string('soufusakijouhou', 100)->nullable();
			$table->integer('numeric1')->nullable();
			$table->integer('numeric2')->nullable();
			$table->integer('numeric3')->nullable();
			$table->integer('numeric4')->nullable();
			$table->integer('numeric5')->nullable();
			$table->bigInteger('numericmax')->nullable();
			$table->integer('money1')->nullable();
			$table->integer('money2')->nullable();
			$table->integer('money3')->nullable();
			$table->integer('money4')->nullable();
			$table->integer('money5')->nullable();
			$table->bigInteger('moneymax')->nullable();
			$table->string('information1', 50)->nullable();
			$table->string('information2', 50)->nullable();
			$table->string('information3', 50)->nullable();
			$table->string('information4', 50)->nullable();
			$table->string('information5', 1000)->nullable();
			$table->integer('nyukingaku')->nullable();
			$table->integer('unsoudaibikitesuryou')->nullable();
			$table->integer('unsoutesuryou')->nullable();
			$table->integer('unsouinchigaku')->nullable();
			$table->integer('unsousplittesuryou')->nullable();
			$table->string('youbou', 1000)->nullable();
			$table->string('affbango', 20)->nullable();
			$table->integer('syukei1')->nullable();
			$table->integer('syukei2')->nullable();
			$table->integer('syukei3')->nullable();
			$table->integer('syukei4')->nullable();
			$table->integer('syukei5')->nullable();
			$table->string('text1', 1000)->nullable();
			$table->string('text2', 1000)->nullable();
			$table->string('text3', 1000)->nullable();
			$table->string('text4', 1000)->nullable();
			$table->string('text5', 1000)->nullable();
			$table->integer('numeric6')->nullable();
			$table->integer('numeric7')->nullable();
			$table->integer('numeric8')->nullable();
			$table->integer('numeric9')->nullable();
			$table->integer('numeric10')->nullable();
			$table->float('money6', 10, 0)->nullable();
			$table->float('money7', 10, 0)->nullable();
			$table->float('money8', 10, 0)->nullable();
			$table->float('money9', 10, 0)->nullable();
			$table->float('money10', 10, 0)->nullable();
			$table->string('information6', 1000)->nullable();
			$table->string('information7', 1000)->nullable();
			$table->string('information8', 1000)->nullable();
			$table->string('information9', 1000)->nullable();
			$table->string('information10', 1000)->nullable();
			$table->index(['orderbango','soufusakibango'], 'tuhanorder_orderbango_syukkosakibango_index');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tuhanorder');
	}

}
