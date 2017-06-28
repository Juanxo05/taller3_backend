<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EjemplarRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; //Se autoriza su implementacion 

        //Para la creacion de un requeste se utiliza el comando "php artisan make:requeste NOMBREDELREQUEST"
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [

            'fecha_prestamo' => 'required',
            'fecha_devolucion' => 'required',
            'libro_id' => 'required',
            'estado_id' => 'required',
            'usuario_id' => 'required'
        
        ];
    }
}
