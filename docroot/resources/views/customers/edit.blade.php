@extends('default')

@section('page-header')
<div class="page-header">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h1>Editeaza client</h1>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="row">
    <div id="main-content" class="col-xs-12 col-sm-12">
        <div class="container-fluid">
            @if(Session::has('success'))
            <div class="row">
                <div class="col-xs-12">
                    <div class="alert alert-success">
                        <span>Ati editat cu succes clientul!</span>
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                    </div>
                </div>
            </div>
            @endif
            <form method="POST" action="{{ URL::to('edit-client') }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="id" value="{{ $customer->id }}">

                <div class="row" id="adauga-client">
                    <div class="col-xs-12">
                        <div class="main-title">
                            <i class="fa fa-pencil"></i>
                            <h2>Editeaza client</h2>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-xs-12 col-sm-2">
                                <label>Nume</label>
                                <div>
                                    <input name="nume" type="text" class="form-control" value="{{ $customer->nume }}">
                                </div>
                            </div>
                            <div class="form-group col-xs-12 col-sm-2">
                                <label>Prenume</label>
                                <div>
                                    <input name="prenume" type="text" class="form-control" value="{{ $customer->prenume }}">
                                </div>
                            </div>
                            <div class="form-group col-xs-12 col-sm-2">
                                <label>Telefon</label>
                                <div>
                                    <input name="telefon" type="text" class="form-control" value="{{ $customer->telefon }}">
                                </div>
                            </div>
                            <div class="form-group col-xs-12 col-sm-2">
                                <label>E-mail</label>
                                <div>
                                    <input name="email" type="text" class="form-control" value="{{ $customer->email }}">
                                </div>
                            </div>
                            <div class="form-group col-xs-12 col-sm-2">
                                <label>Buget</label>
                                <div class="input-group">
                                    <input name="buget" type="text" class="form-control" value="{{ $customer->buget }}">
                                    <span class="input-group-addon">&euro;</span>
                                </div>
                            </div>
                            <div class="form-group col-xs-12 col-sm-2">
                                <label>Tip plata</label>
                                <div>
                                    <input name="tip_plata" type="text" class="form-control" value="{{ $customer->tip_plata }}">
                                </div>
                            </div>
                            <div class="form-group col-xs-12 col-sm-2">
                                <label>Numar camere cautate</label>
                                <div>
                                    <input name="numar_camere_cautate" type="text" class="form-control" value="{{ $customer->numar_camere_cautate }}">
                                </div>
                            </div>
                            <div class="form-group col-xs-12 col-sm-2">
                                <label>Oras</label>
                                <div>
                                    <input name="oras" type="text" class="form-control" value="{{ $customer->oras }}">
                                </div>
                            </div>
                            <div class="form-group col-xs-12 col-sm-2">
                                <label>Cartier</label>
                                <div>
                                    <input name="cartier" type="text" class="form-control" value="{{ $customer->cartier }}">
                                </div>
                            </div>
                            <div class="form-group col-xs-12 col-sm-2">
                                <label>Zona</label>
                                <div>
                                    <input name="zona" type="text" class="form-control" value="{{ $customer->zona }}">
                                </div>
                            </div>
                            <div class="form-group col-xs-12 col-sm-4">
                                <label>Observatii</label>
                                <div>
                                    <textarea name="observatii" class="form-control" rows="2">{{ $customer->observatii }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- /.row -->

                <div class="row margin-bottom">
                    <div class="col-xs-12 text-center">
                        <button type="submit" class="btn btn-warning btn-lg">Editeaza client</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
    <div id="sidebar" class="col-xs-12 col-sm-3">
        <div class="container-fluid">
        </div>
    </div>
</div><!-- /.row -->
@endsection

@section('scripts')
@endsection