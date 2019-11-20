<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Formulario;
use DB;

class SolicitudesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $solicitudes= Formulario::all();
        $sol_pendientes=DB::table('sol_pendientes')
        ->orderBy('idSol','desc')
        ->paginate(10);
        $sol_asignadas=DB::table('sol_asignadas')
        ->orderBy('idSol','desc')
        ->paginate(10);
        $sol_atendidas=DB::table('sol_atendidas')
        ->orderBy('idSol','desc')
        ->paginate(10);
        $horarios=DB::table('máshorarios')
        ->orderBy('idMásHorarios','desc')
        ->paginate(10);
        $horas=DB::table('horas')
        ->orderBy('idHora','desc')
        ->paginate(10);
        $salas=DB::table('salas')
        ->orderBy('idSalas','desc')
        ->paginate(10);
        return [$solicitudes,$sol_pendientes, $sol_atendidas, $sol_asignadas, $horarios, $horas, $salas];
    }
    public function update(Request $request, $id)
    {
        $formulario=Formulario::find($id);
        $formulario->FNyA = $request->params['FNyA'];
        $formulario->FProDoc = $request->params['FProDoc'];
        $formulario->FCedula = $request->params['FCedula'];
        $formulario->FCorreoUTP = $request->params['FCorreoUTP'];
        $formulario->FCorreoAlt = $request->params['FCorreoAlt'];
        $formulario->FCodAsignatura = $request->params['FCodAsignatura'];
        $formulario->FNomAsignatura = $request->params['FNomAsignatura'];
        $formulario->FGrupo = $request->params['FGrupo'];
        $formulario->FFechaISol = $request->params['FFechaISol'];
        $formulario->FFechaFSol = $request->params['FFechaFSol'];
        $formulario->FEstudiantes = $request->params['FEstudiantes'];
        $formulario->FSoftwareN = $request->params['FSoftwareN'];
        $formulario->FEquipoA = $request->params['FEquipoA'];
        $formulario->save();
        DB::table('máshorarios')->where('idF', '=', $id)->delete();
        $horarios = $request->params['horarios'];
        foreach ($horarios as $valor) {
            DB::table('máshorarios')->insert([
                ['MDia' => $valor['MDia'], 'idF' => $id, 'MHorarioD' => $valor['MHorarioD'], 'MHorarioH' => $valor['MHorarioH']],
            ]);
        }


        return $formulario;
    }
    public function show(Request $request, $id)
    {
        $formulario=Formulario::find($id);
        
        return $formulario;
    }

    public function destroy(Request $idF, $horarios){
        foreach ($horarios as $h) {
            $a = $h['MHorarioD'];
            $b = $h['MHorarioH'];
            $period = new DatePeriod(
            new DateTime($a),
            new DateInterval('PT30M'),
            new DateTime($b)
            );
            foreach ($period as $date) {
                DB::table('horas')->insert([
                    ['idF' => $idF, 'hora' => $date->format("H:i"), 'dia' => $h['MDia']], 'sala' => 'R211']); 
            }
        }
        DB::table('sol_pendientes')->where('idF', '=', $idF)->delete();
        DB::table('sol_atendidas')->insert([
            ['idF' => $idF],]); 
    }


    public function mail(Request $request){
        $horarios=DB::table('horas')
        ->where('idF', '=', $request->idF)
        ->orderBy('idSalas','desc')
        ->paginate(10);
        Mail::to($request->FCorreoUTP)->send($horarios);
    }
}

