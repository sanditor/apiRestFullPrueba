<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->text('descripcion')->nullable();
            $table->decimal('precio', 10, 2);
            $table->integer('cantidad')->default(0);
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });

         // Insertar datos de prueba en la tabla 'productos'
        DB::table('productos')->insert([
            ['nombre' => 'Producto de Prueba1', 'descripcion' => 'Esta es una descripción de prueba para el producto 1', 'precio' => 19.99, 'cantidad' => 100],
            ['nombre' => 'Producto de Prueba2', 'descripcion' => 'Esta es una descripción de prueba para el producto 2', 'precio' => 29.99, 'cantidad' => 200],
            ['nombre' => 'Producto de Prueba3', 'descripcion' => 'Esta es una descripción de prueba para el producto 3', 'precio' => 39.99, 'cantidad' => 300],
            ['nombre' => 'Producto de Prueba4', 'descripcion' => 'Esta es una descripción de prueba para el producto 4', 'precio' => 49.99, 'cantidad' => 400],
            ['nombre' => 'Producto de Prueba5', 'descripcion' => 'Esta es una descripción de prueba para el producto 5', 'precio' => 59.99, 'cantidad' => 500],
            ['nombre' => 'Producto de Prueba6', 'descripcion' => 'Esta es una descripción de prueba para el producto 6', 'precio' => 69.99, 'cantidad' => 600],
            ['nombre' => 'Producto de Prueba7', 'descripcion' => 'Esta es una descripción de prueba para el producto 7', 'precio' => 79.99, 'cantidad' => 700],
            ['nombre' => 'Producto de Prueba8', 'descripcion' => 'Esta es una descripción de prueba para el producto 8', 'precio' => 89.99, 'cantidad' => 800],
            ['nombre' => 'Producto de Prueba9', 'descripcion' => 'Esta es una descripción de prueba para el producto 9', 'precio' => 99.99, 'cantidad' => 900],
            ['nombre' => 'Producto de Prueba10', 'descripcion' => 'Esta es una descripción de prueba para el producto 10', 'precio' => 109.99, 'cantidad' => 1000],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productos');
    }
}
