<?php

namespace App\Http\Controllers;
 
use App\Http\Controllers\Controller;
use App\Mail\Notificar;
use Illuminate\Support\Facades\Mail;
use DB;

use Illuminate\Http\Request;

class MailControler extends Controller
{
    public function store(Request $request){
    	$salas=DB::table('formularios')
        ->orderBy('idF','desc')
        ->where('idF', '=', $request->horarios[0]['idF'])
        ->paginate(1);
    	$horarios = $request->horarios;
        Mail::to($salas[0]->FCorreoUTP.'@utp.edu.co')->send(new Notificar($horarios,$salas[0]->FNomAsignatura));
        
		DB::table('sol_atendidas')->where('idF', '=', $request->horarios[0]['idF'])->delete();
        DB::table('sol_asignadas')->insert([
            ['idF' => $request->horarios[0]['idF'],]]);
    }
}
