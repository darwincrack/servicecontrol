<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToProcedenciaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('procedencia', function(Blueprint $table)
		{
			$table->foreign('id_ciudad', 'procedencia_ibfk_1')->references('id_ciudad')->on('ciuidad')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('id_tipo_procedencia', 'procedencia_ibfk_2')->references('id_tipo_procedencia')->on('tipo_procedencia')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('procedencia', function(Blueprint $table)
		{
			$table->dropForeign('procedencia_ibfk_1');
			$table->dropForeign('procedencia_ibfk_2');
		});
	}

}
