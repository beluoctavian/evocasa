@extends('default')

@section('in-head')
    <link href="{{ URL::asset('library/ion-rangeslider/css/ion.rangeSlider.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('library/ion-rangeslider/css/ion.rangeSlider.skinNice.css') }}" rel="stylesheet">
@endsection

@section('page-header')
    <div class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <h1>Anunturi</h1>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div id="main-content" class="col-xs-12 col-sm-12">
            <div class="container-fluid">
                @if(Session::has('successDelete'))
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="alert alert-success">
                                <span>Ati sters anuntul cu succes!</span>
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                            </div>
                        </div>
                    </div>
                @endif
                    <div class="row">
                        <div class="col-xs-12">
                            <a href="/anunturi?tip=apartment" class="add-advert-type">
                                <span class="glyphicon glyphicon-th"></span>
                                <span>Apartament</span>
                            </a>
                            <a href="/anunturi?tip=casa" class="add-advert-type">
                                <span class="glyphicon glyphicon-home"></span>
                                <span>Casa / Vila</span>
                            </a>
                            <a href="/anunturi?tip=teren" class="add-advert-type">
                                <span class="glyphicon glyphicon-picture"></span>
                                <span>Teren</span>
                            </a>
                        </div>
                    </div>
                <div class="row margin-bottom">
                    <div class="col-xs-12">
                        <div class="main-title">
                            <i class="fa fa-search"></i>
                            <h2>Cautare avansata</h2>
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <div id="search-box">
                            <form method="get" action="{{ URL::to('anunturi') }}">
                                <input type="hidden" name = 'tip' value="{{$type}}">
                                {{--<input type="hidden" name="_token" value="{{ csrf_token() }}">--}}
                                @if(!Auth::guest())
                                    <div class="row">
                                        <div class="form-group col-xs-12 col-sm-2">
                                            <label>Telefon proprietar</label>
                                            <div>
                                                <input name="telefon_proprietar" type="text" class="form-control" value="{{ Input::get('telefon_proprietar') ? Input::get('telefon_proprietar') : '' }}">
                                            </div>
                                        </div>
                                        <div class="form-group col-xs-12 col-sm-2">
                                            <label>Stare</label>
                                            <div>
                                                <select name="status" class="form-control">
                                                    <option value="any">Oricare</option>
                                                    <option value="activ" {{ Input::get('status') == 'activ' ? 'selected' : '' }}>Activ</option>
                                                    <option value="inactiv" {{ Input::get('status') == 'inactiv' ? 'selected' : '' }}>Inactiv</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <div class="row">
                                    <div class="form-group col-xs-12 col-sm-2">
                                        <label>ID anunt</label>
                                        <div>
                                            <input name="id_anunt" type="text" class="form-control" value="{{ Input::get('id_anunt') ? Input::get('id_anunt') : '' }}">
                                        </div>
                                    </div>
                                    <div class="form-group col-xs-12 col-sm-4">
                                        <label>Cuvinte cheie</label>
                                        <div>
                                            <input name="cuvinte_cheie" type="text" class="form-control" value="{{ Input::get('cuvinte_cheie') ? Input::get('cuvinte_cheie') : '' }}">
                                        </div>
                                    </div>
                                    <div class="form-group col-xs-12 col-sm-4">
                                        <label for="price_range">Pret</label>
                                        <input type="text" id="price_range" value="">
                                        <div class="hidden">
                                            <input name="pret_minim" id="pret_minim" type="hidden" value="{{ Input::get('pret_minim') ? Input::get('pret_minim') : '' }}">
                                            <input name="pret_maxim" id="pret_maxim" type="hidden" value="{{ Input::get('pret_maxim') ? Input::get('pret_maxim') : '' }}">
                                        </div>
                                    </div>
                                    @if($type == null or $type == 'apartment')
                                        <div class="form-group col-xs-12 col-sm-2">
                                            <label for="an_constructie_range">An constructie</label>
                                            <input type="text" id="an_constructie_range" value="">
                                            <div class="hidden">
                                                <input name="an_constructie_minim" id="an_constructie_minim" type="hidden" value="{{ Input::get('an_constructie_minim') ? Input::get('an_constructie_minim') : '' }}">
                                                <input name="an_constructie_maxim" id="an_constructie_maxim" type="hidden" value="{{ Input::get('an_constructie_maxim') ? Input::get('an_constructie_maxim') : '' }}">
                                            </div>
                                        </div>
                                        <div class="form-group col-xs-6 col-sm-4 col-md-2">
                                            <label>Numar camere</label>
                                            <select multiple id="numar_camere" name="numar_camere[]" class="form-control">
                                                <?php $numar_camere = Input::get('numar_camere') == null ? [] : Input::get('numar_camere'); ?>
                                                <option value="1" {{ in_array(1,$numar_camere) ? 'selected' : '' }}>garsoniera</option>
                                                <option value="2" {{ in_array(2,$numar_camere) ? 'selected' : '' }}>2 camere</option>
                                                <option value="3" {{ in_array(3,$numar_camere) ? 'selected' : '' }}>3 camere</option>
                                                <option value="4" {{ in_array(4,$numar_camere) ? 'selected' : '' }}>4+ camere</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-xs-6 col-sm-2">
                                            <label for="etaj">Etaj</label>
                                            <select multiple id="etaj" name="etaj[]" class="form-control">
                                                <?php $etaj = Input::get('etaj') == null ? [] : Input::get('etaj'); ?>
                                                <option value="demisol" {{ in_array('demisol', $etaj) ? 'selected' : '' }}>Demisol</option>
                                                <option value="parter" {{ in_array('parter', $etaj) ? 'selected' : '' }}>Parter</option>
                                                @for ($i = 1; $i <= 15; $i++)
                                                    <option value="{{ $i }}" {{ in_array($i, $etaj) ? 'selected' : '' }}>Etaj {{ $i }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                        <div class="form-group col-xs-6 col-sm-4 col-md-2">
                                            <label>Suprafata minima</label>
                                            <div class="input-group">
                                                <input name="suprafata_minima" type="number" min="0" max="200" step="1" class="form-control" value="{{ Input::exists('suprafata_minima') ? Input::get('suprafata_minima') : '' }}">
                                                <span class="input-group-addon">mp</span>
                                            </div>
                                        </div>
                                        <div class="form-group col-xs-6 col-sm-4 col-md-2">
                                            <label>Suprafata maxima</label>
                                            <div class="input-group">
                                                <input name="suprafata_maxima" type="number" min="0" max="200" step="1" class="form-control" value="{{ Input::exists('suprafata_maxima') ? Input::get('suprafata_maxima') : '' }}">
                                                <span class="input-group-addon">mp</span>
                                            </div>
                                        </div>
                                        <div class="form-group col-xs-6 col-sm-4 col-md-2">
                                            <label>Compartimentare</label>
                                            <div>
                                                <select name="compartimentare" class="form-control">
                                                    <option value="">Indiferent</option>
                                                    @foreach($partitions as $partition)
                                                        <option value="{{ $partition }}" {{ Input::get('compartimentare') == $partition ? 'selected' : '' }}>{{ $partition }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    @elseif($type == 'casa')
                                        <div class="form-group col-xs-12 col-sm-4 col-md-2">
                                            <label>An constructie minim</label>
                                            <input name="an_constructie_minim" type="number" min="1950" max="2020" step="1" class="form-control" value="{{ Input::get('an_constructie_minim') ? Input::get('an_constructie_minim') : '' }}">
                                        </div>
                                        <div class="form-group col-xs-12 col-sm-4 col-md-2">
                                            <label>An constructie maxim</label>
                                            <input name="an_constructie_maxim" type="number" min="1950" max="2020" step="1" class="form-control" value="{{ Input::get('an_constructie_maxim') ? Input::get('an_constructie_maxim') : '' }}">
                                        </div>
                                        <div class="form-group col-xs-6 col-sm-4 col-md-2">
                                            <label>Numar camere</label>
                                            <select multiple id="numar_camere" name="numar_camere[]" class="form-control">
                                                <?php

                                                $numar_camere = Input::get('numar_camere') == null ? [] : Input::get('numar_camere');
                                                ?>
                                                <option value="1" {{ in_array(1,$numar_camere) ? 'selected' : '' }}>garsoniera</option>
                                                <option value="2" {{ in_array(2,$numar_camere) ? 'selected' : '' }}>2 camere</option>
                                                <option value="3" {{ in_array(3,$numar_camere) ? 'selected' : '' }}>3 camere</option>
                                                <option value="4" {{ in_array(4,$numar_camere) ? 'selected' : '' }}>4+ camere</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-xs-6 col-sm-4 col-md-2">
                                            <label>Suprafata minima</label>
                                            <div class="input-group">
                                                <input name="min_total_area" type="number" min="0" max="200" step="1" class="form-control" value="{{ Input::exists('min_total_area') ? Input::get('min_total_area') : '' }}">
                                                <span class="input-group-addon">mp</span>
                                            </div>
                                        </div>
                                        <div class="form-group col-xs-6 col-sm-4 col-md-2">
                                            <label>Suprafata maxima</label>
                                            <div class="input-group">
                                                <input name="max_total_area" type="number" min="0" max="200" step="1" class="form-control" value="{{ Input::exists('max_total_area') ? Input::get('max_total_area') : '' }}">
                                                <span class="input-group-addon">mp</span>
                                            </div>
                                        </div>
                                    @else
                                        <div class="form-group col-xs-6 col-sm-4 col-md-2">
                                            <label>Suprafata minima</label>
                                            <div class="input-group">
                                                <input name="min_total_area" type="number" min="0" max="200" step="1" class="form-control" value="{{ Input::exists('min_total_area') ? Input::get('min_total_area') : '' }}">
                                                <span class="input-group-addon">mp</span>
                                            </div>
                                        </div>
                                        <div class="form-group col-xs-6 col-sm-4 col-md-2">
                                            <label>Suprafata maxima</label>
                                            <div class="input-group">
                                                <input name="max_total_area" type="number" min="0" max="200" step="1" class="form-control" value="{{ Input::exists('max_total_area') ? Input::get('max_total_area') : '' }}">
                                                <span class="input-group-addon">mp</span>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="form-group col-xs-6 col-sm-4 col-md-2">
                                        <label>Cartier</label>
                                        <div>
                                            <select multiple id="neighborhood" name="cartier[]" class="form-control">
                                                <option value="">Indiferent</option>
                                                <?php
                                                $cartiere = Input::get('cartier') == null ? [] : Input::get('cartier');
                                                ?>
                                            @foreach($neighborhoods as $neighborhood)
                                                    <option value="{{ $neighborhood->name }}" {{ in_array($neighborhood->name,$cartiere) ? 'selected' : '' }}>{{ $neighborhood->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-xs-6 col-sm-4 col-md-2">
                                        <label>Zona</label>
                                        <div>
                                            <select multiple id="area" name="zona[]" class="form-control">
                                                <option value="">Indiferent</option>
                                                <?php
                                                $zone = Input::get('zona') == null ? [] : Input::get('zona');
                                                ?>
                                                @foreach($areas as $area)
                                                    <option value="{{ $area->name }}" {{ in_array($area->name, $zone) ? 'selected' : '' }}>{{ $area->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-xs-6 col-sm-4 col-md-2">
                                        <label>Sortare</label>
                                        <div>
                                            <select name="sortare" class="form-control">
                                                <option value="">Indiferent</option>
                                                <option value="asc">Crescator</option>
                                                <option value="desc">Descrescator</option>

                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 text-center">
                                        <button type="submit" class="btn btn-warning btn-lg"><i class="fa fa-search"></i> Cauta</button>
                                        <a href="{{ URL::to('anunturi') }}" class="btn btn-warning btn-lg"><i class="fa fa-trash-o"></i> Reset</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="row" id="anunturi">
                    <div class="col-xs-12">
                        <div class="main-title">
                            <i class="fa fa-th-list"></i>
                            <h2>Anunturi</h2>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-10 col-sm-offset-1">
                        @foreach($adverts as $advert)
                            <?php $entity = $advert['entity'];
                                $advert = $advert['advert'];
                            ?>
                            <div class="advert-item" id="{{ 'advert-item-no-' . $advert['id'] }}">
                                @if(!Auth::guest())
                                    <div class="controls">
                                        <div>
                                            <a href="{{ URL::to('advert/edit/' . $advert['id']) }}" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
                                        </div>
                                        <div>
                                            <a href="{{ URL::to('advert/images/' . $advert['id']) }}" class="btn btn-success"><i class="fa fa-file-image-o"></i></a>
                                        </div>
                                        <div>
                                            <a href="{{ URL::to('advert/update/' . $advert['id']) }}" class="btn btn-warning"><i class="fa fa-wrench"></i></a>
                                        </div>
                                        <form method="POST" action="{{ URL::to('advert/delete') }}" onSubmit="return confirm('Sigur vrei sa stergi anuntul?');">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" name="id" value="{{ $advert['id'] }}">
                                            <button type="submit" class="btn btn-danger"><i class="fa fa-times"></i></button>
                                        </form>
                                    </div>
                                @endif
                                <div class="img-container">
                                    @if(Auth::guest())
                                        <a href="{{ URL::to('anunturi/' . $advert['id']) }}">
                                    @else
                                        <a href="{{ URL::to('advert/edit/' . $advert['id']) }}">
                                    @endif
                                    @if(File::exists('uploaded-images/anunt_' . $advert['id'] . '/'))
                                        <?php $files = File::allFiles('uploaded-images/anunt_' . $advert['id'] . '/'); sort($files); ?>
                                        @if (count($files))
                                            <?php $filename = $files[0]->getRelativePathName(); ?>
                                            <img src="{{ URL::asset('uploaded-images/anunt_' . $advert['id'] . '/' . $filename) }}">
                                        @else
                                            <img src="{{ URL::asset('img/default-img.jpg') }}" />
                                        @endif
                                    @else
                                        <img src="{{ URL::asset('img/default-img.jpg') }}" />
                                    @endif
                                    </a>
                                    <div class="type">{{ $advert['type'] }}</div>
                                </div>
                                <div class="description">
                                    @if(Auth::guest())
                                        <h2><a class="{{ $advert['inactiv'] == TRUE ? 'red' : ($advert['retras'] == TRUE ? 'grey' : '') }}" href="{{ URL::to('anunturi/' . $advert['id']) }}">{{ $advert['title'] }}</a></h2>
                                    @else
                                        <h2><a class="{{ $advert['inactiv'] == TRUE ? 'red' : ($advert['retras'] == TRUE ? 'grey' : '') }}" href="{{ URL::to('advert/edit/' . $advert['id']) }}">{{ $advert['title'] }}</a></h2>
                                    @endif
                                    <div class="price">
                                        <div class="a-container">
                                            <a class="actual" href="{{ URL::to('anunturi/' . $advert['id']) }}">{{ $advert['price'] }} &euro;</a>
                                        </div>
                                        @if($advert['old_price'])
                                            <div class="a-container">
                                                <a class="vechi" href="{{ URL::to('anunturi/' . $advert['id']) }}">{{ $advert['old_price'] }} &euro;</a>
                                            </div>
                                        @endif
                                        <div class="clear-both"></div>
                                        <div class="updated-at text-center" href="{{ URL::to('anunturi/' . $advert['id']) }}">
                                            <div>
                                                <p>Actualizat: {{ date("d-m-Y", strtotime($advert['updated_at'])) }}</p>
                                                <p>Adaugat: {{ date("d-m-Y", strtotime($advert['updated_at'])) }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="details">
                                        <ul>
                                            <li>ID: <b>{{ $advert['code'] }}</b></li>
                                            @if(!empty($entity['built_area']))
                                                <li>
                                                   Built area:<b>{{ $entity['built_area'] }} </b> mp
                                                </li>
                                            @endif

                                            @if(!empty($entity['partitioning']))
                                                <li class="hidden-xs hidden-sm">
                                                    {{ $entity['partitioning'] }}
                                                </li>
                                            @endif

                                            @if(!empty($entity['total_area']))
                                                <li class="hidden-xs hidden-sm">
                                                    Total area: <b>{{ $entity['total_area'] }}</b> mp
                                                </li>
                                            @endif

                                            @if(!empty($entity['street_opening']))
                                                <li class="hidden-xs hidden-sm">
                                                   Street opening:<b> {{ $entity['street_opening'] }}</b> m
                                                </li>
                                            @endif
                                            @if(!empty($entity['floor']))
                                                <li class="hidden-xs hidden-sm">
                                                    Etaj {{ $entity['floor'] }}
                                                </li>
                                            @endif
                                            @if(!empty($entity['built_year']))
                                                <li class="hidden-xs hidden-sm">
                                                    An: <b>{{ $entity['built_year'] }}</b>
                                                </li>
                                            @endif

                                        </ul>
                                    </div>
                                </div>
                                <div class="clear-both"></div>
                            </div>
                        @endforeach
                    </div>
                    <div class="col-xs-12 text-center">
                        <div class="pagination">
                            {!! $adverts->render() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="sidebar" class="col-xs-12 col-sm-3">
            <div class="container-fluid">
            </div>
        </div>
    </div><!-- /.row -->
@endsection

@section('scripts')
<script src="{{ URL::asset('library/ion-rangeslider/js/ion-rangeSlider/ion.rangeSlider.min.js') }}"></script>
<script type="text/javascript">
    $('#numar_camere').select2({
        tags: true,
        placeholder: "Indiferent"
    });
    $('#neighborhood').select2({
        tags: true,
        placeholder: "Indiferent"
    });
    $('#area').select2({
        tags: true,
        placeholder: "Indiferent"
    });
    $('#price_range').ionRangeSlider({
        type: 'double',
        min: {{ $input_defaults['pret_minim'] }},
        max: {{ $input_defaults['pret_maxim'] }},
        step: 1000,
        from: {{ Input::get('pret_minim') ? Input::get('pret_minim') : $input_defaults['pret_minim'] }},
        to: {{ Input::get('pret_maxim') ? Input::get('pret_maxim') : $input_defaults['pret_maxim'] }},
        postfix: "&euro;",
        onChange: function (data) {
            $('#pret_minim').val(data.from);
            $('#pret_maxim').val(data.to);
        }
    });
    $('#an_constructie_range').ionRangeSlider({
        type: 'double',
        min: {{ $input_defaults['an_constructie_minim'] }},
        max: {{ $input_defaults['an_constructie_maxim'] }},
        step: 1,
        from: {{ Input::get('an_constructie_minim') ? Input::get('an_constructie_minim') : $input_defaults['an_constructie_minim'] }},
        to: {{ Input::get('an_constructie_maxim') ? Input::get('an_constructie_maxim') : $input_defaults['an_constructie_maxim'] }},
        prettify_enabled: false,
        onChange: function (data) {
            $('#an_constructie_minim').val(data.from);
            $('#an_constructie_maxim').val(data.to);
        }
    });
</script>
@endsection