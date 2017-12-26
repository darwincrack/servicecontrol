<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTipoProcedenciaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tipo_procedencia', function(Blueprint $table)
		{
			$table->bigInteger('id_tipo_procedencia', true);
			$table->string('nombre', 40)->nullable()->unique('nombre');
			$table->string('descripcion', 40)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tipo_procedencia');
	}

}
