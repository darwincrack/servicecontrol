<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDetalleProcedenciaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('detalle_procedencia', function(Blueprint $table)
		{
			$table->bigInteger('id_detalle_procedencia', true);
			$table->bigInteger('id_procedencia')->index('id_procedencia');
			$table->bigInteger('id_servicio')->index('id_servicio');
			$table->dateTime('fecha_creacion')->nullable();
			$table->boolean('activo')->nullable();
			$table->string('creado_por', 16)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('detalle_procedencia');
	}

}
