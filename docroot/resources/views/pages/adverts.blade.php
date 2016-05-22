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

                <form method="get" action="{{ URL::to('anunturi') }}">

                    <div class="row margin-bottom" id="search-filter-container">
                        <div class="col-xs-12">
                            <div class="main-title">
                                <i class="fa fa-search"></i>
                                <h2>Cautare avansata</h2>
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <div id="search-box">
                                <input type="hidden" name = 'tip' value="{{$type}}">
                                @if(!Auth::guest())
                                    <div class="row">
                                        <div class="form-group col-xs-6 col-sm-2">
                                            <label>Telefon proprietar</label>
                                            <div>
                                                <input name="telefon_proprietar" type="text" class="form-control" value="{{ Input::get('telefon_proprietar') ? Input::get('telefon_proprietar') : '' }}">
                                            </div>
                                        </div>
                                        <div class="form-group col-xs-6 col-sm-2">
                                            <label>Stare</label>
                                            <div>
                                                <select name="status" class="form-control">
                                                    <?php
                                                      $status = Input::get('status') ? Input::get('status') : 'activ'
                                                    ?>
                                                    <option value="any">Indiferent</option>
                                                    <option value="activ" {{ $status == 'activ' ? 'selected' : '' }}>Activ</option>
                                                    <option value="inactiv" {{ $status == 'inactiv' ? 'selected' : '' }}>Inactiv</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <div class="row">
                                    <div class="form-group col-xs-3 col-sm-2">
                                        <label>ID anunt</label>
                                        <div>
                                            <input name="id_anunt" type="text" class="form-control" value="{{ Input::get('id_anunt') ? Input::get('id_anunt') : '' }}">
                                        </div>
                                    </div>
                                    <div class="form-group col-xs-9 col-sm-6">
                                        <label>Cuvinte cheie</label>
                                        <div>
                                            <input name="cuvinte_cheie" type="text" class="form-control" value="{{ Input::get('cuvinte_cheie') ? Input::get('cuvinte_cheie') : '' }}">
                                        </div>
                                    </div>

                                    <div class="form-group col-xs-6 col-sm-2">
                                        <label>Cartier</label>
                                        <div>
                                            <select multiple id="neighborhood" name="cartier[]" class="form-control">
                                                <option value="">Indiferent</option>
                                                <?php
                                                    $cartiere = Input::get('cartier') == null ? [] : Input::get('cartier');
                                                    sort($cartiere);
                                                ?>
                                                @foreach($neighborhoods as $neighborhood)
                                                    <option value="{{ $neighborhood }}" {{ in_array($neighborhood,$cartiere) ? 'selected' : '' }}>{{ $neighborhood }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-xs-6 col-sm-2">
                                        <label>Zona</label>
                                        <div>
                                            <select multiple id="area" name="zona[]" class="form-control">
                                                <option value="">Indiferent</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-xs-6 col-sm-2">
                                        <label for="price_range">Pret</label>
                                        <input type="text" id="price_range" value="">
                                        <div class="hidden">
                                            <input name="pret_minim" id="pret_minim" type="hidden" value="{{ Input::get('pret_minim') ? Input::get('pret_minim') : '' }}">
                                            <input name="pret_maxim" id="pret_maxim" type="hidden" value="{{ Input::get('pret_maxim') ? Input::get('pret_maxim') : '' }}">
                                        </div>
                                    </div>
                                    <div class="form-group col-xs-6 col-sm-2">
                                        <label for="area_range">Suprafata</label>
                                        <input type="text" id="area_range" value="">
                                        <div class="hidden">
                                            <input name="suprafata_minima" id="suprafata_minima" type="hidden" value="{{ Input::get('suprafata_minima') ? Input::get('suprafata_minima') : '' }}">
                                            <input name="suprafata_maxima" id="suprafata_maxima" type="hidden" value="{{ Input::get('suprafata_maxima') ? Input::get('suprafata_maxima') : '' }}">
                                        </div>
                                    </div>
                                    @if ($type == null or $type == 'apartament' or $type == 'casa')
                                        <div class="form-group col-xs-6 col-sm-2">
                                            <label for="an_constructie_range">An constructie</label>
                                            <input type="text" id="an_constructie_range" value="">
                                            <div class="hidden">
                                                <input name="an_constructie_minim" id="an_constructie_minim" type="hidden" value="{{ Input::get('an_constructie_minim') ? Input::get('an_constructie_minim') : '' }}">
                                                <input name="an_constructie_maxim" id="an_constructie_maxim" type="hidden" value="{{ Input::get('an_constructie_maxim') ? Input::get('an_constructie_maxim') : '' }}">
                                            </div>
                                        </div>
                                        <div class="form-group col-xs-6 col-sm-2">
                                            <label>Numar camere</label>
                                            <select multiple id="numar_camere" name="numar_camere[]" class="form-control">
                                                <?php $numar_camere = Input::get('numar_camere') == null ? [] : Input::get('numar_camere'); ?>
                                                <option value="1" {{ in_array(1,$numar_camere) ? 'selected' : '' }}>garsoniera</option>
                                                <option value="2" {{ in_array(2,$numar_camere) ? 'selected' : '' }}>2 camere</option>
                                                <option value="3" {{ in_array(3,$numar_camere) ? 'selected' : '' }}>3 camere</option>
                                                <option value="4" {{ in_array(4,$numar_camere) ? 'selected' : '' }}>4+ camere</option>
                                            </select>
                                        </div>
                                        @if ($type != 'casa')
                                            <div class="form-group col-xs-6 col-sm-2">
                                                <label for="etaj">Etaj</label>
                                                <select multiple id="etaj" name="etaj[]" class="form-control">
                                                    <?php $etaj = Input::get('etaj') == null ? [] : Input::get('etaj'); ?>
                                                    <option value="demisol" {{ in_array('demisol', $etaj) ? 'selected' : '' }}>Demisol</option>
                                                    <option value="parter" {{ in_array('parter', $etaj) ? 'selected' : '' }}>Parter</option>
                                                    @for ($i = 1; $i <= 20; $i++)
                                                        <option value="{{ $i }}" {{ in_array($i, $etaj) ? 'selected' : '' }}>Etaj {{ $i }}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                            <div class="form-group col-xs-6 col-sm-2">
                                                <label>Compartimentare</label>
                                                <div>
                                                    <select multiple name="compartimentare[]" id="partitioning" class="form-control">
                                                        <option value="">Indiferent</option>
                                                        <?php
                                                            $input_partitioning = Input::get('compartimentare') ? Input::get('compartimentare') : [];
                                                        ?>
                                                        @foreach($partitions as $partition)
                                                            <option value="{{ $partition }}" {{ in_array($partition,$input_partitioning) ? 'selected' : '' }}>{{ $partition }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        @endif
                                    @endif
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 text-center">
                                        <button type="submit" class="btn btn-warning btn-md"><i class="fa fa-search"></i> Cauta</button>
                                        <a href="{{ URL::to('anunturi') }}" class="btn btn-warning btn-md"><i class="fa fa-trash-o"></i> Reset</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="main-title">
                                <i class="fa fa-th-list"></i>
                                <h2>Anunturi</h2>
                                <div class="pull-right sortare-container">
                                    <label for="sortare">Sortare</label>
                                    <div>
                                        <select name="sortare" id="sortare" class="form-control">
                                            <option value="">Implicit</option>
                                            <option value="price_asc" {{ Input::get('sortare') == 'price_asc' ? 'selected' : '' }}>Pret (cresc.)</option>
                                            <option value="price_desc" {{ Input::get('sortare') == 'price_desc' ? 'selected' : '' }}>Pret (desc.)</option>
                                            <option value="date_asc" {{ Input::get('sortare') == 'date_asc' ? 'selected' : '' }}>Data publicarii (cresc.)</option>
                                            <option value="date_desc" {{ Input::get('sortare') == 'date_desc' ? 'selected' : '' }}>Data publicarii (desc.)</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="row" id="anunturi">
                    <div class="col-xs-12 col-sm-10 col-sm-offset-1">
                        @foreach($adverts as $item)
                            <?php
                                $entity = $item['entity'];
                                $advert = $item['advert'];
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
                                            <a href="{{ URL::to('advert/update/' . $advert['id']) }}" class="btn btn-warning"><i class="fa fa-refresh"></i></a>
                                        </div>
                                        <form method="POST" action="{{ URL::to('advert/delete') }}" onSubmit="return confirm('Sigur vrei sa stergi anuntul?');">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" name="id" value="{{ $advert['id'] }}">
                                            <button type="submit" class="btn btn-danger"><i class="fa fa-times"></i></button>
                                        </form>
                                    </div>
                                @endif
                                <div class="row">
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
                                                <h2><a class="{{ $advert['inactiv'] == TRUE ? 'red' : ($advert['retras'] == TRUE ? 'grey' : '') }}" href="{{ URL::to('anunturi/' . $advert['id']) }}">{{ $advert['title'] }}</a></h2>
                                            @else
                                                <h2><a class="{{ $advert['inactiv'] == TRUE ? 'red' : ($advert['retras'] == TRUE ? 'grey' : '') }}" href="{{ URL::to('advert/edit/' . $advert['id']) }}">{{ $advert['title'] }}</a></h2>
                                            @endif
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
                                                           {{ $entity['built_area'] }} mp
                                                        </li>
                                                    @endif
                                                    @if(!empty($entity['land_area']))
                                                        <li>
                                                           {{ $entity['land_area'] }} mp
                                                        </li>
                                                    @endif
                                                    @if(!empty($entity['total_area']))
                                                        <li>
                                                           {{ $entity['total_area'] }} mp
                                                        </li>
                                                    @endif

                                                    @if(!empty($entity['partitioning']))
                                                        <li class="hidden-xs hidden-sm">
                                                            {{ $entity['partitioning'] }}
                                                        </li>
                                                    @endif

                                                    @if(!empty($entity['street_opening']))
                                                        <li class="hidden-xs hidden-sm">
                                                           Street opening:<b> {{ $entity['street_opening'] }}</b> m
                                                        </li>
                                                    @endif

                                                    @if(!empty($entity['floor']))
                                                        <li class="hidden-xs hidden-sm">
                                                            Etaj: {{ $entity['floor'] }}
                                                        </li>
                                                    @endif

                                                    @if(!empty($entity['built_year']))
                                                        <li>
                                                            An: {{ $entity['built_year'] }}
                                                        </li>
                                                    @endif

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
    function format(option) {
        if ('children' in option) {
            return option.text;
        }
        if (option.selected == true) {
            return '<span class="fa fa-check-square-o pull-left"></span><span class="text">' + option.text + '</span>';
        }
        else {
            return '<span class="fa fa-square-o pull-left"></span><span class="text">' + option.text + '</span>';
        }
    }
    $('select').select2({
        minimumResultsForSearch: Infinity,
        placeholder: "Indiferent",
        escapeMarkup: function (m) {return m;},
        templateResult: format
    });
    $('#price_range').ionRangeSlider({
        type: 'double',
        min: {{ $input_defaults['pret_minim'] }},
        max: {{ $input_defaults['pret_maxim'] }},
        step: 1000,
        from: {{ Input::get('pret_minim') || Input::get('pret_minim') === '0' ? Input::get('pret_minim') : $input_defaults['pret_minim'] }},
        to: {{ Input::get('pret_maxim') || Input::get('pret_maxim') === '0' ? Input::get('pret_maxim') : $input_defaults['pret_maxim'] }},
        postfix: "&euro;",
        onChange: function (data) {
            $('#pret_minim').val(data.from);
            $('#pret_maxim').val(data.to);
        }
    });
    @if ($type == null or $type == 'apartament' or $type == 'casa')
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
    @endif
    $('#area_range').ionRangeSlider({
        type: 'double',
        min: {{ $input_defaults['suprafata_minima'] }},
        max: {{ $input_defaults['suprafata_maxima'] }},
        step: 1,
        from: {{ Input::get('suprafata_minima') ? Input::get('suprafata_minima') : $input_defaults['suprafata_minima'] }},
        to: {{ Input::get('suprafata_maxima') ? Input::get('suprafata_maxima') : $input_defaults['suprafata_maxima'] }},
        prettify_enabled: false,
        postfix: "mp",
        onChange: function (data) {
            $('#suprafata_minima').val(data.from);
            $('#suprafata_maxima').val(data.to);
        }
    });
    $(".status-item").tooltip({ trigger: "hover" });

    $('#sortare').change(function() {
        this.form.submit();
    });

    // todo:get child and save to database if not exist
    $('#neighborhood').on("change", function (e) {
        $('#area')
            .empty();
        $.ajax({
               type: "GET",
                url: '/loadData/' + $(this).val(),
                success: function(json) {
                    $.each(json, function(i, value) {
                        var id = "#opt" + json[i].id;
                        var opt = '<optgroup id="opt'+json[i].id+'" label=' +'"' + json[i].title + '"' +'></optgroup>';
                        $("#area").append(opt);
                        if(value.children)
                        $.each(value.children, function(i, children){
                            if ($.inArray(children, zone) > -1) {
                                var option = '<option selected>' + children + '</option>';
                                $(id).append(option);
                            }
                            else
                            {
                                var option = '<option>' + children + '</option>';

                                $(id).append(option);
                            }
                        });
                    });
            },
        });
    });

    $( window ).load(function() {
        ceva = '{{ $zona }}' ;
        zone = ceva.split(',');
        val = $("#neighborhood").val();
        $.ajax({
            type: "GET",
            url: '/loadData/' + val,
            success: function(json) {
                if(ceva == '')
                {
                    $.each(json, function(i, value) {
                        var id = "#opt" + json[i].id;
                        var opt = '<optgroup id="opt'+json[i].id+'" label=' +'"' + json[i].title + '"' +'></optgroup>';
                        $("#area").append(opt);
                        if(value.children)

                        $.each(value.children, function(i, value2){
                            var option = '<option>' + value2 + '</option>';
                            $(id).append(option);
                        });
                    });
                }
                else
                {
                    //zone luate din get
                    //json, value luate din search
                    $.each(json, function(i, value) {
                        var id = "#opt" + json[i].id;
                        var opt = '<optgroup id="opt' + json[i].id + '" label=' + '"' + json[i].title + '"' + '></optgroup>';
                        $("#area").append(opt);
                        if(value.children){
                            $.each(value.children, function(i, children){
                                if ($.inArray(children, zone) > -1) {
                                    var option = '<option selected>' + children + '</option>';
                                    $(id).select2().append($('<option>').text(children).attr('value', children).attr('selected', true));
                                }
                                else
                                {
                                    var option = '<option>' + children + '</option>';

                                    $(id).append(option);
                                }
                        });
                        }
                    });

                }
            },
        });
    });


</script>
@endsection