<div class="row mb-3">
    <!-- Card title -->
    <h1 class="col-7">{{$title}}</h1>

    <!-- Search bar -->
    <div class="col-5 custom-card-form">
        @if (isset($search_route))
            <form method="GET" action="{{route($search_route)}}">
                <div class="form-group mb-0">
                    <div class="input-group input-group-alternative">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                        </div>

                        <input class="form-control" placeholder="Buscar" type="text" name="search">

                        @if (isset($extra_params))
                            @foreach ($extra_params as $ep => $val)
                                <input type="hidden" name="{{$ep}}" value="{{$val}}">
                            @endforeach
                        @endif
                    </div>
                </div>

                <button class="btn btn-default ml-2 mr-2" type="submit">Buscar</button>
            </form>
        @endif
        
        <!-- Create button -->
        @if (isset($create_route))
            @if (!isset($extra_params))
                <a href="{{route($create_route)}}" class="btn btn-primary">
                    <i class="fas fa-plus-circle"></i> Crear
                </a>
            @else
                <a href="{{route($create_route, $extra_params)}}" class="btn btn-primary">
                    <i class="fas fa-plus-circle"></i> Crear
                </a>
            @endif
        @endif
    </div>
</div>