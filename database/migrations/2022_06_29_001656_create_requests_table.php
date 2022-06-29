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
        Schema::create('requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('property_id')->constrained()->onDelete('cascade'); // ID DE LA PROPIEDAD QUE SE SOLICITA
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // ID DEL USUARIO QUE SOLICITA LA PROPIEDAD
            $table->string('status')->default('PENDING'); // ESTADO DE LA SOLICITUD (PENDING, APPROVED, DENIED)
            $table->string('message')->nullable(); // MENSAJE DE LA SOLICITUD
            
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
        Schema::dropIfExists('requests');
    }
};
