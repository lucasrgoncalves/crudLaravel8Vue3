@extends('layouts.template')

@section('content')
    @if(count($cont) > 0)
        <div id="listar-medicos"></div>
        <script src="{{ mix('js/app.js') }}"></script>
    @else
        <div id="error-medico"></div>
        <script src="{{ mix('js/app.js') }}"></script>
    @endif
@endsection