<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateHaisoujouhouTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('haisoujouhou', function(Blueprint $table)
		{
			$table->integer('haisoubango')->nullable();
			$table->string('kaiinbango', 50)->nullable();
			$table->string('zokugara', 50)->nullable();
			$table->string('name', 100)->nullable();
			$table->string('yubinbango', 10)->nullable();
			$table->string('address', 200)->nullable();
			$table->string('tel', 15)->nullable();
			$table->string('mail', 100)->nullable();
			$table->dateTime('birthday')->nullable();
			$table->string('sex', 10)->nullable();
			$table->integer('point')->nullable();
			$table->string('bunrui1', 50)->nullable();
			$table->string('bunrui2', 50)->nullable();
			$table->string('bunrui3', 50)->nullable();
			$table->string('bunrui4', 50)->nullable();
			$table->string('bunrui5', 50)->nullable();
			$table->integer('syukei1')->nullable();
			$table->integer('syukei2')->nullable();
			$table->integer('syukei3')->nullable();
			$table->integer('syukei4')->nullable();
			$table->integer('syukei5')->nullable();
			$table->string('netusername', 100)->nullable();
			$table->string('netuserpasswd', 50)->nullable();
			$table->string('netlogin', 20)->nullable();
			$table->integer('kounyusu')->nullable();
			$table->bigInteger('kingakugoukei')->nullable();
			$table->string('syukeitukikijun', 10)->nullable();
			$table->string('syukeituki', 150)->nullable();
			$table->string('syukeikikijun', 10)->nullable();
			$table->string('syukeiki', 20)->nullable();
			$table->string('syukeinenkijun', 10)->nullable();
			$table->string('syukeinen', 10)->nullable();
			$table->integer('starttime')->nullable();
			$table->integer('endtime')->nullable();
			$table->string('bunrui6', 200)->nullable();
			$table->string('bunrui7', 200)->nullable();
			$table->string('bunrui8', 200)->nullable();
			$table->string('bunrui9', 200)->nullable();
			$table->string('bunrui10', 200)->nullable();
			$table->integer('syukei6')->nullable();
			$table->integer('syukei7')->nullable();
			$table->integer('syukei8')->nullable();
			$table->integer('syukei9')->nullable();
			$table->integer('syukei10')->nullable();
			$table->string('datatxt0050', 100)->nullable();
			$table->string('datatxt0051', 100)->nullable();
			$table->string('datatxt0052', 100)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('haisoujouhou');
	}

}
