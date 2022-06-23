@extends('layouts.app')
    <!-- <link rel="stylesheet" href="/tabulator/css/tabulator.css"> -->
    <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jsgrid/1.5.3/jsgrid.min.css" />
    <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jsgrid/1.5.3/jsgrid-theme.min.css" />
 @section('custom-css')

@endsection

@section('content')

@include('layouts.templates.topbar')

<div class="container-fluid mt--7">
    <div class="card" style="margin-top: 12%;">
        <div class="card-body">

            @if (\Session::has('notification'))
                @include('layouts.templates.notification', [
                    'success' => \Session::get('success'),
                    'message' => \Session::get('notification'),
                    'alert_class' => \Session::get('success') == true ?
                    'alert alert-success alert-dismissible fade show' :
                    'alert alert-danger alert-dismissible fade show'
                ])
            @endif

            <h1 class="card-title">Listado # {{$listing->id}} - {{$listing->date}}</h1>

            <!-- <div id="example_div" data-listing-id="{{$listing->id}}"></div> -->
            <div class="row">
                <div class="form-group col-2">
                    <select class="form-control" name="search_type">
                        <option value="medicine">
                            Por medicamento
                        </option>
                        <option value="need">
                            Por necesidad
                        </option>
                        <option value="illness">
                            Por enfermedad
                        </option>
                    </select>
                </div>
                <div class="form-group col-10">
                    <input class="form-control" type="password" name="password_confirmation" id="passowrd_confirm">
                </div>
            </div>
            <button id="test-btn" class="btn btn-default mb-3">Add new customer</button>
            <div id="jsGrid"></div>
        </div>
    </div>
</div>

@endsection

@push('js')
<!-- <script src="/js/app.js"></script> -->
<!-- <script type="text/javascript" src="/tabulator/js/tabulator.js"></script> -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jsgrid/1.5.3/jsgrid.min.js"></script>
<script type="text/javascript" src="/js/listing.js"></script>
<script type="text/javascript">
    let sidebar_link = document.getElementById('listing-link');
    sidebar_link.classList.remove('collapsed');
    sidebar_link.setAttribute('aria-expanded', true);

    let sidebar_options = document.getElementById('listing-options');
    sidebar_options.classList.add('show');
</script>
@endpush