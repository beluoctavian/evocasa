@extends('default')

@section('in-head')
<!-- fotorama.css & fotorama.js. -->
<link  href="http://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.css" rel="stylesheet"> <!-- 3 KB -->
<script src="http://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.js"></script> <!-- 16 KB -->
@endsection

@section('page-header')
<div class="page-header">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h1>Detalii anunt</h1>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="row">
    <div id="main-content" class="col-xs-12 col-md-8">
        <div class="container-fluid">
            <div class="row">
                // TODO: Check advert status
                <div class="col-xs-12 relative red margin-bottom text-center">
                    <h1 class="no-margin">Anunțul este inactiv!</h1>
                </div>
                <div class="col-xs-12 relative">
                    <h2 class="no-margin">{{ $advert['title'] }}, ID: {{ $advert['code'] }}</h2>
                </div>
                <div class="col-xs-12">
                    @if (!Auth::guest())
                    <div class="editbutton">
                        <form method="POST" action="{{ URL::to('advert/delete/' . $advert['id']) }}" onSubmit="return confirm('Sigur vrei sa stergi anuntul?');">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="id" value="{{ $advert['id'] }}">
                            <button type="submit" class="btn btn-danger pull-right"><i class="fa fa-times"></i> Sterge</button>
                            <a href="{{ URL::to('upload-images/' . $advert['id']) }}" class="btn btn-success pull-right"><i class="fa fa-picture-o"></i> Upload</a>
                            <a href="{{ URL::to('editeaza-anunt/' . $advert['id']) }}" class="btn btn-primary pull-right"><i class="fa fa-pencil"></i> Editeaza</a>
                        </form>
                    </div>
                    @endif
                    <h3>Pret: {{ $advert['price'] }} &euro;</h3>
                    @if (!empty($advert['old_price']))
                    <h3 class="red">Pret vechi: {{ $advert['old_price'] }} &euro;</h3>
                    @endif
                </div>
                @if (Auth::guest() && isset($files))
                    @if($files[0] != null)
                    <div class="col-xs-12">
                        <div class="fotorama" data-nav="thumbs" data-allowfullscreen="true" data-width="100%" data-ratio="1280/720">
                            @foreach ($files as $file)
                            <img src="{{ URL::asset('uploaded-images/anunt_' . $advert->id . '/' . $file->getRelativePathName()) }}">
                            @endforeach
                         </div>
                    </div>
                    @endif
                @endif
            </div>
            @if(!Auth::guest())
            <div class="row margin-top">
                <div class="col-xs-12 col-sm-12">
                    <div class="list-group">
                        <div class="list-group-item active text-center">DETALII PROPRIETAR</div>
                        <a href="javascript:" class="list-group-item">Nume: {{ $owner['last_name'] }}</a>
                        <a href="javascript:" class="list-group-item">Prenume: {{ $owner['first_name'] }}</a>
                        @if (!empty($owner['phone']))
                            @foreach($owner['phone'] as $key => $tel)
                                <a href="javascript:" class="list-group-item">Telefon {{ $key }}: {{ $tel }}</a>
                            @endforeach
                        @endif
                        <a href="javascript:" class="list-group-item">E-mail: {{ $owner['email'] }}</a>
                        <a href="javascript:" class="list-group-item">Adresa: {{ $owner['address'] }}</a>
                        <a href="javascript:" class="list-group-item">Cadastru: {{ $owner['cadaster'] }}</a>
                        <a href="javascript:" class="list-group-item">Intabulare: {{ $owner['registration'] }}</a>
                        <a href="javascript:" class="list-group-item">Certificat energetic: {{ $owner['energy_certificate'] }}</a>
                        <a href="javascript:" class="list-group-item">Certificat urbanism: {{ $owner['urbanism_certificate'] }}</a>
                        <a href="javascript:" class="list-group-item">Poze map: {{ $owner['map_pictures'] ? "Da" : "Nu" }}</a>
                        <a href="javascript:" class="list-group-item">Observatii: // TODO: Add observations}</a>
                    </div>
                </div>
            </div>
            @endif
            @if (!empty($advert['description']))
            <div class="row margin-top">
                <div class="col-xs-12 col-sm-12">
                    <div class="list-group">
                        <div class="list-group-item active text-center">DESCRIERE ANUNT</div>
                        <a href="javascript:" class="list-group-item">{{ nl2br($advert['description']) }}</a>
                    </div>
                </div>
            </div>
            @endif
            <div class="row margin-top">
                <div class="col-xs-12 col-sm-4">
                    <div class="list-group">
                        <div class="list-group-item active text-center">DETALII ANUNT</div>
                        @if (!empty($advert['type']))
                        <a href="javascript:" class="list-group-item">Tip anunt: {{ $advert['type'] }}</a>
                        @endif
                        @if (!empty($advert['no_rooms']))
                        <a href="javascript:" class="list-group-item">Numar camere: {{ $advert['no_rooms'] }}</a>
                        @endif
                        @if (!empty($advert['neighborhood']))
                        <a href="javascript:" class="list-group-item">Cartier: {{ $advert['neighborhood'] }}</a>
                        @endif
                        @if (!empty($advert['area']))
                        <a href="javascript:" class="list-group-item">Zona: {{ $advert['area'] }}</a>
                        @endif
                    </div>
                </div>
                @if (!empty($entity))
                    <div class="col-xs-12 col-sm-4">
                        <div class="list-group">
                            <div class="list-group-item active text-center">DETALII IMOBIL</div>
                            @foreach ($entity as $attr => $value)
                                <a href="javascript:" class="list-group-item">{{ $attr }}: {{ $value }}</a>
                            @endforeach
                        </div>
                    </div>
                @endif
                @if (!empty($improvements))
                    <div class="col-xs-12 col-sm-4">
                        <div class="list-group">
                            <div class="list-group-item active text-center" id="improvements">DETALII IMBUNATATIRI</div>
                            <a href="javascript:" class="list-group-item">
                                <div class="imbunats">
                                    @foreach ($improvements as $improvement)
                                        <p>
                                            {{ $improvement }} <i class='fa fa-check'></i>
                                        </p>
                                    @endforeach
                                    <div class="clear-both"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                @endif
            </div>
            @if (!Auth::guest() && isset($files))
                <div class="row margin-top">
                    @if ($files[0] != null)
                    <div class="col-xs-12">
                        <div class="fotorama" data-nav="thumbs" data-allowfullscreen="true" data-width="100%" data-ratio="1280/720">
                            @foreach ($files as $file)
                            <img src="{{ URL::asset('uploaded-images/anunt_' . $advert->id . '/' . $file->getRelativePathName()) }}">
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
            @endif
        </div>
    </div>
    <div id="sidebar" class="col-xs-4 hidden-xs hidden-sm">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12">
                    <div class="sidebar-title">
                        <h2>Anunturi similare</h2>
                    </div>
                </div>
            </div>
            <div class="row">
            </div>
        </div>
    </div>
</div><!-- /.row -->
@endsection

@section('scripts')
@endsection