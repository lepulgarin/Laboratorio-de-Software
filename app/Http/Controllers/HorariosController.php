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
                    ['idF' => $h['idF'], 'hora' => $date->format("H:i"), 'dia' => $h['MDia'], 'sala' => $h['sala']]]); 
            }
        }
        DB::table('sol_pendientes')->where('idF', '=', $request->horarios[0]['idF'])->delete();
        DB::table('sol_atendidas')->insert([
            ['idF' => $request->horarios[0]['idF'],]]);
    }
}
