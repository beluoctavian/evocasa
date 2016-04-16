@extends('default')

@section('in-head')
<script src="{{ URL::asset('js/elastic.js') }}"></script>
@endsection

@section('page-header')
<div class="page-header">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h1>Adauga un anunt</h1>
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
                                    <input name="advert[first_page]" type="checkbox" value="first_page"> Anuntul apare pe prima pagina
                                </label>
                            </div>
                            <div class="form-group col-xs-12 col-sm-12">
                                <label>Titlu anunt</label>
                                <div>
                                    <input name="advert[title]" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="form-group col-xs-12 col-sm-4">
                                <label>Numar camere</label>
                                <div>
                                    <select name="advert[no_rooms]" class="form-control">
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
                                <label>Cartier</label>
                                <div>
                                    <input name="advert[neighborhood]" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="form-group col-xs-12 col-sm-4">
                                <label>Zona</label>
                                <div>
                                    <input name="advert[area]" type="text" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-xs-12 col-sm-4">
                                <label>Pret actual</label>
                                <div class="input-group">
                                    <input name="advert[price]" type="text" class="form-control">
                                    <span class="input-group-addon">&euro;</span>
                                </div>
                            </div>
                            <div class="form-group col-xs-12 col-sm-4">
                                <label>Pret vechi</label>
                                <div class="input-group">
                                    <input name="advert[old_price]" type="text" class="form-control">
                                    <span class="input-group-addon">&euro;</span>
                                </div>
                            </div>
                            <div class="col-xs-12 no-padding">
                                <div class="form-row">
                                    <div class="form-group col-xs-12">
                                        <label>Descriere</label>
                                        <div>
                                            <textarea name="advert[description]" class="form-control" rows="4"></textarea>
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
                                <label>Nume</label>
                                <div>
                                    <input name="nume_proprietar" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="form-group col-xs-12 col-sm-4">
                                <label>Prenume</label>
                                <div>
                                    <input name="prenume_proprietar" type="text" class="form-control">
                                </div>
                            </div>
                            <div id="telefons">
                                <div class="form-group col-xs-12 col-sm-4 telefon-container">
                                    <label>Telefon <a class="adauga-telefon" href="javascript:"><i class="fa fa-plus-square"></i></a></label>
                                    <div>
                                        <input name="telefon_proprietar[]" type="text" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-xs-12 col-sm-8">
                                <label>E-mail</label>
                                <div>
                                    <input name="email_proprietar" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="form-group col-xs-12 col-sm-4">
                                <label>Cadastru</label>
                                <div>
                                    <input name="cadastru_proprietar" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="form-group col-xs-12 col-sm-4">
                                <label>Intabulare</label>
                                <div>
                                    <input name="intabulare_proprietar" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="form-group col-xs-12 col-sm-4">
                                <div>
                                    <label>Certificat energetic</label>
                                    <div>
                                        <input name="certificat_energetic_proprietar" type="text" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-xs-12 col-sm-4 margin-top-small">
                                <div>
                                    <label class="checkbox-inline">
                                        <input name="poze_map_proprietar" type="checkbox"> Poze MAP
                                    </label>
                                </div>
                                <div>
                                    <label class="checkbox-inline">
                                        <input name="bloc_reabilitat" type="checkbox"> Bloc reabilitat
                                    </label>
                                </div>
                            </div>
                            <div class="form-group col-xs-12 col-sm-12">
                                <label>Adresa</label>
                                <div>
                                    <textarea name="adresa_proprietar" class="form-control" rows="2"></textarea>
                                </div>
                            </div>
                            <div class="form-group col-xs-12 col-sm-12">
                                <label>Observatii</label>
                                <div>
                                    <textarea name="observatii_proprietar" class="form-control" rows="2"></textarea>
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
                        <div class="form-row">
                            <div class="form-group col-xs-12 col-sm-4">
                                <label>Suprafata utila</label>
                                <div class="input-group">
                                    <input name="su" type="text" class="form-control">
                                    <span class="input-group-addon">mp</span>
                                </div>
                            </div>
                            <div class="form-group col-xs-12 col-sm-4">
                                <label>Suprafata construita</label>
                                <div class="input-group">
                                    <input name="sc" type="text" class="form-control">
                                    <span class="input-group-addon">mp</span>
                                </div>
                            </div>
                            <div class="form-group col-xs-12 col-sm-4">
                                <label>Compartimentare</label>
                                <div>
                                    <input name="compartimentare" type="text" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-xs-12 col-sm-4">
                                <label>Confort</label>
                                <div>
                                    <input name="confort" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="form-group col-xs-12 col-sm-4">
                                <label>Etaj</label>
                                <div>
                                    <input name="etaj" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="form-group col-xs-12 col-sm-4">
                                <label>An constructie</label>
                                <div>
                                    <input name="an_constructie" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="form-group col-xs-12 col-sm-4">
                                <label>Numar bai</label>
                                <div class="row">
                                    <div class="col-xs-4"><input name="numar_bai" type="text" class="form-control no-padding text-center"></div>
                                    <div class="col-xs-8 no-padding-left"><input name="obs_numar_bai" type="text" class="form-control"></div>
                                </div>
                            </div>
                            <div class="form-group col-xs-12 col-sm-4">
                                <label>Nr. gr. sanitare</label>
                                <div class="row">
                                    <div class="col-xs-4"><input name="numar_bai_serviciu" type="text" class="form-control no-padding text-center"></div>
                                    <div class="col-xs-8 no-padding-left"><input name="obs_numar_bai_serviciu" type="text" class="form-control"></div>
                                </div>
                            </div>
                            <div class="form-group col-xs-12 col-sm-4">
                                <label>Numar balcoane</label>
                                <div class="row">
                                    <div class="col-xs-4"><input name="numar_balcoane" type="text" class="form-control no-padding text-center"></div>
                                    <div class="col-xs-8 no-padding-left"><input name="obs_numar_balcoane" type="text" class="form-control"></div>
                                </div>
                            </div>
                            <div class="form-group col-xs-12 col-sm-4">
                                <label>Loc parcare</label>
                                <div>
                                    <div class="row">
                                        <div class="col-xs-4"><input name="loc_parcare" type="text" class="form-control no-padding text-center"></div>
                                        <div class="col-xs-8 no-padding-left"><input name="obs_loc_parcare" type="text" class="form-control"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-xs-12 col-sm-4">
                                <label>Boxa</label>
                                <div>
                                    <div class="row">
                                        <div class="col-xs-4"><input name="boxa" type="text" class="form-control no-padding text-center"></div>
                                        <div class="col-xs-8 no-padding-left"><input name="obs_boxa" type="text" class="form-control"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-xs-12 col-sm-4">
                                <label>Garaj</label>
                                <div>
                                    <div class="row">
                                        <div class="col-xs-4"><input name="garaj" type="text" class="form-control no-padding text-center"></div>
                                        <div class="col-xs-8 no-padding-left"><input name="obs_garaj" type="text" class="form-control"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- end imobil -->

                    <!-- IMBUNATATIRI -->
                    <div class="col-xs-12 col-sm-6">
                        <div class="main-title">
                            <i class="fa fa-star"></i>
                            <h2>Imbunatatiri</h2>
                        </div>
                        <div class="form-row">
                            <div class="col-xs-6">
                                <div class="form-row">
                                    <div class="col-xs-12">
                                        <label class="checkbox-inline">
                                            <input name="gresie" type="checkbox" value="gresie"> Gresie
                                        </label>
                                    </div>
                                    <div class="col-xs-12">
                                        <label class="checkbox-inline">
                                            <input name="faianta" type="checkbox" value="faianta"> Faianta
                                        </label>
                                    </div>
                                    <div class="col-xs-12">
                                        <label class="checkbox-inline">
                                            <input name="parchet" type="checkbox" value="parchet"> Parchet
                                        </label>
                                    </div>
                                    <div class="col-xs-12">
                                        <label class="checkbox-inline">
                                            <input name="termopan" type="checkbox" value="termopan"> Termopan
                                        </label>
                                    </div>
                                    <div class="col-xs-12">
                                        <label class="checkbox-inline">
                                            <input name="aer" type="checkbox" value="aer"> Aer conditionat
                                        </label>
                                    </div>
                                    <div class="col-xs-12">
                                        <label class="checkbox-inline">
                                            <input name="instalatie_sanitara" type="checkbox" value="instalatie_sanitara"> Instalatie sanitara noua
                                        </label>
                                    </div>
                                    <div class="col-xs-12">
                                        <label class="checkbox-inline">
                                            <input name="instalatie_electrica" type="checkbox" value="instalatie_electrica"> Instalatie electrica noua
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="form-row">
                                    <div class="col-xs-12">
                                        <label class="checkbox-inline">
                                            <input name="contor_gaze" type="checkbox" value="contor_gaze"> Contor gaze individual
                                        </label>
                                    </div>
                                    <div class="col-xs-12">
                                        <label class="checkbox-inline">
                                            <input name="centrala" type="checkbox" value="centrala"> Centrala
                                        </label>
                                    </div>
                                    <div class="col-xs-12">
                                        <label class="checkbox-inline">
                                            <input name="mobilier" type="checkbox" value="mobilier"> Mobilier inclus
                                        </label>
                                    </div>
                                    <div class="col-xs-12">
                                        <label class="checkbox-inline">
                                            <input name="usi_interioare" type="checkbox" value="usa_metalica"> Usi interioare schimbate
                                        </label>
                                    </div>
                                    <div class="col-xs-12">
                                        <label class="checkbox-inline">
                                            <input name="usa_metalica" type="checkbox" value="usa_metalica"> Usa metalica
                                        </label>
                                    </div>
                                    <div class="col-xs-12">
                                        &nbsp;
                                    </div>
                                    <div class="col-xs-12">
                                        <label class="checkbox-inline">
                                            <input name="fara_imbunatatiri" type="checkbox" value="fara_imbunatatiri"> Fara imbunatatiri
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
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