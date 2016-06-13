@extends('default')

@section('in-head')
    <link href="{{ URL::asset('library/ion-rangeslider/css/ion.rangeSlider.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('library/ion-rangeslider/css/ion.rangeSlider.skinNice.css') }}" rel="stylesheet">
@endsection

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
                    @if (Auth::guest())
                        <div class="col-xs-12">
                    @else
                        <div class="col-xs-11 col-xs-offset-0">
                    @endif
                        @foreach ($items as $item)
                            <?php $advert = $item['advert']; ?>
                            <?php $apartment = $item['entity'] ;?>
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
                                            <a href="{{ URL::to('advert/update/' . $advert['id']) }}" class="btn btn-warning"><i class="fa fa-refresh"></i></a>
                                        </div>
                                        <form method="POST" action="{{ URL::to('advert/delete') }}" onSubmit="return confirm('Sigur vrei sa stergi anuntul?');">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" name="id" value="{{ $advert['id'] }}">
                                            <button type="submit" class="btn btn-danger"><i class="fa fa-times"></i></button>
                                        </form>
                                    </div>
                                @endif
                                <div class="row safari-fix">
                                    <div class="col-xs-12 col-sm-3">
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
                                    </div>
                                    <div class="col-xs-12 col-sm-9">
                                        <div class="description">
                                            @if(Auth::guest())
                                                <h2><a class="{{ $advert['inactiv'] == TRUE ? 'red' : ($advert['retras'] == TRUE ? 'grey' : '') }}" href="{{ URL::to('anunturi/' . $advert['id']) }}">
                                                        <span class="grey"><b>[{{ $advert['code'] }}]</b></span>&nbsp;&nbsp;{{ $advert['title'] }}
                                                </a></h2>
                                            @else
                                                <h2>
                                                    <a class="{{ $advert['inactiv'] == TRUE ? 'red' : ($advert['retras'] == TRUE ? 'grey' : '') }}" href="{{ URL::to('advert/edit/' . $advert['id']) }}">
                                                        <span class="grey"><b>[{{ $advert['code'] }}]</b></span>&nbsp;&nbsp;{{ $advert['title'] }}
                                                    </a>
                                                </h2>
                                                <div class="status hidden-xs">
                                                    @foreach ($item['advert_status'] as $status)
                                                        <div class="status-item" title="{{ $status['created_at'] }}">
                                                            <img src="{{ URL::asset("img/status_icons/{$status['title']}.png") }}" />
                                                            @if ($status['count'] > 1)
                                                                <span class="badge">x{{ $status['count'] }}</span>
                                                            @endif
                                                        </div>
                                                    @endforeach
                                                </div>
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
                                                        <p>Adaugat: {{ date("d-m-Y", strtotime($advert['created_at'])) }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="details">
                                                <ul>
                                                    <li>
                                                        @if($apartment['built_area'])
                                                            {{ $apartment['built_area'] }} mp
                                                        @endif
                                                    </li>
                                                    <li class="hidden-xs hidden-sm">
                                                        @if($apartment['partitioning'])
                                                            {{ $apartment['partitioning'] }}
                                                        @endif
                                                    </li>
                                                    <li>
                                                        @if($apartment['floor'])
                                                            Etaj {{ $apartment['floor'] }}
                                                        @endif
                                                    </li>
                                                    <li class="last">
                                                        @if($apartment['built_year'])
                                                            An {{ $apartment['built_year'] }}
                                                        @endif
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="clear-both"></div>
                            </div>
                        @endforeach
                    </div>
                    <div class="col-xs-12 text-center">
                        <div class="pagination">
                            {!! $items->render() !!}
                        </div>
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
                            <form method="GET" action="{{ URL::to('anunturi') }}">
                                <div class="form-row">
                                    <div class="form-group col-xs-12">
                                        <label>ID anunt</label>
                                        <div>
                                            <input name="id_anunt" type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group col-xs-12">
                                        <label for="price_range">Pret</label>
                                        <input type="text" id="price_range" value="">
                                        <div class="hidden">
                                            <input name="pret_minim" id="pret_minim" type="hidden">
                                            <input name="pret_maxim" id="pret_maxim" type="hidden">
                                        </div>
                                    </div>
                                    <div class="form-group col-xs-12">
                                        <label>Numar camere</label>
                                        <select multiple id="numar_camere" name="numar_camere[]" class="form-control">
                                            <option value="1">garsoniera</option>
                                            <option value="2">2 camere</option>
                                            <option value="3">3 camere</option>
                                            <option value="4">4+ camere</option>
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
<script src="{{ URL::asset('library/ion-rangeslider/js/ion-rangeSlider/ion.rangeSlider.min.js') }}"></script>
<script>
    $('select').select2({
        tags: true,
        minimumResultsForSearch: Infinity,
        placeholder: "Indiferent"
    });
    $(window).resize(function() {
        $('select').select2({
            tags: true,
            minimumResultsForSearch: Infinity,
            placeholder: "Indiferent"
        });
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
    $(".status-item").tooltip({ trigger: "hover" });
</script>
@endsection