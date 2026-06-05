<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('ventas_cabecera', function (Blueprint $table) {
            $table->string('tipo_entrega')->default('retiro'); // 'retiro' o 'envio'
            $table->string('direccion_envio')->nullable();
            $table->string('telefono_contacto')->nullable();
            $table->decimal('costo_envio', 10, 2)->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('ventas_cabecera', function (Blueprint $table) {
            $table->dropColumn(['tipo_entrega', 'direccion_envio', 'telefono_contacto', 'costo_envio']);
        });
    }
};
