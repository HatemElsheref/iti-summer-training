@if($errors->any())
    <div class="list-group mb-2">
        @foreach($errors->all() as $error)

            <a href="#" class="list-group-item list-group-item-action list-group-item-danger"><i class="fa fa-times fa-sm"></i> {{$error}}</a>

        @endforeach
    </div>
@endif




