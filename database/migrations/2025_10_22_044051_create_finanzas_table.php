<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('finanzas', function (Blueprint $table) {
            $table->id();
            $table->enum('tipo', ['ingreso', 'egreso']);
            $table->decimal('monto', 10, 2);
            $table->date('fecha');
            $table->string('descripcion');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('finanzas');
    }
};