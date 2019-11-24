<?php

namespace App\Http\Controllers;
use App\Formulario;
use Illuminate\Http\Request;
use DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class FormularioController extends Controller
{
    public function index()
    {
        return view('formulario');
    }

    public function store(Request $request)
    {
            $formulario = new Formulario();
            $formulario->FNyA = $request->FNyA;
            $formulario->FProDoc = $request->FProDoc;
            $formulario->FCedula = $request->FCedula;
            $formulario->FCorreoUTP = $request->FCorreoUTP;
            $formulario->FCorreoAlt = $request->FCorreoAlt;
            $formulario->FCodAsignatura = $request->FCodAsignatura;
            $formulario->FNomAsignatura = $request->FNomAsignatura;
            $formulario->FGrupo = $request->FGrupo;
            $formulario->FFechaISol = $request->FFechaISol;
            $formulario->FFechaFSol = $request->FFechaFSol;
            $formulario->FEstudiantes = $request->FEstudiantes;
            $formulario->FSoftwareN = $request->FSoftwareN;
            $formulario->FEquipoA = $request->FEquipoA;
            $formulario->save();

            $horarios = $request->horarios;
            foreach ($horarios as $valor) {
                DB::table('máshorarios')->insert([
                    ['MDia' => $valor['day'], 'idF' => $formulario->idF, 'MHorarioD' => $valor['timeIni'], 'MHorarioH' => $valor['timeEnd']],
                ]);
            }
            DB::table('sol_pendientes')->insert([
                ['idF' => $formulario->idF],]);
            
            return 'aceptado';
        }

    public function edit($id)
    {
        return view("formularioEdit",["formulario"=>Formulario::findOrFail($id)]);
    }

    

    

}
