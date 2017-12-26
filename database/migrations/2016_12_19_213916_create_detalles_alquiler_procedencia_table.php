<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDetallesAlquilerProcedenciaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('detalles_alquiler_procedencia', function(Blueprint $table)
		{
			$table->bigInteger('id_detalles_alquiler_procedencia', true);
			$table->string('nombre_inquilino', 20)->nullable();
			$table->date('fecha_alquiler')->nullable();
			$table->string('persona_contacto', 40)->nullable();
			$table->string('tlf_persona_contacto', 11)->nullable();
			$table->boolean('activo')->nullable();
			$table->dateTime('fecha_crecion')->nullable();
			$table->bigInteger('id_procedencia')->index('id_procedencia');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('detalles_alquiler_procedencia');
	}

}
