<div class="{{$alert_class}}" role="alert">
    <span class="alert-icon">
        @if ($success == true) 
            <i class="fas fa-ban"></i> 
        @else
            <i class="fas fa-check-circle"></i>
        @endif
    </span>
    <span class="alert-text">
        <strong>
            ¡Operación @if ($success == true) exitosa! @else fallida! @endif
        </strong>
        {{\Session::get('notification')}}
    </span>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>