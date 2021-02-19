@if (count($errors) > 0)
    @foreach($errors->all() as $error)
        <div class="row justify-content-center">
            <div class="alert alert-danger" style="width: 42%; text-align: center;">
                {{$error}}
            </div>
        </div>
    @endforeach
@endif

@if(session('success'))
    <div class="row justify-content-center">
        <div class="alert alert-success mb-4" style="width: 50%; text-align: center;">
            {{session('success')}}
        </div>  
    </div> 
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{session('error')}}
    </div>   
@endif