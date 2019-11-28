<!DOCTYPE html>
<html lang="en">
<body>
    <div>
        Buen día.
        Las salas asignadas para la asignatura <b> {{ $FNomAsignatura }}</b> los dias:
        <ul>
            @foreach($horarios as $horario)
                <li>{{$horario['MDia']}} de {{$horario['MHorarioD']}} a {{$horario['MHorarioH']}} es la sala {{$horario['sala']}} </li>

            @endforeach
        </ul> 

    </div>
</body>
</html>



