@extends('default')

@section('title')
- {{ $advert['title'] }}
@endsection

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
    <div id="main-content" class="col-xs-12 col-md-9">
        <div class="container-fluid">
            <div class="row">
                @foreach ($status_types as $status_type)
                    @if ($status_type->type == 'inactiv' && !empty($advert_status[$status_type->id]))
                        <div class="col-xs-12 relative red margin-bottom text-center">
                            <h1 class="no-margin">Anunțul este inactiv!</h1>
                        </div>
                    @endif
                @endforeach
                <div class="col-xs-12 relative">
                    <h2 class="no-margin view-entity-title">
                        <span class="grey"><b>[{{ $advert['code'] }}]</b></span>&nbsp;&nbsp;{{ $advert['title'] }}</h2>
                </div>
                <div class="col-xs-12">
                    @if (!Auth::guest())
                    <div class="editbutton">
                        <form method="POST" action="{{ URL::to('advert/delete/' . $advert['id']) }}" onSubmit="return confirm('Sigur vrei sa stergi anuntul?');">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="id" value="{{ $advert['id'] }}">
                            <button type="submit" class="btn btn-danger pull-right"><i class="fa fa-times"></i> Sterge</button>
                            <a href="{{ URL::to('advert/images/' . $advert['id']) }}" class="btn btn-success pull-right"><i class="fa fa-picture-o"></i> Upload</a>
                            <a href="{{ URL::to('advert/edit/' . $advert['id']) }}" class="btn btn-primary pull-right"><i class="fa fa-pencil"></i> Editeaza</a>
                        </form>
                    </div>
                    @endif
                    <div class="price big with-margin">
                        <div class="a-container pull-left">
                            <a class="actual" href="#">{{ $advert['price'] }} &euro;</a>
                        </div>
                        @if($advert['old_price'])
                            <div class="a-container pull-left">
                                <a class="vechi" href="#">{{ $advert['old_price'] }} &euro;</a>
                            </div>
                        @endif
                    </div>
                </div>
                @if (Auth::guest() && !empty($files))
                    <div class="row margin-top">
                        <div class="col-xs-12 col-md-10 col-md-offset-1 margin-top">
                            <div class="fotorama" data-nav="thumbs" data-allowfullscreen="true" data-width="100%" data-ratio="1280/720">
                                @foreach ($files as $file)
                                    <img src="{{ URL::asset('uploaded-images/anunt_' . $advert['id'] . '/' . $file->getFilename()) }}">
                                @endforeach
                            </div>
                        </div>
                    </div>
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
                                <a href="javascript:" class="list-group-item">Telefon {{ $key+1 }}: {{ $tel }}</a>
                            @endforeach
                        @endif
                        <a href="javascript:" class="list-group-item">E-mail: {{ $owner['email'] }}</a>
                        <a href="javascript:" class="list-group-item">Adresa: {{ $owner['address'] }}</a>
                        <a href="javascript:" class="list-group-item">Cadastru: {{ $owner['cadaster'] }}</a>
                        <a href="javascript:" class="list-group-item">Intabulare: {{ $owner['registration'] }}</a>
                        <a href="javascript:" class="list-group-item">Certificat energetic: {{ $owner['energy_certificate'] }}</a>
                        <a href="javascript:" class="list-group-item">Certificat urbanism: {{ $owner['urbanism_certificate'] }}</a>
                        <a href="javascript:" class="list-group-item">Poze map: {{ $owner['map_pictures'] ? "Da" : "Nu" }}</a>
                        @if (count($owner['observations']) > 0)
                        <a href="javascript:" class="list-group-item">
                            <span>Observatii:</span>
                            <ul>
                                @foreach ($owner['observations'] as $observation)
                                    <li>{{ $observation->text }} ({{ $observation->created_at }})</li>
                                @endforeach
                            </ul>
                        </a>
                        @endif
                    </div>
                </div>
            </div>
            @endif
            @if (!empty($advert['description']))
            <div class="row margin-top">
                <div class="col-xs-12 col-sm-12">
                    <div class="list-group">
                        <div class="list-group-item active text-center">DESCRIERE ANUNT</div>
                        <a href="javascript:" class="list-group-item">{!! nl2br($advert['description']) !!}</a>
                    </div>
                </div>
            </div>
            @endif
            <div class="row margin-top">
                <div class="col-xs-12 col-sm-4">
                    <div class="list-group">
                        <div class="list-group-item active text-center">DETALII ANUNT</div>
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
                                            <span>{{ $improvement }}</span>
                                            <i class='fa fa-check pull-right'></i>
                                        </p>
                                    @endforeach
                                    <div class="clear-both"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                @endif
            </div>
            @if (!Auth::guest() && !empty($files))
                <div class="row margin-top">
                    <div class="col-xs-12">
                        <div class="fotorama" data-nav="thumbs" data-allowfullscreen="true" data-width="100%" data-ratio="1280/720">
                            @foreach ($files as $file)
                            <img src="{{ URL::asset('uploaded-images/anunt_' . $advert['id'] . '/' . $file->getFilename()) }}">
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <div id="sidebar" class="hidden-xs hidden-sm col-md-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12">
                    <div class="sidebar-title">
                        <h2>Consultant imobiliar</h2>
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="thumbnail">
                        <img class="banner-preview" src="{{ URL::asset("files/user/{$advert['user']['code']}.jpg") }}" alt="{{ $advert['user']['name'] }}"/>
                        <div class="caption">
                            @if (!empty($advert['user']['name']))
                                <p class="grey" style="font-size: 16px;"><b>{{ strtoupper($advert['user']['name']) }}</b></p>
                            @endif
                            @if (!empty($advert['user']['email']))
                                <p><a class="yellow" href="mailto:{{ $advert['user']['email'] }}" target="_top">{{ $advert['user']['email'] }}</a></p>
                            @endif
                            @if (!empty($advert['user']['phone']))
                                <p class="yellow"><b>{{ $advert['user']['phone'] }}</b></p>
                            @endif
                        </div>
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