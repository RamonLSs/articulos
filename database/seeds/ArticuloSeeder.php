<?php

use Illuminate\Database\Seeder;
use App\Articulo;
use Illuminate\Support\Facades\DB;

class ArticuloSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('articulos')->truncate();
        Articulo::create([
            'nombre'=>'Frigorifico',
            'categoria'=>'Hogar',
            'precio'=>'25.2',
            'stock'=>'100'
        ]);

        Articulo::create([
            'nombre'=>'Ordenador Portatil',
            'categoria'=>'Electronica',
            'precio'=>'75.3',
            'stock'=>'500'
        ]);

        Articulo::create([
            'nombre'=>'Microondas',
            'categoria'=>'Hogar',
            'precio'=>'42.7',
            'stock'=>'30'
        ]);

        Articulo::create([
            'nombre'=>'Cucharas',
            'categoria'=>'Bazar',
            'precio'=>'2.1',
            'stock'=>'1000'
        ]);

        Articulo::create([
            'nombre'=>'Impresora',
            'categoria'=>'Electronica',
            'precio'=>'23.7',
            'stock'=>'67'
        ]);

        Articulo::create([
            'nombre'=>'Teclado',
            'categoria'=>'Electronica',
            'precio'=>'73.8',
            'stock'=>'278'
        ]);

        Articulo::create([
            'nombre'=>'Tendedero',
            'categoria'=>'Bazar',
            'precio'=>'59.99',
            'stock'=>'250'
        ]);

        Articulo::create([
            'nombre'=>'Frigorifico',
            'categoria'=>'Hogar',
            'precio'=>'67.99',
            'stock'=>'100'
        ]);

        Articulo::create([
            'nombre'=>'Mini Agenda',
            'categoria'=>'Bazar',
            'precio'=>'1.99',
            'stock'=>'2500'
        ]);

        Articulo::create([
            'nombre'=>'Papelera',
            'categoria'=>'Bazar',
            'precio'=>'3.99',
            'stock'=>'267'
        ]);
    }
}
