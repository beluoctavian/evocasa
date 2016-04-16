@extends('default')

@section('in-head')
@endsection

@section('page-header')
<div class="page-header">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h1>Setarile contului</h1>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="container-fluid">
            @if(Session::has('success'))
            <div class="row">
                <div class="col-xs-12">
                    <div class="alert alert-success">
                        <span>Ati facut modificarile cu succes!</span>
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                    </div>
                </div>
            </div>
            @endif
            @if(Session::has('wrongpass'))
            <div class="row">
                <div class="col-xs-12">
                    <div class="alert alert-danger">
                        <span>Ati introdus gresit parola!</span>
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                    </div>
                </div>
            </div>
            @endif
            @if(Session::has('notmatch'))
            <div class="row">
                <div class="col-xs-12">
                    <div class="alert alert-danger">
                        <span>Cele 2 parole nu se potrivesc!</span>
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                    </div>
                </div>
            </div>
            @endif
            @if(Session::has('smallpass'))
            <div class="row">
                <div class="col-xs-12">
                    <div class="alert alert-danger">
                        <span>Parola trebuie sa aiba cel putin 6 caractere!</span>
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                    </div>
                </div>
            </div>
            @endif
            <form method="POST" action="{{ URL::to('settings') }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="row margin-bottom">
                    <div class="col-xs-12">
                        <div class="main-title">
                            <i class="fa fa-cogs"></i>
                            <h2>Setarile contului</h2>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-xs-12 col-sm-6 col-sm-offset-3">
                                <label>Username</label>
                                <div>
                                    <input name="username" type="text" class="form-control" value="{{ Auth::user()->username }}">
                                </div>
                            </div>
                            <div class="form-group col-xs-12 col-sm-6 col-sm-offset-3">
                                <label>Parola actuala</label>
                                <div>
                                    <input name="password" type="password" class="form-control">
                                </div>
                            </div>
                            <div class="form-group col-xs-12 col-sm-6 col-sm-offset-3">
                                <label>Noua parola</label>
                                <div>
                                    <input name="newPassword" type="password" class="form-control">
                                </div>
                            </div>
                            <div class="form-group col-xs-12 col-sm-6 col-sm-offset-3">
                                <label>Repeta noua parola</label>
                                <div>
                                    <input name="repeatNewPassword" type="password" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 text-center">
                        <button type="submit" class="btn btn-warning btn-lg">Modifica</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
@endsection