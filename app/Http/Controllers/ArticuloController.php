<?php

namespace App\Http\Controllers;

use App\Articulo;
use Illuminate\Http\Request;

class ArticuloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        $categorias = ['Bazar','Hogar','Electronica'];
        $precios = [
            1 => 'Menor de 20€',
            2 => 'Entre 20 y 50€',
            3 => 'Mas de 50€'
        ];
        $miCategoria = $request->get('categoria');
        $miPrecio = $request->get('precio');

        $articulos = Articulo::orderBy('nombre')
        ->categoria($miCategoria)
        ->precio($miPrecio)
        ->paginate(3);

        return view('articulos.index', compact('articulos','categorias','precios','request'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('articulos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->has('imagen')){
            $request->validate([
                'imagen'=>['image']
            ]);

            $file=$request->file('imagen');

            $nombre = 'articulos/'.time().'_'.$file->getClientOriginalName();

            \Storage::disk('public')->put($nombre, \File::get($file));

            $articulos=Articulo::create($request->all());

            $articulos->update(['imagen'=>"img/$nombre"]);
        }else{
            Articulo::create($request->all());
        }
        return redirect()->route('articulos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Articulo  $articulo
     * @return \Illuminate\Http\Response
     */
    public function show(Articulo $articulo)
    {
        return view('articulos.detalle',compact('articulo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Articulo  $articulo
     * @return \Illuminate\Http\Response
     */
    public function edit(Articulo $articulo)
    {
        $articulos = Articulo::orderBy('nombre')->get();
        return view('articulos.edit', compact('articulo','articulos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Articulo  $articulo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Articulo $articulo)
    {
        if($request->has('imagen')){
            $request->validate([
                'imagen'=>['image']
            ]);

            $file=$request->file('imagen');

            $nombre = 'articulos/'.time().'_'.$file->getClientOriginalName();

            \Storage::disk('public')->put($nombre, \File::get($file));

            if(basename($articulo->imagen)!= 'default.jpg'){
                unlink($articulo->imagen);
            }

            $articulo->update($request->all());
            $articulo->update(['imagen'=>"img/$nombre"]);
        }else{
            $articulo->update($request->all());
        }
        return redirect()->route('articulos.index')->with("mensaje", "Articulo Modificado");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Articulo  $articulo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Articulo $articulo)
    {
        $imagen = $articulo->imagen;
        if(basename($imagen)!="default.jpg"){
            unlink($imagen);
        }
        $articulo->delete();
        return redirect()->route('articulos.index')->with('mensaje', 'Articulo Eliminado');
    }
}
