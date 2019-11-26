@section('content')
<div>
    Buen día.
    Las salas asignadas para la asignatura <b> {{ $FNomAsignatura }}</b> los dias:
    @foreach ($horarios as $h)
    <b>{{$h->Mdia}}</b> de {{$h->MHorarioD}} a {{$->MHorarioH}} es la sala <b>{{$->sala}}</b>
    @endforeach
</div>
@endsection