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
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('address');
            $table->double('price'); // VALOR EN UF
            $table->string('image')->nullable(); // IMAGEN DE LA PROPIEDAD
            $table->string('description')->nullable(); // DESCRIPCION DE LA PROPIEDAD
            $table->integer('bedrooms')->nullable(); // NUMERO DE DORMITORIOS
            $table->integer('bathrooms')->nullable(); // NUMERO DE BAÑOS
            $table->integer('garage')->default(0); // NUMERO DE ESTACIONAMIENTOS
            $table->string('area')->nullable(); // AREA DE LA PROPIEDAD
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // ID DEL USUARIO QUE OFRECE LA PROPIEDAD

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
        Schema::dropIfExists('properties');
    }
};
