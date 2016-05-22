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
        @if(Session::has('success'))
            <div class="row">
                <div class="col-xs-12">
                    <div class="alert alert-success">
                        <span>{{ Session::get('success') }}</span>
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                    </div>
                </div>
            </div>
        @endif
        @if(Session::has('fail'))
            <div class="row">
                <div class="col-xs-12">
                    <div class="alert alert-danger">
                        <span>{{ Session::get('fail') }}</span>
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>

<div class="row">
    <div class="col-xs-12 col-sm-6">
        <form method="POST" action="{{ URL::to('settings/user') }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="row margin-bottom">
                <div class="col-xs-12">
                    <div class="main-title">
                        <i class="fa fa-cogs"></i>
                        <h2>Setari cont</h2>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-xs-12 col-sm-8 col-sm-offset-2">
                            <label>Username</label>
                            <div>
                                <input name="username" type="text" class="form-control" value="{{ Auth::user()->username }}">
                            </div>
                        </div>
                        <div class="form-group col-xs-12 col-sm-8 col-sm-offset-2">
                            <label>Parola actuala</label>
                            <div>
                                <input name="password" type="password" class="form-control">
                            </div>
                        </div>
                        <div class="form-group col-xs-12 col-sm-8 col-sm-offset-2">
                            <label>Noua parola</label>
                            <div>
                                <input name="newPassword" type="password" class="form-control">
                            </div>
                        </div>
                        <div class="form-group col-xs-12 col-sm-8 col-sm-offset-2">
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
                    <button type="submit" class="btn btn-warning">Modifica</button>
                </div>
            </div>
        </form>
    </div>

    <div class="col-xs-12 col-sm-6">
        <div class="row">
            <div class="col-xs-12">
                <form method="POST" enctype="multipart/form-data" action="{{ URL::to('settings/website') }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="row margin-bottom">
                        <div class="col-xs-12">
                            <div class="main-title">
                                <i class="fa fa-cogs"></i>
                                <h2>Setari website</h2>
                            </div>
                            <label for="files">Upload fisiere informatii utile</label>
                            <div>
                                <p>
                                    <input type="file" id="files" name="files[]" multiple />
                                </p>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-warning">Adauga fisiere</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-xs-12">
                @if (!empty($files))
                    <p>
                        <b>Fisiere informatii utile:</b>
                    </p>
                    <ul>
                        @foreach ($files as $file)
                            <li>
                                <p>
                                    <form role="form" method="POST" action="{{ URL::to('settings/website/delete-file/') }}"  onsubmit="return confirm('Sigur doriti sa stergeti fisierul?');">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="file" value="{{ $file->getPath() . '/' . $file->getFilename() }}">
                                        <span>{{ $file->getFilename() }}</span>
                                        <span class="text-center"><input type="submit" class="btn btn-danger btn-xs pull-right" value="Sterge fisierul"></span>
                                    </form>
                                </p>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
@endsection