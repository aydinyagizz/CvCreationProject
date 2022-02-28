<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('education', function (Blueprint $table) {
            $table->id();

            $table->string('education_date')->nullable(); //nulltable; boş olabilir demek.
            $table->string('university_name')->nullable(); //nulltable; boş olabilir demek.
            $table->string('university_branch')->nullable(); //nulltable; boş olabilir demek.
            $table->string('description')->nullable(); //nulltable; boş olabilir demek.

            $table->timestamps(); //created_at ve updated_at alanlarınıın oluşmasını sağlıyor.
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('education');
    }
};
