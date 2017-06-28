<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ejemplar;
use App\Libro;
use App\Estado;
use App\Usuario;
use App\Genero;
use App\Autor;
use App\Http\Requests\EjemplarRequest;



class EjemplarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /*
    public function __construct()
    
    {   
        $this->middleware('auth');
    }
    */

    public function index()
    {
        $ejemplares = Ejemplar::all(); // se obtiene la totalidad de peliculas existentes en la BD
        $datos = array ();
        $libros = array();
        $contador = 0;

        // se obtenendran los valores de cada pelicula y se almacenaran en un array para ser retornados hacia la vista
        foreach ($ejemplares as $ejemplar) {
            $libro = Libro::find($ejemplar->libro_id); // se busca el genero especifico de la pelicula, buscando el id
            $estado = Estado::find($ejemplar->estado_id);
            $usuario = Usuario::find($ejemplar->usuario_id);
            $genero = Genero::find($libro->genero_id);
            $autor = Autor::find($libro->autor_id);

            $libros['id'] = $libro->id;
            $libros['titulo'] = $libro->titulo;
            $libros['autor'] = $autor;
            $libros['genero'] = $genero;
            


            // asigancion de valores
            $datos[$contador]["id"] = $ejemplar->id;
            $datos[$contador]["libro"] = $libro->titulo;
            $datos[$contador]["estado"] = $estado->descripcion;
            $datos[$contador]["usuario"]   = $usuario->nombre;
            $datos[$contador]["fecha_prestamo"]   = $ejemplar->fecha_prestamo;
            $datos[$contador]["fecha_devolucion"]   = $ejemplar->fecha_devolucion;
           
            $contador++;
        }
        // retorno de vista y datos que listara
        return $datos;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ejemplar = Ejemplar::create($request->all());
        if (!isset($ejemplar)) {
            $datos = 
            [
            'errors'=>true,
            'msg' => 'No se creo prestamo',
            ];

            $ejemplar = \Response::json($datos, 404);
          }
        return $ejemplar;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ejemplar = Ejemplar::find($id);
        $datos = array();
        $libros = array();

        $usuario = Usuario::find($ejemplar->usuario_id);
        $estado = Estado::find($ejemplar->estado_id);
        $libro = Libro::find($ejemplar->libro_id);
        $genero = Genero::find($libro->genero_id);
        $autor = Autor::find($libro->autor_id);

        $libros['id'] = $libro->id;
        $libros['titulo'] = $libro->titulo;
        $libros['autor'] = $autor;
        $libros['genero'] = $genero;

       $datos['id'] = $ejemplar->id;
       $datos['fecha_prestamo'] = $ejemplar->fecha_prestamo;
       $datos['fecha_devolucion'] = $ejemplar->fecha_devolucion;
       $datos['libro'] = $libroDatos;
       $datos['estado'] = $estado;
       $datos['usuario'] = $usuario;

       return $datos;

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

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
        $ejemplar->fill($request->all());
        $ejemplarRetorno = $ejemplar->save();
        
        if (isset($ejemplar)) {
            $ejemplar = \Response::json($ejemplarRetorno, 200);
        } else {
           $ejemplar= \Response::json(['error' => 'No se ha podido actualizar el prestamo de ejemplar'], 404);
        }
        return $ejemplar;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ejemplar = Ejemplar::find($id);
        if ($ejemplar->delete()) {
            $ejemplar = \Response::json(['delete'=> true, 'id'=>$id, 200]);
        } else {
            $ejemplar = \Response::json(['error' => 'No se ha podido eliminar el registro']);
        }

        return $ejemplar;

    }
}
