@extends('default')

@section('in-head')
<script src="{{ URL::asset('js/elastic.js') }}"></script>
@endsection

@section('page-header')
<div class="page-header">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h1>
                    @if ($entity_type == 'apartment')
                        Adauga un apartament
                    @elseif ($entity_type == 'house')
                        Adauga o casa
                    @else
                        Adauga un teren
                    @endif
                </h1>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="container-fluid">
            <form method="POST" action="{{ URL::to('advert/add/apartment') }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <!-- DETALII ANUNT -->

                <div class="row margin-bottom">
                    <div class="col-xs-12 col-sm-6">
                        <div class="main-title">
                            <i class="fa fa-file"></i>
                            <h2>Detalii anunt</h2>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-xs-12 col-sm-12">
                                <label class="checkbox-inline">
                                    <input name="advert[first_page]" type="checkbox" value="1"> Anuntul apare pe prima pagina
                                </label>
                            </div>
                            <div class="form-group col-xs-12 col-sm-12">
                                <label for="advert[title]">Titlu anunt</label>
                                <div>
                                    <input id="advert[title]" name="advert[title]" type="text" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group col-xs-12 col-sm-4">
                                <label for="advert[no_rooms]">Numar camere</label>
                                <div>
                                    <select id="advert[no_rooms]" name="advert[no_rooms]" class="form-control">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4+</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-xs-12 col-sm-4">
                                <label for="advert[neighborhood]">Cartier</label>
                                <div>
                                    <input id="advert[neighborhood]" name="advert[neighborhood]" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="form-group col-xs-12 col-sm-4">
                                <label for="advert[area]">Zona</label>
                                <div>
                                    <input id="advert[area]" name="advert[area]" type="text" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-xs-12 col-sm-4">
                                <label for="advert[price]">Pret actual</label>
                                <div class="input-group">
                                    <input id="advert[price]" name="advert[price]" type="text" class="form-control">
                                    <span class="input-group-addon">&euro;</span>
                                </div>
                            </div>
                            <div class="form-group col-xs-12 col-sm-4">
                                <label for="advert[old_price]">Pret vechi</label>
                                <div class="input-group">
                                    <input id="advert[old_price]" name="advert[old_price]" type="text" class="form-control">
                                    <span class="input-group-addon">&euro;</span>
                                </div>
                            </div>
                            <div class="col-xs-12 no-padding">
                                <div class="form-row">
                                    <div class="form-group col-xs-12">
                                        <label for="advert[description]">Descriere</label>
                                        <div>
                                            <textarea id="advert[description]" name="advert[description]" class="form-control" rows="4"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end anunt -->

                    <!-- PROPRIETAR -->
                    <div class="col-xs-12 col-sm-6">
                        <div class="main-title">
                            <i class="fa fa-male"></i>
                            <h2>Detalii proprietar</h2>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-xs-12 col-sm-4">
                                <label for="owner[last_name]">Nume</label>
                                <div>
                                    <input id="owner[last_name]" name="owner[last_name]" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="form-group col-xs-12 col-sm-4">
                                <label for="owner[first_name]">Prenume</label>
                                <div>
                                    <input id="owner[first_name]" name="owner[first_name]" type="text" class="form-control">
                                </div>
                            </div>
                            <div id="telefons">
                                <div class="form-group col-xs-12 col-sm-4 telefon-container">
                                    <label for="owner[phone]">Telefon <a class="adauga-telefon" href="javascript:"><i class="fa fa-plus-square"></i></a></label>
                                    <div>
                                        <input id="owner[phone]" name="owner[phone][]" type="text" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-xs-12 col-sm-8">
                                <label for="owner[email]">E-mail</label>
                                <div>
                                    <input id="owner[email]" name="owner[email]" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="form-group col-xs-12 col-sm-4">
                                <label for="owner[cadaster]">Cadastru</label>
                                <div>
                                    <input id="owner[cadaster]" name="owner[cadaster]" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="form-group col-xs-12 col-sm-4">
                                <label for="owner[registration]">Intabulare</label>
                                <div>
                                    <input id="owner[registration]" name="owner[registration]" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="form-group col-xs-12 col-sm-4">
                                <div>
                                    <label for="owner[energy_certificate]">Certificat energetic</label>
                                    <div>
                                        <input id=owner[energy_certificate] name="owner[energy_certificate]" type="text" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-xs-12 col-sm-4">
                                <div>
                                    <label for="owner[urbanism_certificate]">Certificat energetic</label>
                                    <div>
                                        <input id="owner[urbanism_certificate]" name="owner[urbanism_certificate]" type="text" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-xs-12 col-sm-4 margin-top-small">
                                <div>
                                    <label class="checkbox-inline">
                                        <input name="owner[map_pictures]" type="checkbox" value="1"> Poze MAP
                                    </label>
                                </div>
                                <div>
                                    <label class="checkbox-inline">
                                        <input name="owner[rehabilitated_block]" type="checkbox" value="1"> Bloc reabilitat
                                    </label>
                                </div>
                            </div>
                            <div class="form-group col-xs-12 col-sm-12">
                                <label for="owner[address]">Adresa</label>
                                <div>
                                    <textarea id="owner[address]" name="owner[address]" class="form-control" rows="2"></textarea>
                                </div>
                            </div>
                            <div class="form-group col-xs-12 col-sm-12">
                                <label for="owner[observation]">Observatii (TO DO: link to observation model)</label>
                                <div>
                                    <textarea id="owner[observation]" name="owner[observation]" class="form-control" rows="2"></textarea>
                                </div>
                            </div>
                        </div>
                    </div><!-- end proprietar -->

                </div>

                <!-- DETALII IMOBIL -->
                <div class="row margin-bottom">
                    <div class="col-xs-12 col-sm-6">
                        <div class="main-title">
                            <i class="fa fa-home"></i>
                            <h2>Detalii imobil</h2>
                        </div>
                        @if ($entity_type == 'apartment')
                            <div class="form-row">
                                <div class="form-group col-xs-12 col-sm-4">
                                    <label for="house[usable_area]">Suprafata utila</label>
                                    <div class="input-group">
                                        <input id="house[usable_area]" name="house[usable_area]" type="text" class="form-control">
                                        <span class="input-group-addon">mp</span>
                                    </div>
                                </div>
                                <div class="form-group col-xs-12 col-sm-4">
                                    <label for="house[built_area]">Suprafata construita</label>
                                    <div class="input-group">
                                        <input id="house[built_area]" name="house[built_area]" type="text" class="form-control">
                                        <span class="input-group-addon">mp</span>
                                    </div>
                                </div>
                                <div class="form-group col-xs-12 col-sm-4">
                                    <label for="house[partitioning]">Compartimentare</label>
                                    <div>
                                        <input id="house[partitioning]" name="house[partitioning]" type="text" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-xs-12 col-sm-4">
                                    <label for="house[comfort]">Confort</label>
                                    <div>
                                        <input id="house[comfort]" name="house[comfort]" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group col-xs-12 col-sm-4">
                                    <label for="house[floor]">Etaj</label>
                                    <div>
                                        <input id=house[floor] name="house[floor]" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group col-xs-12 col-sm-4">
                                    <label for="house[built_year]">An constructie</label>
                                    <div>
                                        <input id="house[built_year]" name="house[built_year]" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group col-xs-12 col-sm-4">
                                    <label for="house[bathrooms]">Numar bai</label>
                                    <div class="row">
                                        <div class="col-xs-4"><input id="house[bathrooms]" name="house[bathrooms]" type="text" class="form-control no-padding text-center"></div>
                                        <div class="col-xs-8 no-padding-left"><input title="bathrooms observations" name="house[obs_bathrooms]" type="text" class="form-control"></div>
                                    </div>
                                </div>
                                <div class="form-group col-xs-12 col-sm-4">
                                    <label for="house[sanitary]">Nr. gr. sanitare</label>
                                    <div class="row">
                                        <div class="col-xs-4"><input id="house[sanitary]" name="house[sanitary]" type="text" class="form-control no-padding text-center"></div>
                                        <div class="col-xs-8 no-padding-left"><input title="sanitary" name="house[obs_sanitary]" type="text" class="form-control"></div>
                                    </div>
                                </div>
                                <div class="form-group col-xs-12 col-sm-4">
                                    <label for="house[balconies]">Numar balcoane</label>
                                    <div class="row">
                                        <div class="col-xs-4"><input id="house[balconies]" name="house[balconies]" type="text" class="form-control no-padding text-center"></div>
                                        <div class="col-xs-8 no-padding-left"><input title="balconies observations" name="house[obs_balconies]" type="text" class="form-control"></div>
                                    </div>
                                </div>
                                <div class="form-group col-xs-12 col-sm-4">
                                    <label for="house[parking]">Loc parcare</label>
                                    <div>
                                        <div class="row">
                                            <div class="col-xs-4"><input id="house[parking]" name="house[parking]" type="text" class="form-control no-padding text-center"></div>
                                            <div class="col-xs-8 no-padding-left"><input title="parking observations" name="house[obs_parking]" type="text" class="form-control"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-xs-12 col-sm-4">
                                    <label for="house[storeroom]">Boxa</label>
                                    <div>
                                        <div class="row">
                                            <div class="col-xs-4"><input id="house[storeroom]" name="house[storeroom]" type="text" class="form-control no-padding text-center"></div>
                                            <div class="col-xs-8 no-padding-left"><input title="storeroom observations" name="house[obs_storeroom]" type="text" class="form-control"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-xs-12 col-sm-4">
                                    <label for="house[garage]">Garaj</label>
                                    <div>
                                        <div class="row">
                                            <div class="col-xs-4"><input id="house[garage]" name="house[garage]" type="text" class="form-control no-padding text-center"></div>
                                            <div class="col-xs-8 no-padding-left"><input title="garage observations" name="house[obs_garage]" type="text" class="form-control"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @elseif ($entity_type == 'house')

                        @else

                        @endif
                    </div>

                    <!-- END IMOBIL -->

                    <!-- IMBUNATATIRI -->
                    <div class="col-xs-12 col-sm-6">
                        <div class="main-title">
                            <i class="fa fa-star"></i>
                            <h2>Imbunatatiri</h2>
                        </div>
                        @if ($entity_type == 'apartment')
                            <div class="form-row">
                                <div class="col-xs-6">
                                    <div class="form-row">
                                        <div class="col-xs-12">
                                            <label class="checkbox-inline">
                                                <input name="improvements[gresie]" type="checkbox" value="1"> Gresie
                                            </label>
                                        </div>
                                        <div class="col-xs-12">
                                            <label class="checkbox-inline">
                                                <input name="improvements[faianta]" type="checkbox" value="1"> Faianta
                                            </label>
                                        </div>
                                        <div class="col-xs-12">
                                            <label class="checkbox-inline">
                                                <input name="improvements[parchet]" type="checkbox" value="1"> Parchet
                                            </label>
                                        </div>
                                        <div class="col-xs-12">
                                            <label class="checkbox-inline">
                                                <input name="improvements[termopan]" type="checkbox" value="1"> Termopan
                                            </label>
                                        </div>
                                        <div class="col-xs-12">
                                            <label class="checkbox-inline">
                                                <input name="improvements[aer]" type="checkbox" value="1"> Aer conditionat
                                            </label>
                                        </div>
                                        <div class="col-xs-12">
                                            <label class="checkbox-inline">
                                                <input name="improvements[instalatie_sanitara]" type="checkbox" value="1"> Instalatie sanitara noua
                                            </label>
                                        </div>
                                        <div class="col-xs-12">
                                            <label class="checkbox-inline">
                                                <input name="improvements[instalatie_electrica]" type="checkbox" value="1"> Instalatie electrica noua
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="form-row">
                                        <div class="col-xs-12">
                                            <label class="checkbox-inline">
                                                <input name="improvements[contor_gaze]" type="checkbox" value="1"> Contor gaze individual
                                            </label>
                                        </div>
                                        <div class="col-xs-12">
                                            <label class="checkbox-inline">
                                                <input name="improvements[centrala]" type="checkbox" value="1"> Centrala
                                            </label>
                                        </div>
                                        <div class="col-xs-12">
                                            <label class="checkbox-inline">
                                                <input name="improvements[mobilier]" type="checkbox" value="1"> Mobilier inclus
                                            </label>
                                        </div>
                                        <div class="col-xs-12">
                                            <label class="checkbox-inline">
                                                <input name="improvements[usi_interioare]" type="checkbox" value="1"> Usi interioare schimbate
                                            </label>
                                        </div>
                                        <div class="col-xs-12">
                                            <label class="checkbox-inline">
                                                <input name="improvements[usa_metalica]" type="checkbox" value="1"> Usa metalica
                                            </label>
                                        </div>
                                        <div class="col-xs-12">
                                            &nbsp;
                                        </div>
                                        <div class="col-xs-12">
                                            <label class="checkbox-inline">
                                                <input name="improvements[fara_imbunatatiri]" type="checkbox" value="1"> Fara imbunatatiri
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @elseif ($entity_type == 'house')

                        @else

                        @endif
                    </div><!-- end imbunatatiri -->

                </div><!-- /.row -->

                <div class="row">
                    <div class="col-xs-12 text-center">
                        <button type="submit" class="btn btn-warning btn-lg">Adauga anuntul</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    var tels = 2;
    $(document).ready(function(){
       $('.adauga-telefon').on('click', function(e){
           var el = $(".telefon-container:eq(0)").clone();
           $('input',el).val("");
           $('label',el).text($('label',el).text() + ' ' + tels);
           tels = tels + 1;
           console.log(el);
           $("#telefons").append(el.clone());
       });
    });
</script>
<script type="text/javascript">
    $('textarea').elastic();
</script>
@endsection