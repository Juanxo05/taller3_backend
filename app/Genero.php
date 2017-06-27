<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genero extends Model
{
    protected $table = 'genero';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'descripcion'
    ];
}
