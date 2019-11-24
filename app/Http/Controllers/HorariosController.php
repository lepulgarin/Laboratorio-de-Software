<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Formulario;
use DB;
use DateTime;
use DatePeriod;
use DateInterval;

class HorariosController extends Controller
{
     public function store(Request $request){

     	$horarios = $request->horarios;

        $Formulario=DB::table('formularios')
        ->orderBy('idF','desc')
        ->where('idF', '=', $request->horarios[0]['idF'])
        ->paginate(1);

        DB::table('horas')->where('idF', '=', $Formulario[0]->idF)->delete();

        $days_dias = array(
            'Monday'=>'Lunes',
            'Tuesday'=>'Martes',
            'Wednesday'=>'Miércoles',
            'Thursday'=>'Jueves',
            'Friday'=>'Viernes',
            'Saturday'=>'Sábado',
            'Sunday'=>'Domingo'
        );

        $start = new DateTime($Formulario[0]->FFechaISol);
        $end   = new DateTime($Formulario[0]->FFechaFSol);
        $step  = 1;
        $unit  = 'W';

        foreach ($horarios as $h) {
            $dow   = array_search($h['MDia'], $days_dias);
            $start->modify($dow);
            $interval = new DateInterval("P{$step}{$unit}");
            $period1   = new DatePeriod($start, $interval, $end);
            foreach($period1 as $date1){
                $a = $h['MHorarioD'];
                $b = $h['MHorarioH'];
                $period = new DatePeriod(
                    new DateTime($a),
                    new DateInterval('PT30M'),
                    new DateTime($b)
                );
                foreach ($period as $date) {
                    DB::table('horas')->insert([
                        ['idF' => $h['idF'], 'hora' => $date->format("H:i"), 'dia' => $h['MDia'], 'sala' => $h['sala'], 'fecha' => $date1->format("Y-m-d")]]); 
                }
            }
            
        }
        DB::table('sol_pendientes')->where('idF', '=', $request->horarios[0]['idF'])->delete();
        DB::table('sol_atendidas')->insert([
            ['idF' => $request->horarios[0]['idF'],]]);
    }
}
