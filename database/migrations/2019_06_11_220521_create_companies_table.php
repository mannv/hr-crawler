<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateCompaniesTable.
 */
class CreateCompaniesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('companies', function(Blueprint $table) {
            $table->increments('id');
            $table->string('source');
            $table->string('base_url');
            $table->boolean('is_crawler')->default(false);
            $table->string('name');
            $table->string('member_scale')->nullable();
            $table->json('country')->nullable();
            $table->string('location')->nullable();
            $table->json('address')->nullable();
            $table->string('phone_number')->nullable();
            $table->date('founding_date')->nullable();
            $table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('companies');
	}
}
