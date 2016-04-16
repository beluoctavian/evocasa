@extends('default')

@section('carousel')
<!-- Carousel -->
<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
        <div class="item active">
            <img src="{{ URL::asset('img/slider1.jpg') }}" alt="Chania">
        </div>
        <div class="item">
            <img src="{{ URL::asset('img/slider2.jpg') }}" alt="Chania">
        </div>
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
@endsection

@section('content')
<div class="row">
    <div id="main-content" class="col-xs-12 col-md-9">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12">
                    <div class="main-title">
                        <i class="fa fa-th-list"></i>
                        <h2>Anunturi</h2>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-12">
                    @if(!$page || $page < 1)
                    <?php $page = 1; ?>
                    @endif
                    @for($it = $page * 10 - 10 ; $it <= $page * 10 - 1 && $it < count($anunts) ; $it++)
                    <?php $anunt = $anunts[$it]; ?>
                    <?php $imobil = DB::table('imobils')->where('id_anunt','=',$anunt->id)->first(); ?>
                    <div class="advert-item">
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
                                <a href="{{ URL::to('./' . $link_final) }}" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                            @endif
                            @for($it =  1 ; $it <= floor((count($anunts)-1)/10 + 1) ; $it++)
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

                                <a href="{{ URL::to('./'. $link_final) }}">{{ $it }}</a>
                            </li>
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
                                <a href="{{ URL::to('./'. $link_final) }}" aria-label="Next">
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
    <div id="sidebar" class="hidden-xs hidden-sm col-md-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12">
                    <div class="sidebar-title">
                        <h2>Cautare rapida</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div id="search-box">
                        <form method="POST" action="{{ URL::to('anunturi') }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-row">
                                <div class="form-group col-xs-12">
                                    <label>ID anunt</label>
                                    <div>
                                        <input name="id_anunt" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group col-xs-12">
                                    <label>Pret minim</label>
                                    <div class="input-group">
                                        <input name="pret_minim" type="number" min="0" max="150000" step="1" class="form-control">
                                        <span class="input-group-addon">&euro;</span>
                                    </div>
                                </div>
                                <div class="form-group col-xs-12">
                                    <label>Pret maxim</label>
                                    <div class="input-group">
                                        <input name="pret_maxim" type="number" min="0" max="150000" step="1" class="form-control">
                                        <span class="input-group-addon">&euro;</span>
                                    </div>
                                </div>
                                <div class="form-group col-xs-12">
                                    <label>Numar camere</label>
                                    <select name="numar_camere" class="form-control">
                                        <option value="">Indiferent</option>
                                        @for($it = 0 ; $it <= 5 ; $it++)
                                        <option value="{{ $it }}">{{ $it }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 text-center">
                                    <button type="submit" class="btn btn-warning btn-lg"><i class="fa fa-search"></i> Cauta</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><!-- /.row -->
@endsection

@section('scripts')
<script>
</script>
@endsection