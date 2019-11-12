    @if(count($errors)>0)
    @foreach($errors->all() as $error)

        <div class="alert alert-danger alert-dismissible fade show text-center w-50 mx-auto my-4" role="alert">
            <strong >Holy guacamole! </strong>{{$error}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

    @endforeach
    @endif

    @if(session('success'))

    <div class="alert alert-success alert-dismissible fade show text-center w-50 mx-auto my-4" role="alert">
        <strong >Udało się! </strong> {{session('success')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

    @endif

    @if(session('error'))

        <div class="alert alert-danger alert-dismissible fade show text-center w-50 mx-auto my-4" role="alert">
            <strong >Holy guacamole! </strong> {{session('error')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

    @endif