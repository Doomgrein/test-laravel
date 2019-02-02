@if ($errors->any())
    <br>
    <div class="container pull-left col-md-10">
        <div class="row">
            <div class="col-md-10">
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <br>
@endif