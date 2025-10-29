<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('ventas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('producto_id')->constrained('inventarios')->onDelete('cascade');
            $table->integer('cantidad_vendida');
            $table->decimal('total', 10, 2);
            $table->date('fecha_venta');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ventas');
    }
};