<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Formulario extends Model
{
    protected $table='formularios';
    protected $primaryKey="idF";

    public $timestamps=false;

    protected $fillable =[
    	'FNyA',
    	'FProDoc',
        'FCedula',
        'FCorreoUTP',
        'FCorreoAlt',
        'FCodAsignatura',
        'FNomAsignatura',
        'FGrupo',
        'FFechaISol',
        'FFechaFSol',
        'FEstudiantes',
        'FSoftwareN',
        'FEquipoA'
    ];

    protected $guarded =[
    	
    ];
}
