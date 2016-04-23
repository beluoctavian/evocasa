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
                @if(strpos($anunt->status,'inactiv') !== false)
                <div class="col-xs-12 relative red margin-bottom text-center">
                    <h1 class="no-margin">Anunțul este inactiv!</h1>
                </div>
                @endif
                <div class="col-xs-12 relative">
                    <h2 class="no-margin">{{ $anunt->titlu }}, ID: {{ $anunt->cod }}</h2>
                </div>
                <div class="col-xs-12">
                    @if(!Auth::guest())
                    <div class="editbutton">
                        <form method="POST" action="{{ URL::to('sterge-anunt') }}" onSubmit="return confirm('Sigur vrei sa stergi anuntul?');">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="id" value="{{ $anunt->id }}">
                            <button type="submit" class="btn btn-danger pull-right"><i class="fa fa-times"></i> Sterge</button>
                            <a href="{{ URL::to('upload-images/' . $anunt->id) }}" class="btn btn-success pull-right"><i class="fa fa-picture-o"></i> Upload</a>
                            <a href="{{ URL::to('editeaza-anunt/' . $anunt->id) }}" class="btn btn-primary pull-right"><i class="fa fa-pencil"></i> Editeaza</a>
                        </form>
                    </div>
                    @endif
                    <h3>Pret: {{ $anunt->pret }} &euro;</h3>
                    @if($anunt->pret_vechi)
                    <h3 class="red">Pret vechi: {{ $anunt->pret_vechi }} &euro;</h3>
                    @endif
                </div>
                @if(Auth::guest() && isset($files))
                    @if($files[0] != null)
                    <div class="col-xs-12">
                        <div class="fotorama" data-nav="thumbs" data-allowfullscreen="true" data-width="100%" data-ratio="1280/720">
                            @foreach( $files as $file)
                            <?php $filename = $file->getRelativePathName(); ?>
                            <img src="{{ URL::asset('uploaded-images/anunt_' . $anunt->id . '/' . $filename) }}">
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
                        <a href="javascript:" class="list-group-item">Nume: {{ $proprietar->nume }}</a>
                        <a href="javascript:" class="list-group-item">Prenume: {{ $proprietar->prenume }}</a>
                        <?php $telefons = (explode(",",$proprietar->telefon)); $it = 1; ?>
                        @foreach($telefons as $tel)
                        @if($tel != "")
                        <a href="javascript:" class="list-group-item">Telefon {{ $it++ }}: {{ $tel }}</a>
                        @endif
                        @endforeach
                        <a href="javascript:" class="list-group-item">E-mail: {{ $proprietar->email }}</a>
                        <a href="javascript:" class="list-group-item">Adresa: {{ $proprietar->adresa }}</a>
                        <a href="javascript:" class="list-group-item">Cadastru: {{ $proprietar->cadastru }}</a>
                        <a href="javascript:" class="list-group-item">Intabulare: {{ $proprietar->intabulare }}</a>
                        <a href="javascript:" class="list-group-item">Certificat energetic: {{ $proprietar->certificat_energetic }}</a>
                        <a href="javascript:" class="list-group-item">Poze map: {{ $proprietar->poze_map ? "Da" : "Nu" }}</a>
                        <a href="javascript:" class="list-group-item">Observatii: {{ $proprietar->observatii }}</a>
                    </div>
                </div>
            </div>
            @endif
            @if($anunt->descriere)
            <div class="row margin-top">
                <div class="col-xs-12 col-sm-12">
                    <div class="list-group">
                        <div class="list-group-item active text-center">DESCRIERE ANUNT</div>
                        <a href="javascript:" class="list-group-item"><?php echo nl2br($anunt->descriere) ?></a>
                    </div>
                </div>
            </div>
            @endif
            <div class="row margin-top">
                <div class="col-xs-12 col-sm-4">
                    <div class="list-group">
                        <div class="list-group-item active text-center">DETALII ANUNT</div>
                        @if($anunt->tip)
                        <a href="javascript:" class="list-group-item">Tip anunt: {{ $anunt->tip }}</a>
                        @endif
                        @if($anunt->categorie)
                        <a href="javascript:" class="list-group-item">Categorie: {{ $anunt->categorie }}</a>
                        @endif
                        @if($anunt->nr_camere)
                        <a href="javascript:" class="list-group-item">Numar camere: {{ $anunt->nr_camere }}</a>
                        @endif
                        @if($anunt->oras)
                        <a href="javascript:" class="list-group-item">Oras: {{ $anunt->oras }}</a>
                        @endif
                        @if($anunt->cartier)
                        <a href="javascript:" class="list-group-item">Cartier: {{ $anunt->cartier }}</a>
                        @endif
                        @if($anunt->zona)
                        <a href="javascript:" class="list-group-item">Zona: {{ $anunt->zona }}</a>
                        @endif
                    </div>
                </div>
                <div class="col-xs-12 col-sm-4">
                    <div class="list-group">
                        <div class="list-group-item active text-center">DETALII IMOBIL</div>
                        @if($anunt->nr_camere)
                        <a href="javascript:" class="list-group-item">Numar camere: {{ $anunt->nr_camere }}</a>
                        @endif
                        @if($imobil->su)
                            <a href="javascript:" class="list-group-item">Suprafata utila: {{ $imobil->su }} mp</a>
                        @endif
                        @if($imobil->sc)
                        <a href="javascript:" class="list-group-item">Suprafata construita: {{ $imobil->sc }} mp</a>
                        @endif
                        @if($imobil->compartimentare)
                        <a href="javascript:" class="list-group-item">Compartimentare: {{ $imobil->compartimentare }}</a>
                        @endif
                        @if($imobil->etaj)
                        <a href="javascript:" class="list-group-item">Etaj: {{ $imobil->etaj }}</a>
                        @endif
                        @if($imobil->numbar_bai)
                        <a href="javascript:" class="list-group-item">Numar bai: {{ $imobil->numbar_bai }} {{ $imobil->obs_numbar_bai ? '('.$imobil->obs_numbar_bai.')' : '' }}</a>
                        @endif
                        @if($imobil->numbar_bai_serviciu)
                        <a href="javascript:" class="list-group-item">Numar bai serviciu: {{ $imobil->numbar_bai_serviciu }} {{ $imobil->obs_numbar_bai_serviciu ? '('.$imobil->obs_numbar_bai_serviciu.')' : '' }}</a>
                        @endif
                        @if($imobil->numbar_balcoane)
                        <a href="javascript:" class="list-group-item">Numbar balcoane: {{ $imobil->numbar_balcoane }} {{ $imobil->obs_numbar_balcoane ? '('.$imobil->obs_numbar_balcoane.')' : '' }}</a>
                        @endif
                        @if($imobil->an_constructie)
                        <a href="javascript:" class="list-group-item">An constructie: {{ $imobil->an_constructie }}</a>
                        @endif
                        @if($imobil->loc_parcare)
                            <a href="javascript:" class="list-group-item">Loc parcare: {{ $imobil->loc_parcare }} {{ $imobil->obs_loc_parcare ? '('.$imobil->obs_loc_parcare.')' : '' }}</a>
                        @endif
                        @if($imobil->boxa)
                            <a href="javascript:" class="list-group-item">Boxa: {{ $imobil->boxa }} {{ $imobil->obs_boxa ? '('.$imobil->obs_boxa.')' : '' }}</a>
                        @endif
                        @if($imobil->garaj)
                            <a href="javascript:" class="list-group-item">Garaj: {{ $imobil->garaj }} {{ $imobil->obs_garaj ? '('.$imobil->obs_garaj.')' : '' }}</a>
                        @endif
                    </div>
                </div>
                <div class="col-xs-12 col-sm-4">
                    <div class="list-group">
                        <div class="list-group-item active text-center">DETALII IMBUNATATIRI</div>
                        <a href="javascript:" class="list-group-item">
                            <div class="imbunats">
                                @if($imbunat->gresie)
                                <p>
                                    Gresie <i class='fa fa-check'></i>
                                </p>
                                @endif
                                @if($imbunat->faianta)
                                <p>
                                    Faianta <i class='fa fa-check'></i>
                                </p>
                                @endif
                                @if($imbunat->termopan)
                                <p>
                                    Termopan <i class='fa fa-check'></i>
                                </p>
                                @endif
                                @if($imbunat->aer)
                                <p>
                                    Aer conditionat <i class='fa fa-check'></i>
                                </p>
                                @endif
                                @if($imbunat->parchet)
                                <p>
                                    Parchet <i class='fa fa-check'></i>
                                </p>
                                @endif
                                @if($imbunat->instalatie_sanitara)
                                <p>
                                    Instalatie sanitara noua <i class='fa fa-check'></i>
                                </p>
                                @endif
                                @if($imbunat->instalatie_electrica)
                                <p>
                                    Instalatie electrica noua <i class='fa fa-check'></i>
                                </p>
                                @endif
                                @if($imbunat->contor_gaze)
                                <p>
                                    Contor gaze individual <i class='fa fa-check'></i>
                                </p>
                                @endif
                                @if($imbunat->centrala)
                                <p>
                                    Centrala termica <i class='fa fa-check'></i>
                                </p>
                                @endif
                                @if($imbunat->mobilier)
                                <p>
                                    Mobilier inclus <i class='fa fa-check'></i>
                                </p>
                                @endif
                                @if($imbunat->usi_interioare)
                                    <p>
                                        Usi interioare schimbate <i class='fa fa-check'></i>
                                    </p>
                                @endif
                                @if($imbunat->usa_metalica)
                                <p>
                                    Usa metalica <i class='fa fa-check'></i>
                                </p>
                                @endif
                                @if($imbunat->fara_imbunatatiri)
                                <p>
                                    Fara imbunatatiri
                                </p>
                                @endif
                                <div class="clear-both"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="row margin-top">
                @if(!Auth::guest() && isset($files))
                    @if($files[0] != null)
                    <div class="col-xs-12">
                        <div class="fotorama" data-nav="thumbs" data-allowfullscreen="true" data-width="100%" data-ratio="1280/720">
                            @foreach( $files as $file)
                            <?php $filename = $file->getRelativePathName(); ?>
                            <img src="{{ URL::asset('uploaded-images/anunt_' . $anunt->id . '/' . $filename) }}">
                            @endforeach
                        </div>
                    </div>
                    @endif
                @endif
            </div>
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
                @foreach($similare as $sim)
                <?php $imobil = DB::table('imobils')->where('id_anunt','=',$sim->id)->first(); ?>
                <div class="col-xs-12">
                    <div class="similar-item">
                        @if(!Auth::guest())
                        <div class="controls">
                            <form method="POST" action="{{ URL::to('sterge-anunt') }}" onSubmit="return confirm('Sigur vrei sa stergi anuntul?');">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="id" value="{{ $sim->id }}">
                                <a href="{{ URL::to('editeaza-anunt/' . $sim->id) }}" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
                                <br>
                                <a href="{{ URL::to('upload-images/' . $sim->id) }}" class="btn btn-success"><i class="fa fa-file-image-o"></i></a>
                                <br>
                                <button type="submit" class="btn btn-danger"><i class="fa fa-times"></i></button>
                            </form>
                        </div>
                        @endif
                        <div class="img-container">
                            <a href="{{ URL::to('anunturi/' . $sim->id) }}">
                                @if(File::exists('uploaded-images/anunt_' . $sim->id . '/'))
                                <?php $files = File::allFiles('uploaded-images/anunt_' . $sim->id . '/'); ?>
                                @if(count($files))
                                <?php $filename = $files[0]->getRelativePathName(); ?>
                                <img src="{{ URL::asset('uploaded-images/anunt_' . $sim->id . '/' . $filename) }}">
                                @else
                                <img src="{{ URL::asset('img/default-img.jpg') }}" />
                                @endif
                                @else
                                <img src="{{ URL::asset('img/default-img.jpg') }}" />
                                @endif
                            </a>
                            <div class="type">{{ $sim->tip }}</div>
                        </div>
                        <div class="clear-both"></div>
                        <div class="description">
                            <h2><a href="{{ URL::to('anunturi/' . $sim->id) }}">{{ $sim->titlu }}</a></h2>
                            <div class="price">
                                <div class="a-container">
                                    <a class="actual" href="{{ URL::to('anunturi/' . $sim->id) }}">{{ $sim->pret }} &euro;</a>
                                </div>
                                @if($sim->pret_vechi)
                                <div class="a-container">
                                    <a class="vechi" href="{{ URL::to('anunturi/' . $sim->id) }}">{{ $sim->pret_vechi }} &euro;</a>
                                </div>
                                @endif
                                <div class="clear-both"></div>
                                <div class="updated-at text-center" href="{{ URL::to('anunturi/' . $sim->id) }}">
                                    <p>Ultima actualizare</p>
                                    <p>{{ $sim->updated_at }}</p>
                                </div>
                            </div>
                            <div class="details">
                                <ul>
                                    <li>ID: <b>{{ $sim->cod }}</b></li>

                                    <li>
                                        @if($imobil->sc)
                                        {{ $imobil->sc }} mp
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
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div><!-- /.row -->
@endsection

@section('scripts')
@endsection