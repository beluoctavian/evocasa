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
            <div class="row margin-bottom">
                <div class="col-xs-12">
                    <div class="main-title">
                        <i class="fa fa-search"></i>
                        <h2>Cautare avansata</h2>
                    </div>
                </div>
                <div class="col-xs-12">
                    <div id="search-box">
                        <form method="POST" action="{{ URL::to('anunturi') }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
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
                                            @foreach($compartimentari as $compartimentare)
                                            <option value="{{ $compartimentare }}" {{ Input::get('compartimentare') == $compartimentare ? 'selected' : '' }}>{{ $compartimentare }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-xs-6 col-sm-4 col-md-2">
                                    <label>Oras</label>
                                    <div>
                                        <select name="oras" class="form-control">
                                            <option value="">Indiferent</option>
                                            @foreach($orase as $oras)
                                            <option value="{{ $oras }}" {{ Input::get('oras') == $oras ? 'selected' : '' }}>{{ $oras }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-xs-6 col-sm-4 col-md-2">
                                    <label>Cartier</label>
                                    <div>
                                        <select name="cartier" class="form-control">
                                            <option value="">Indiferent</option>
                                            @foreach($cartiere as $cartier)
                                            <option value="{{ $cartier }}" {{ Input::get('cartier') == $cartier ? 'selected' : '' }}>{{ $cartier }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-xs-6 col-sm-4 col-md-2">
                                    <label>Zona</label>
                                    <div>
                                        <select name="zona" class="form-control">
                                            <option value="">Indiferent</option>
                                            @foreach($zone as $zona)
                                            <option value="{{ $zona }}" {{ Input::get('zona') == $zona ? 'selected' : '' }}>{{ $zona }}</option>
                                            @endforeach
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
                        <div class="pull-right ordoneaza hidden-xs hidden-sm">
                            <?php
                            $link_final = '';
                            foreach(Input::get() as $key => $value){
                                if($key == "sort")
                                    continue;
                                if($link_final != '')
                                    $link_final = $link_final . '&' . $key . '=' . $value;
                                else
                                    $link_final = '?' . $key . '=' . $value;
                            }
                            if($link_final != '')
                                $link_final = $link_final . '&sort=pret';
                            else
                                $link_final = '?sort=pret';
                            ?>
                            Ordoneaza dupa pret:
                            <a href="{{ URL::to('/anunturi'. $link_final . '&tip_sortare=asc') }}">crescator <i class="fa fa-arrow-circle-o-up"></i></a>
                            <span>|</span>
                            <a href="{{ URL::to('/anunturi'. $link_final . '&tip_sortare=desc') }}">descrescator <i class="fa fa-arrow-circle-o-down"></i></a>
                        </div>
                    </div>
                </div>
                <!--
                <div class="col-xs-12 text-center hidden-md hidden-lg margin-bottom">
                    <div class="ordoneaza">
                        <div>Ordoneaza dupa pret:</div>
                        <a href="{{ URL::to('/anunturi'. $link_final) }}">crescator <i class="fa fa-arrow-circle-o-up"></i></a>
                        <span>|</span>
                        <a href="{{ URL::to('/anunturi'. $link_final . '&tip_sortare=desc') }}">descrescator <i class="fa fa-arrow-circle-o-down"></i></a>
                    </div>
                </div>
                -->
                <div class="col-xs-12 col-sm-10 col-sm-offset-1">
                    @for($it = $page * 10 - 10 ; $it <= $page * 10 - 1 && $it < count($anunts) ; $it++)
                    <?php $anunt = $anunts[$it]; ?>
                    <?php $imobil = DB::table('imobils')->where('id_anunt','=',$anunt->id)->first(); ?>
                    <div class="advert-item" id="{{ 'advert-item-no-' . $anunt->id }}">
                        @if(!Auth::guest())
                        <div class="controls">
                            <form method="POST" action="{{ URL::to('sterge-anunt') }}" onSubmit="return confirm('Sigur vrei sa stergi anuntul?');">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="id" value="{{ $anunt->id }}">
                                <a href="{{ URL::to('editeaza-anunt/' . $anunt->id) }}" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
                                <br>
                                <a href="{{ URL::to('upload-images/' . $anunt->id) }}" class="btn btn-success"><i class="fa fa-file-image-o"></i></a>
                                <br>
                                <a href="{{ URL::to('update-date/' . $anunt->id) }}" class="btn btn-warning"><i class="fa fa-wrench"></i></a>
                                <br>
                                <button type="submit" class="btn btn-danger"><i class="fa fa-times"></i></button>
                            </form>
                        </div>
                        @endif
                        <div class="img-container">
                            @if(Auth::guest())
                            <a href="{{ URL::to('anunturi/' . $anunt->id) }}">
                            @else
                            <a href="{{ URL::to('editeaza-anunt/' . $anunt->id) }}">
                            @endif
                                @if(File::exists('uploaded-images/anunt_' . $anunt->id . '/'))
                                    <?php $files = File::allFiles('uploaded-images/anunt_' . $anunt->id . '/'); sort($files); ?>
                                    @if(count($files))
                                        <?php $filename = $files[0]->getRelativePathName(); ?>
                                        <img src="{{ URL::asset('uploaded-images/anunt_' . $anunt->id . '/' . $filename) }}">
                                    @else
                                        <img src="{{ URL::asset('img/default-img.jpg') }}" />
                                    @endif
                                @else
                                <img src="{{ URL::asset('img/default-img.jpg') }}" />
                                @endif
                            </a>
                            <div class="type">{{ $anunt->tip }}</div>
                        </div>
                        <div class="description">
                            @if(Auth::guest())
                            <h2><a href="{{ URL::to('anunturi/' . $anunt->id) }}">{{ $anunt->titlu }}</a></h2>
                            @else
                            <h2><a class="{{ strpos($anunt->status,'inactiv') === false ? '' : 'red' }}" href="{{ URL::to('editeaza-anunt/' . $anunt->id) }}">{{ $anunt->titlu }}</a></h2>
                            @endif
                            <div class="price">
                                <div class="a-container">
                                    <a class="actual" href="{{ URL::to('anunturi/' . $anunt->id) }}">{{ $anunt->pret }} &euro;</a>
                                </div>
                                @if($anunt->pret_vechi)
                                <div class="a-container">
                                    <a class="vechi" href="{{ URL::to('anunturi/' . $anunt->id) }}">{{ $anunt->pret_vechi }} &euro;</a>
                                </div>
                                @endif
                                <div class="clear-both"></div>
                                <div class="updated-at text-center" href="{{ URL::to('anunturi/' . $anunt->id) }}">
                                    <div>
                                        <p>Actualizat: {{ date("d-m-Y", strtotime($anunt->updated_at)) }}</p>
                                        <p>Adaugat: {{ date("d-m-Y", strtotime($anunt->created_at)) }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="details">
                                <ul>
                                    <li>ID: <b>{{ $anunt->cod }}</b></li>

                                    <li>
                                        @if($imobil->sc)
                                        {{ $imobil->sc }} mp
                                        @endif
                                    </li>
                                    <li class="hidden-xs hidden-sm">
                                        @if($imobil->compartimentare)
                                        {{ $imobil->compartimentare }}
                                        @endif
                                    </li>
                                    <li class="hidden-xs hidden-sm">
                                        @if($imobil->etaj)
                                        Etaj {{ $imobil->etaj }}
                                        @endif
                                    </li>
                                    <li class="last">
                                        @if($imobil->an_constructie)
                                        An {{ $imobil->an_constructie }}
                                        @endif
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="clear-both"></div>
                    </div>
                    @endfor
                </div>
                <div class="col-xs-12 text-center">
                    <nav>
                        <ul class="pagination">
                            @if($page == 1)
                            <li class="disabled">
                                <a href="javascript:" aria-label="Next">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                            @else
                            <?php
                            $link_final = '';
                            foreach(Input::get() as $key => $value){
                                if($key == "page"){
                                    $value --;
                                }
                                if($link_final != '')
                                    $link_final = $link_final . '&' . $key . '=' . $value;
                                else
                                    $link_final = '?' . $key . '=' . $value;
                            }
                            ?>
                            <li>
                                <a href="{{ URL::to('./anunturi'. $link_final . '#anunturi') }}" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                            @endif
                            <?php
                                $puncte_inainte = 0;
                                $puncte_dupa = 0;
                            ?>
                            @for($it =  1 ; $it <= floor((count($anunts)-1)/10 + 1) ; $it++)
                                @if($it == 1 || $it == floor((count($anunts)-1)/10 + 1) || ($it >= ($page - 1) && $it <= ($page + 1)))
                                <li <?php echo $it == $page ? "class='active'" : ""; ?> >
                                    <?php
                                    $link_final = '';
                                    foreach(Input::get() as $key => $value){
                                        if($link_final != '')
                                            $link_final = $link_final . '&' . $key . '=' . $value;
                                        else
                                            $link_final = '?' . $key . '=' . $value;
                                    }
                                    if($link_final != '')
                                        $link_final = $link_final . '&page=' . ($it);
                                    else
                                        $link_final = '?page=' . ($it);
                                    ?>
                                    <a href="{{ URL::to('anunturi'. $link_final . '#anunturi') }}">{{ $it }}</a>
                                </li>
                                @endif
                                @if($it != 1 && $it < ($page - 1) && $puncte_inainte == 0)
                                    <?php $puncte_inainte = 1; ?>
                                    <li class="disabled">
                                        <a href="javascript:"><i class="fa fa-ellipsis-h"></i></a>
                                    </li>
                                @endif
                                @if($it != floor((count($anunts)-1)/10 + 1) && $it > ($page + 1) && $puncte_dupa == 0)
                                    <?php $puncte_dupa = 1; ?>
                                    <li class="disabled">
                                        <a href="javascript:"><i class="fa fa-ellipsis-h"></i></a>
                                    </li>
                                @endif
                            @endfor
                            @if(($page) == floor((count($anunts)-1)/10 + 1))
                            <li class="disabled">
                                <a href="javascript:" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                            @else
                            <?php
                            $link_final = '';
                            $found = false;
                            foreach(Input::get() as $key => $value){
                                if($key == "page"){
                                    $value ++;
                                    $found = true;
                                }
                                if($link_final != '')
                                    $link_final = $link_final . '&' . $key . '=' . $value;
                                else
                                    $link_final = '?' . $key . '=' . $value;
                            }
                            if($found === false){
                                if($link_final != '')
                                    $link_final = $link_final . '&page=' . ($page+1);
                                else
                                    $link_final = '?page=' . ($page+1);
                            }
                            ?>
                            <li>
                                <a href="{{ URL::to('/anunturi'. $link_final . '#anunturi') }}" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                            @endif
                        </ul>
                    </nav>
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