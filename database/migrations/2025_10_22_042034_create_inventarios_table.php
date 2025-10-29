<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventariosTable extends Migration
{
    public function up()
    {
        Schema::create('inventarios', function (Blueprint $table) {
            $table->id();
            $table->string('producto_nombre');
            $table->integer('cantidad');
            $table->decimal('precio', 8, 2);
            $table->date('fecha_actualizacion');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('inventarios');
    }
}