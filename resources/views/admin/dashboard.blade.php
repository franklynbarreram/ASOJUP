@extends('layouts.app')

@section('content')
    @include('layouts.headers.cards')
    <h1>{{Auth::user()->name}}</h1>
    <div class="container-fluid mt--7">
        <h1></h1>
    </div>
@endsection