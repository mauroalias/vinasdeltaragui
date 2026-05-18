<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('productos', function (Blueprint $table) {

        $table->id();

        // RELACIÓN CON CATEGORÍAS
        $table->foreignId('categoria_id')
              ->constrained('categorias')
              ->onDelete('cascade');

        // DATOS PRINCIPALES
        $table->string('nombre', 150);

        $table->text('descripcion');

        $table->decimal('precio', 10, 2);

        $table->integer('stock')->default(0);

        $table->string('url_imagen')->nullable();

        // DETALLES PREMIUM
        $table->string('origen')->nullable();

        $table->string('bodega')->nullable();

        $table->string('graduacion')->nullable();

        $table->string('volumen')->nullable();

        $table->string('variedad')->nullable();

        // ESTADO
        $table->boolean('activo')->default(true);

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
