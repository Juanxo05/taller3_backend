<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EjemplarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function __construct()
    
    {   
        $this->middleware('auth');
    }


    public function index()
    {
        $ejemplar = Ejemplar::all(); // se obtiene la totalidad de peliculas existentes en la BD
        $datos = array ();
        $contador = 0;

        // se obtenendran los valores de cada pelicula y se almacenaran en un array para ser retornados hacia la vista
        foreach ($ejemplares as $ejemplar) {
            $libro = Libro::find($ejemplar->libro_id); // se busca el genero especifico de la pelicula, buscando el id
            $estado = Estado::find($ejemplar->estado_id);
            $usuario = Usuairo::find($ejemplar->usuario_id);

            // asigancion de valores
            $datos[$contador]["id"] = $ejemplar->id;
            $datos[$contador]["libro"] = $libro->titulo;
            $datos[$contador]["estado"] = $estado->descripcion;
            $datos[$contador]["usuario"]   = $usuario->nombre;
            $datos[$contador]["usuario"] = $usuario->rut;
           
            $contador++;
        }
        // retorno de vista y datos que listara
        return view("/home", compact('datos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $libros = Libro::all(); // Se obtienen todos los libros almacenados
        $estados = Estado::all(); // Se obtienen todos los Estados
        $usuarios = Usuario::all(); // Se obtienen todos los Usuarios

        //Retorno de la vista y los datos a listar.
        return view('/createEjemplar', compact('libros','estados','usuarios'));


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        /*
        $ejemplar = Ejemplar::find($id); //Se busca el ejemplar 
        $libros = Libro::all();
        $estados = Estado::all();
        $usuarios = Usuario::all();

        return ('/editEjemplar',compact('ejemplar','libros','estados','usuarios'));
        */
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $ejemplar = Ejemplar::find($id);
        //Se rellenan los atributos con los datos respectivos
        $ejemplar->fill($request->all());

        //Aqui se guardan los cambios hechos

        if($ejemplar->save()){
            Session::flash('message-success', 'El ejemplar se actualizo satisfactoriamente');
        } else {
            Session::flash('message-error', 'El ejemplar no se ha podido actualizar');
        }

        return Redirect::to('/ejemplares');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pelicula = Pelicula::find($id);
        if($pelicula->delete()){
            Session::flash('message-success', 'El ejemplar se elimino satisfactoriamente');
        }else{
            Session::flash('message-error', 'El ejemplar no se ha podido eliminar');
        }

        return Redirect::to('/ejemplares');
    }
}
