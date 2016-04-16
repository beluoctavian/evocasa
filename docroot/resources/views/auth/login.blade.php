@extends('default')

@section('content')
<div class="row">
    <div class="col-xs-12 col-sm-6 col-sm-offset-3">
        <div class="panel panel-default no-margin">
            <div class="panel-heading">Login</div>
            <div class="panel-body">
                @if (count($errors) > 0)
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger">
                            <span>{{ $error }}</span>
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                        </div>
                    @endforeach
                @endif
                <form class="form-horizontal" role="form" method="POST" action="{{ url('/auth/login') }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="form-group">
                        <label class="col-xs-3 col-sm-2 control-label">Username</label>
                        <div class="col-xs-9 col-sm-10">
                            <input type="text" class="form-control" name="username" value="{{ old('username') }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-xs-3 col-sm-2 control-label">Parola</label>
                        <div class="col-xs-9 col-sm-10">
                            <input type="password" class="form-control" name="password">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-9 col-xs-offset-3 col-sm-10 col-sm-offset-2">
                            <button type="submit" class="btn btn-primary">Login</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
