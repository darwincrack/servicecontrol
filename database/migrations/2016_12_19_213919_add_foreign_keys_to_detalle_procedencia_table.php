<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToDetalleProcedenciaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('detalle_procedencia', function(Blueprint $table)
		{
			$table->foreign('id_procedencia', 'detalle_procedencia_ibfk_1')->references('id_procedencia')->on('procedencia')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('id_servicio', 'detalle_procedencia_ibfk_2')->references('id_servicio')->on('servicio')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('detalle_procedencia', function(Blueprint $table)
		{
			$table->dropForeign('detalle_procedencia_ibfk_1');
			$table->dropForeign('detalle_procedencia_ibfk_2');
		});
	}

}
