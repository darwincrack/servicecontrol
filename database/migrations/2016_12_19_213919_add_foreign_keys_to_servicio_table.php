<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToServicioTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('servicio', function(Blueprint $table)
		{
			$table->foreign('id_operadora', 'servicio_ibfk_1')->references('id_operadora')->on('operadora')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('id_tipo_servicios', 'servicio_ibfk_2')->references('id_tipo_servicios')->on('tipo_servicios')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('id_estatus', 'servicio_ibfk_3')->references('id_estatus')->on('estatus')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('servicio', function(Blueprint $table)
		{
			$table->dropForeign('servicio_ibfk_1');
			$table->dropForeign('servicio_ibfk_2');
			$table->dropForeign('servicio_ibfk_3');
		});
	}

}
