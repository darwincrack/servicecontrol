<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTipoServiciosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tipo_servicios', function(Blueprint $table)
		{
			$table->bigInteger('id_tipo_servicios', true);
			$table->string('nombre', 20)->nullable();
			$table->string('descripccion', 50)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tipo_servicios');
	}

}
