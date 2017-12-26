<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProcedenciaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('procedencia', function(Blueprint $table)
		{
			$table->bigInteger('id_procedencia', true);
			$table->bigInteger('id_ciudad')->index('id_ciudad');
			$table->bigInteger('id_tipo_procedencia')->index('id_tipo_procedencia');
			$table->string('nombre', 50)->nullable();
			$table->boolean('activo')->nullable();
			$table->string('motivo', 200)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('procedencia');
	}

}
