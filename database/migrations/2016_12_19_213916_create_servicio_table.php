<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateServicioTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('servicio', function(Blueprint $table)
		{
			$table->bigInteger('id_servicio', true);
			$table->bigInteger('id_estatus')->index('id_estatus');
			$table->bigInteger('id_operadora')->index('id_operadora');
			$table->bigInteger('id_tipo_servicios')->index('id_tipo_servicios');
			$table->string('creado_por', 16)->nullable();
			$table->string('nombre', 100)->nullable()->comment('Nombre del equipo o del servicio');
			$table->string('telefono_circuito', 11)->nullable()->comment('Puede ser numero de telefonos o circuitos');
			$table->string('imei', 30)->nullable()->unique('imei');
			$table->string('modelo', 30)->nullable();
			$table->string('fcc', 20)->nullable();
			$table->integer('estatus')->nullable();
			$table->boolean('propio')->nullable();
			$table->dateTime('fecha_creacion')->nullable();
			$table->date('fecha_finalicion_contrato')->nullable();
			$table->date('fecha_inicio_contrato')->nullable();
			$table->string('costo_plan', 20)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('servicio');
	}

}
