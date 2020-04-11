@extends('layouts.app')
    <link rel="stylesheet" href="/tabulator/css/tabulator.css">
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

            <div id="example_div">
            </div>
            
        </div>
    </div>
</div>

@endsection

@push('js')
<script src="/js/app.js"></script>
<script type="text/javascript" src="/tabulator/js/tabulator.js"></script>
<script type="text/javascript">
    let sidebar_link = document.getElementById('listing-link');
    sidebar_link.classList.remove('collapsed');
    sidebar_link.setAttribute('aria-expanded', true);

    let sidebar_options = document.getElementById('listing-options');
    sidebar_options.classList.add('show');

    var tableData = [
        {
            identification: 25169719,
            cicpc_id: 331212313,
            fullname: 'Jesús Varela',
            age: 24,
            disease: 'Cáncer',
            medicine_name: 'Astorbastatina',
            medicine_presentation: 'Tabletas 20 mg',
            medicine_quantity: 20
        },
    ];

    var table = new Tabulator("#example-table", {
        data: tableData,
        responsiveLayout: "hide",
        columns:[
            {title:"Cédula", field:"identification"},
            {title:"CICPC ID", field:"cicpc_id"},
            {title:"Nombre Completo", field:"fullname"},
            {title:"Edad", field:"age"},
            {title:"Enfermedad", field:"disease"},
            {title:"Medicina", field:"medicine_name"},
            {title:"Presentación", field:"medicine_presentation"},
            {title:"Cantidad", field:"medicine_quantity"},
        ],
    });

    let search_bar = $("#search_bar");

    search_bar.keyup('on', function () {

    });
</script>
@endpush