<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('portfolios_images', function (Blueprint $table) {
            $table->id();
            // Foreign Key için
            $table->bigInteger('portfolio_id')->unsigned();
            $table->string('image');
            $table->tinyInteger('featured')->default(0);
            $table->tinyInteger('status')->default(0);

            $table->foreign('portfolio_id')
                ->references('id')
                ->on('portfolios')
                // onDelete eğer o tablo silinirse bunu da sil diyoruz.
                ->onDelete('cascade');

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
        Schema::dropIfExists('portfolios_images');
    }
};
