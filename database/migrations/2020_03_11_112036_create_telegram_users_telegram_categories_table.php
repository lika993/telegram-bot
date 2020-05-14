<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTelegramUsersTelegramCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('telegram_users_telegram_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('telegram_user_id')->unsigned();
              $table->integer('telegram_category_id')->unsigned();
            $table->timestamps();

            $table->foreign('telegram_category_id')
			->references('id')
			->on('telegram_categories')->onDelete('cascade');

			$table->foreign('telegram_user_id')
			->references('telegram_id')
			->on('telegram_users')->onDelete('cascade');

        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('telegram_users_telegram_categories');
    }
}
