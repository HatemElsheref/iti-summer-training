@if($errors->any())
    <div class="alert alert-danger" role="alert">
        @foreach($errors->all() as $error)
         <p><i class="fa fa-question"></i> {{$error}}</p>
        @endforeach
    </div>
@endif