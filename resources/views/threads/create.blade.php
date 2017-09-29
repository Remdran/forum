@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Create a New Thread</div>
                    <div class="panel-body">
                        <form action="/threads" method="post">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="title">Title:</label>
                                <input type="text" class="form-control" name="title" id="title">
                            </div>

                            <div class="form-group">
                                <label for="body">Body:</label>
                                <textarea type="text" class="form-control" name="body" id="body" rows="8"></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form> 
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
