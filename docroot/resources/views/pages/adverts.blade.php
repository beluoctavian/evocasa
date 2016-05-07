@extends('default')

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
                                {{--<input type="hidden" name="_token" value="{{ csrf_token() }}">--}}
                                @if(!Auth::guest())
                                    <div class="row">
                                        <div class="form-group col-xs-12 col-sm-2">
                                            <label>Telefon proprietar</label>
                                            <div>
                                                <input name="telefon_proprietar" type="text" class="form-control" value="{{ Input::get('telefon_proprietar') ? Input::get('telefon_proprietar') : '' }}">
                                            </div>
                                        </div>
                                        <div class="form-group col-xs-12 col-sm-4 col-md-2">
                                            <label>ID anunt</label>
                                            <div>
                                                <input name="id_anunt" type="text" class="form-control" value="{{ Input::get('id_anunt') ? Input::get('id_anunt') : '' }}">
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
                                    <div class="form-group col-xs-12 col-sm-4">
                                        <label>Cuvinte cheie</label>
                                        <div>
                                            <input name="cuvinte_cheie" type="text" class="form-control" value="{{ Input::get('cuvinte_cheie') ? Input::get('cuvinte_cheie') : '' }}">
                                        </div>
                                    </div>
                                    @if(Auth::guest())
                                        <div class="form-group col-xs-12 col-sm-4 col-md-2">
                                            <label>ID anunt</label>
                                            <div>
                                                <input name="id_anunt" type="text" class="form-control" value="{{ Input::get('id_anunt') ? Input::get('id_anunt') : '' }}">
                                            </div>
                                        </div>
                                    @endif
                                    <div class="form-group col-xs-6 col-sm-4 col-md-2">
                                        <label>Pret minim</label>
                                        <div class="input-group">
                                            <input name="pret_minim" type="number" min="0" max="1500000" step="1" class="form-control" value="{{ Input::get('pret_minim') ? Input::get('pret_minim') : '' }}">
                                            <span class="input-group-addon">&euro;</span>
                                        </div>
                                    </div>
                                    <div class="form-group col-xs-6 col-sm-4 col-md-2">
                                        <label>Pret maxim</label>
                                        <div class="input-group">
                                            <input name="pret_maxim" type="number" min="0" max="1500000" step="1" class="form-control" value="{{ Input::get('pret_maxim') ? Input::get('pret_maxim') : '' }}">
                                            <span class="input-group-addon">&euro;</span>
                                        </div>
                                    </div>
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
                                        <select name="numar_camere" class="form-control">
                                            <option value="">Indiferent</option>
                                            <option value="1" {{ Input::get('numar_camere') == 1 ? 'selected' : '' }}>1</option>
                                            <option value="2" {{ Input::get('numar_camere') == 2 ? 'selected' : '' }}>2</option>
                                            <option value="3" {{ Input::get('numar_camere') == 3 ? 'selected' : '' }}>3</option>
                                            <option value="4" {{ Input::get('numar_camere') == 4 ? 'selected' : '' }}>4</option>
                                            <option value="1 2" {{ Input::get('numar_camere') == "1 2" ? 'selected' : '' }}>1, 2</option>
                                            <option value="2 3" {{ Input::get('numar_camere') == "2 3" ? 'selected' : '' }}>2, 3</option>
                                            <option value="3 4" {{ Input::get('numar_camere') == "3 4" ? 'selected' : '' }}>3, 4</option>
                                            <option value="1 2 3 4" {{ Input::get('numar_camere') == "1 2 3 4" ? 'selected' : '' }}>1, 2, 3, 4</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-xs-6 col-sm-4 col-md-2">
                                        <label>Etaj minim</label>
                                        <input name="etaj_minim" type="number" class="form-control" value="{{ Input::exists('etaj_minim') ? Input::get('etaj_minim') : '' }}">
                                    </div>
                                    <div class="form-group col-xs-6 col-sm-4 col-md-2">
                                        <label>Etaj maxim</label>
                                        <input name="etaj_maxim" type="number" class="form-control" value="{{ Input::exists('etaj_maxim') ? Input::get('etaj_maxim') : '' }}">
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
                                    {{--<div class="form-group col-xs-6 col-sm-4 col-md-2">--}}
                                        {{--<label>Oras</label>--}}
                                        {{--<div>--}}
                                            {{--<select name="oras" class="form-control">--}}
                                                {{--<option value="">Indiferent</option>--}}
                                                {{--@foreach($orase as $oras)--}}
                                                    {{--<option value="{{ $oras }}" {{ Input::get('oras') == $oras ? 'selected' : '' }}>{{ $oras }}</option>--}}
                                                {{--@endforeach--}}
                                            {{--</select>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                    <div class="form-group col-xs-6 col-sm-4 col-md-2">
                                        <label>Cartier</label>
                                        <div>
                                            <select name="cartier" class="form-control">
                                                <option value="">Indiferent</option>
                                                @foreach($neighborhoods as $neighborhood)
                                                    <option value="{{ $neighborhood->name }}" {{ Input::get('cartier') == $neighborhood->name ? 'selected' : '' }}>{{ $neighborhood->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-xs-6 col-sm-4 col-md-2">
                                        <label>Zona</label>
                                        <div>
                                            <select name="zona" class="form-control">
                                                <option value="">Indiferent</option>
                                                @foreach($areas as $area)
                                                    <option value="{{ $area->name }}" {{ Input::get('zona') == $area->name ? 'selected' : '' }}>{{ $area->name }}</option>
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
                            <?php $apartment = $advert->apartment ?>
                            <div class="advert-item" id="{{ 'advert-item-no-' . $advert->id }}">
                                @if(!Auth::guest())
                                    <div class="controls">
                                        <form method="POST" action="{{ URL::to('sterge-anunt') }}" onSubmit="return confirm('Sigur vrei sa stergi anuntul?');">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" name="id" value="{{ $advert->id }}">
                                            <a href="{{ URL::to('editeaza-anunt/' . $advert->id) }}" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
                                            <br>
                                            <a href="{{ URL::to('upload-images/' . $advert->id) }}" class="btn btn-success"><i class="fa fa-file-image-o"></i></a>
                                            <br>
                                            <a href="{{ URL::to('update-date/' . $advert->id) }}" class="btn btn-warning"><i class="fa fa-wrench"></i></a>
                                            <br>
                                            <button type="submit" class="btn btn-danger"><i class="fa fa-times"></i></button>
                                        </form>
                                    </div>
                                @endif
                                <div class="img-container">
                                    @if(Auth::guest())
                                        <a href="{{ URL::to('anunturi/' . $advert->id) }}">
                                            @else
                                                <a href="{{ URL::to('editeaza-anunt/' . $advert->id) }}">
                                                    @endif
                                                    @if(File::exists('uploaded-images/anunt_' . $advert->id . '/'))
                                                        <?php $files = File::allFiles('uploaded-images/anunt_' . $advert->id . '/'); sort($files); ?>
                                                        @if(count($files))
                                                            <?php $filename = $files[0]->getRelativePathName(); ?>
                                                            <img src="{{ URL::asset('uploaded-images/anunt_' . $advert->id . '/' . $filename) }}">
                                                        @else
                                                            <img src="{{ URL::asset('img/default-img.jpg') }}" />
                                                        @endif
                                                    @else
                                                        <img src="{{ URL::asset('img/default-img.jpg') }}" />
                                                    @endif
                                                </a>
                                                <div class="type">{{ $advert->type }}</div>
                                </div>
                                <div class="description">
                                    @if(Auth::guest())
                                        <h2><a href="{{ URL::to('anunturi/' . $advert->id) }}">{{ $advert->title }}</a></h2>
                                    @else
                                        <h2><a class="" href="{{ URL::to('editeaza-anunt/' . $advert->id) }}">{{ $advert->title }}</a></h2>
                                    @endif
                                    <div class="price">
                                        <div class="a-container">
                                            <a class="actual" href="{{ URL::to('anunturi/' . $advert->id) }}">{{ $advert->price }} &euro;</a>
                                        </div>
                                        @if($advert->old_price)
                                            <div class="a-container">
                                                <a class="vechi" href="{{ URL::to('anunturi/' . $advert->id) }}">{{ $advert->old_price }} &euro;</a>
                                            </div>
                                        @endif
                                        <div class="clear-both"></div>
                                        <div class="updated-at text-center" href="{{ URL::to('anunturi/' . $advert->id) }}">
                                            <div>
                                                <p>Actualizat: {{ date("d-m-Y", strtotime($advert->updated_at)) }}</p>
                                                <p>Adaugat: {{ date("d-m-Y", strtotime($advert->created_at)) }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="details">
                                        <ul>
                                            <li>ID: <b>{{ $advert->code }}</b></li>

                                            <li>
                                                @if($apartment->built_area)
                                                    {{ $apartment->built_area }} mp
                                                @endif
                                            </li>
                                            <li class="hidden-xs hidden-sm">
                                                @if($apartment->partitioning)
                                                    {{ $apartment->partitioning }}
                                                @endif
                                            </li>
                                            <li class="hidden-xs hidden-sm">
                                                @if($apartment->floor)
                                                    Etaj {{ $apartment->floor }}
                                                @endif
                                            </li>
                                            <li class="last">
                                                @if($apartment->built_year)
                                                    An {{ $apartment->built_year }}
                                                @endif
                                            </li>
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
@endsection