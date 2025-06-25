<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {


            $table->id();
            $table->string('title');
            $table->string('author');
            $table->integer('published_at');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));

            
        });

        DB::table('books')->insert([
            ['title' => 'La voragine', 'author' => 'Jose Ustacio Rivera', 'published_at' => 1924],
            ['title' => 'Cien años de soledad', 'author' => 'Gabriel Garcia Marquez', 'published_at' => 1967],
            ['title' => 'El amor en los tiempos del colera', 'author' => 'Gabriel Garcia Marquez', 'published_at' => 1985],
            ['title' => 'El túnel', 'author' => 'Ernesto Sabato', 'published_at' => 1948],
            ['title' => 'Rayuela', 'author' => 'Julio Cortázar', 'published_at' => 1963],
            ['title' => 'La sombra del viento', 'author' => 'Carlos Ruiz Zafón', 'published_at' => 2001],
            ['title' => 'El túnel del tiempo', 'author' => 'H.G. Wells', 'published_at' => 1895],
            ['title' => 'Los detectives salvajes', 'author' => 'Roberto Bolaño', 'published_at' => 1998],
            ['title' => 'El otoño del patriarca', 'author' => 'Gabriel García Márquez', 'published_at' => 1975],
            ['title' => 'Pedro Páramo', 'author' => 'Juan Rulfo', 'published_at' => 1955],
            ['title' => 'Don Quijote de la Mancha', 'author' => 'Miguel de Cervantes', 'published_at' => 1605],
            ['title' => 'El Aleph', 'author' => 'Jorge Luis Borges', 'published_at' => 1949],
            ['title' => 'Crónica de una muerte anunciada', 'author' => 'Gabriel García Márquez', 'published_at' => 1981],
            ['title' => 'La casa de los espíritus', 'author' => 'Isabel Allende', 'published_at' => 1982],
            ['title' => 'Ficciones', 'author' => 'Jorge Luis Borges', 'published_at' => 1944]
            // Puedes agregar más registros aquí
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
}