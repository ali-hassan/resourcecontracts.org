<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class UpdateAnnotationTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('contract_annotations', function(Blueprint $table) {
			$table->string('category')->nullable();
			$table->text('text')->nullable();
		});

        DB::update("update contract_annotations set category = annotation->>'category', text ,,= annotation->>'text'");
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('contract_annotations', function(Blueprint $table) {
			$table->dropColumn('text');
			$table->dropColumn('category');
		});
	}

}
