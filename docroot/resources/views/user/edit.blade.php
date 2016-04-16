@extends('default')

@section('in-head')
<script src="{{ URL::asset('js/elastic.js') }}"></script>
@endsection

@section('page-header')
<div class="page-header">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h1>Editeaza anuntul</h1>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div id="printable-area">
        <div class="container-fluid">
            @if(Session::has('success'))
            <div class="row">
                <div class="col-xs-12">
                    <div class="alert alert-success">
                        <span>Ati editat anuntul cu succes!</span>
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                    </div>
                </div>
            </div>
            @endif
            @if(Session::has('successAdd'))
            <div class="row">
                <div class="col-xs-12">
                    <div class="alert alert-success">
                        <span>Ati adaugat anuntul cu succes!</span>
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                    </div>
                </div>
            </div>
            @endif
            <form method="POST" action="{{ URL::to('editeaza-anunt') }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="id" value="{{ $anunt->id }}">
                <!-- DETALII ANUNT -->
                <div class="row margin-bottom">
                    <div class="col-xs-12 col-sm-6">
                        <div class="main-title">
                            <i class="fa fa-file"></i>
                            <h2>Detalii anunt: <a href="{{ URL::to('anunturi/' . $anunt->id) }}">{{ $anunt->cod }}</a></h2>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-xs-12 col-sm-12 statusuri">
                                <div><label>Statusuri</label></div>
                                <div class="btn-group" data-toggle="buttons">
                                    <label class="btn btn-default {{ $anunt->first_page ? 'active' : ''}}">
                                        <input name="first_page" type="checkbox" value="first_page"  {{ $anunt->first_page ? "checked" : ""}}> Anuntul apare pe prima pagina
                                    </label>
                                </div>
                                <div class="btn-group" data-toggle="buttons">
                                    <label class="btn btn-default {{ strpos($anunt->status, 'inactiv') !== false ? 'active' : ''}}">
                                        <input name="status[]" type="checkbox" value="inactiv"  {{ strpos($anunt->status, 'inactiv') !== false ? "checked" : ""}}> Inactiv
                                    </label>
                                </div>
                                <div class="btn-group" data-toggle="buttons">
                                    <label class="btn btn-default {{ strpos($anunt->status, 'telefonDat') !== false ? 'active' : ''}}">
                                        <input name="status[]" type="checkbox" value="telefonDat"  {{ strpos($anunt->status, 'telefonDat') !== false ? "checked" : ""}}> Telefon dat
                                    </label>
                                </div>
                                <div class="btn-group" data-toggle="buttons">
                                    <label class="btn btn-default {{ strpos($anunt->status, 'nuRaspunde') !== false ? 'active' : ''}}">
                                        <input name="status[]" type="checkbox" value="nuRaspunde"  {{ strpos($anunt->status, 'nuRaspunde') !== false ? "checked" : ""}}> Nu raspunde
                                    </label>
                                </div>
                                <div class="btn-group" data-toggle="buttons">
                                    <label class="btn btn-default {{ strpos($anunt->status, 'telefonInchis') !== false ? 'active' : ''}}">
                                        <input name="status[]" type="checkbox" value="telefonInchis"  {{ strpos($anunt->status, 'telefonInchis') !== false ? "checked" : ""}}> Telefon inchis
                                    </label>
                                </div>
                                <div class="btn-group" data-toggle="buttons">
                                    <label class="btn btn-default {{ strpos($anunt->status, 'telefonGresit') !== false ? 'active' : ''}}">
                                        <input name="status[]" type="checkbox" value="telefonGresit"  {{ strpos($anunt->status, 'telefonGresit') !== false ? "checked" : ""}}> Numar de telefon gresit
                                    </label>
                                </div>
                                <div class="btn-group" data-toggle="buttons">
                                    <label class="btn btn-default {{ strpos($anunt->status, 'telefonInactiv') !== false ? 'active' : ''}}">
                                        <input name="status[]" type="checkbox" value="telefonInactiv"  {{ strpos($anunt->status, 'telefonInactiv') !== false ? "checked" : ""}}> Numar de telefon inactiv
                                    </label>
                                </div>
                                <div class="btn-group" data-toggle="buttons">
                                    <label class="btn btn-default {{ strpos($anunt->status, 'nuColaboreaza') !== false ? 'active' : ''}}">
                                        <input name="status[]" type="checkbox" value="nuColaboreaza"  {{ strpos($anunt->status, 'nuColaboreaza') !== false ? "checked" : ""}}> Nu colaboreaza
                                    </label>
                                </div>
                                <div class="btn-group" data-toggle="buttons">
                                    <label class="btn btn-default {{ strpos($anunt->status, 'retrasMomentan') !== false ? 'active' : ''}}">
                                        <input name="status[]" type="checkbox" value="retrasMomentan"  {{ strpos($anunt->status, 'retrasMomentan') !== false ? "checked" : ""}}> Retras momentan
                                    </label>
                                </div>
                            </div>
                            <div class="form-group col-xs-12 col-sm-12">
                                <label>Titlu anunt</label>
                                <div>
                                    <textarea name="titlu" class="form-control" rows="1">{{ $anunt->titlu }}</textarea>
                                </div>
                            </div>
                            <div class="form-group col-xs-12 col-sm-4">
                                <label>Tip</label>
                                <div>
                                    <select name="tip" class="form-control">
                                        <option value="Vanzare" {{ $anunt->tip == "Vanzare" ? "selected='selected'" : '' }}>Vanzare</option>
                                        <option value="Inchiriere" {{ $anunt->tip == "Inchiriere" ? "selected='selected'" : '' }}>Inchiriere</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-xs-12 col-sm-4">
                                <label>Categorie</label>
                                <div>
                                    <select name="categorie" class="form-control">
                                        <option value="Apartament" {{ $anunt->categorie == "Apartament" ? "selected='selected'" : '' }}>Apartament</option>
                                        <option value="Garsoniera" {{ $anunt->categorie == "Garsoniera" ? "selected='selected'" : '' }}>Garsoniera</option>
                                        <option value="Casa" {{ $anunt->categorie == "Casa" ? "selected='selected'" : '' }}>Casa</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-xs-12 col-sm-4">
                                <label>Numar camere</label>
                                <div>
                                    <select name="nr_camere" class="form-control">
                                        <option value="1" {{ $anunt->nr_camere == "1" ? "selected='selected'" : '' }}>1</option>
                                        <option value="2" {{ $anunt->nr_camere == "2" ? "selected='selected'" : '' }}>2</option>
                                        <option value="3" {{ $anunt->nr_camere == "3" ? "selected='selected'" : '' }}>3</option>
                                        <option value="4" {{ $anunt->nr_camere == "4" ? "selected='selected'" : '' }}>4+</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-xs-12 col-sm-4">
                                <label>Oras</label>
                                <div>
                                    <input name="oras" type="text" class="form-control" value="{{ $anunt->oras }}">
                                </div>
                            </div>
                            <div class="form-group col-xs-12 col-sm-4">
                                <label>Cartier</label>
                                <div>
                                    <input name="cartier" type="text" class="form-control" value="{{ $anunt->cartier }}">
                                </div>
                            </div>
                            <div class="form-group col-xs-12 col-sm-4">
                                <label>Zona</label>
                                <div>
                                    <input name="zona" type="text" class="form-control" value="{{ $anunt->zona }}">
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-xs-12 col-sm-4 no-padding">
                                <div class="form-row">
                                    <div class="form-group col-xs-12">
                                        <label>Pret actual</label>
                                        <div class="input-group">
                                            <input name="pret" type="text" class="form-control" value="{{ $anunt->pret }}">
                                            <span class="input-group-addon">&euro;</span>
                                        </div>
                                    </div>
                                    <div class="form-group col-xs-12">
                                        <label>Pret vechi</label>
                                        <div class="input-group">
                                            <input name="pret_vechi" type="text" class="form-control" value="{{ $anunt->pret_vechi ? $anunt->pret_vechi : '' }}">
                                            <span class="input-group-addon">&euro;</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-8 no-padding">
                                <div class="form-row">
                                    <div class="form-group col-xs-12">
                                        <label>Descriere</label>
                                        <div>
                                            <textarea name="descriere" class="form-control" rows="4">{{ str_ireplace("<br />","\r\n",$anunt->descriere) }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
                                    <input name="nume_proprietar" type="text" class="form-control" value="{{ $proprietar->nume }}">
                                </div>
                            </div>
                            <div class="form-group col-xs-12 col-sm-4">
                                <label>Prenume</label>
                                <div>
                                    <input name="prenume_proprietar" type="text" class="form-control" value="{{ $proprietar->prenume }}">
                                </div>
                            </div>
                            <div id="telefons">
                                <?php $telefons = (explode(",",$proprietar->telefon)); $it = 2; ?>
                                <div class="form-group col-xs-12 col-sm-4 telefon-container">
                                    <label>Telefon <a class="adauga-telefon" href="javascript:"><i class="fa fa-plus-square"></i></a></label>
                                    <div>
                                        <input name="telefon_proprietar[]" type="text" class="form-control" value="{{ $telefons[0] }}">
                                    </div>
                                </div>
                                @foreach($telefons as $tel)
                                @if($tel != "" && $tel != $telefons[0])
                                <div class="form-group col-xs-12 col-sm-4 telefon-container">
                                    <label>Telefon {{ $it }}</label>
                                    <?php $it++; ?>
                                    <div>
                                        <input name="telefon_proprietar[]" type="text" class="form-control" value="{{ $tel }}">
                                    </div>
                                </div>
                                @endif
                                @endforeach
                            </div>
                            <div class="form-group col-xs-12 col-sm-8">
                                <label>E-mail</label>
                                <div>
                                    <input name="email_proprietar" type="text" class="form-control" value="{{ $proprietar->email }}">
                                </div>
                            </div>
                            <div class="form-group col-xs-12 col-sm-4">
                                <label>Cadastru</label>
                                <div>
                                    <input name="cadastru_proprietar" type="text" class="form-control" value="{{ $proprietar->cadastru }}">
                                </div>
                            </div>
                            <div class="form-group col-xs-12 col-sm-4">
                                <label>Intabulare</label>
                                <div>
                                    <input name="intabulare_proprietar" type="text" class="form-control" value="{{ $proprietar->intabulare }}">
                                </div>
                            </div>
                            <div class="form-group col-xs-12 col-sm-4">
                                <div>
                                    <label>Certificat energetic</label>
                                    <div>
                                        <input name="certificat_energetic_proprietar" type="text" class="form-control" value="{{ $proprietar->certificat_energetic }}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-xs-12 col-sm-4 margin-top-small">
                                <div>
                                    <label class="checkbox-inline">
                                        <input name="poze_map_proprietar" type="checkbox" {{ $proprietar->poze_map ? "checked" : ""}}> Poze MAP
                                    </label>
                                </div>
                                <div>
                                    <label class="checkbox-inline">
                                        <input name="bloc_reabilitat" type="checkbox" {{ $proprietar->bloc_reabilitat ? "checked" : ""}}> Bloc reabilitat
                                    </label>
                                </div>
                            </div>
                            <div class="form-group col-xs-12 col-sm-12">
                                <label>Adresa</label>
                                <div>
                                    <textarea name="adresa_proprietar" class="form-control" rows="2">{{ $proprietar->adresa }}</textarea>
                                </div>
                            </div>
                            <div class="form-group col-xs-12 col-sm-12">
                                <label>Observatii</label>
                                <div>
                                    <textarea name="observatii_proprietar" class="form-control" rows="2">{{ $proprietar->observatii }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
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
                                    <input name="su" type="text" class="form-control" value="{{ $imobil->su }}">
                                    <span class="input-group-addon">mp</span>
                                </div>
                            </div>
                            <div class="form-group col-xs-12 col-sm-4">
                                <label>Suprafata construita</label>
                                <div class="input-group">
                                    <input name="sc" type="text" class="form-control" value="{{ $imobil->sc }}">
                                    <span class="input-group-addon">mp</span>
                                </div>
                            </div>
                            <div class="form-group col-xs-12 col-sm-4">
                                <label>Compartimentare</label>
                                <div>
                                    <input name="compartimentare" type="text" class="form-control" value="{{ $imobil->compartimentare }}">
                                </div>
                            </div>
                            <div class="form-group col-xs-12 col-sm-4">
                                <label>Confort</label>
                                <div>
                                    <input name="confort" type="text" class="form-control" value="{{ $imobil->confort }}">
                                </div>
                            </div>
                            <div class="form-group col-xs-12 col-sm-4">
                                <label>Etaj</label>
                                <div>
                                    <input name="etaj" type="text" class="form-control" value="{{ $imobil->etaj }}">
                                </div>
                            </div>
                            <div class="form-group col-xs-12 col-sm-4">
                                <label>An constructie</label>
                                <div>
                                    <input name="an_constructie" type="text" class="form-control" value="{{ $imobil->an_constructie }}">
                                </div>
                            </div>
                            <div class="form-group col-xs-12 col-sm-4">
                                <label>Numar bai</label>
                                <div class="row">
                                    <div class="col-xs-4"><input name="numar_bai" type="text" class="form-control no-padding text-center" value="{{ $imobil->numbar_bai }}"></div>
                                    <div class="col-xs-8 no-padding-left"><input name="obs_numar_bai" type="text" class="form-control" value="{{ $imobil->obs_numbar_bai }}"></div>
                                </div>
                            </div>
                            <div class="form-group col-xs-12 col-sm-4">
                                <label>Nr. gr. sanitare</label>
                                <div class="row">
                                    <div class="col-xs-4"><input name="numar_bai_serviciu" type="text" class="form-control no-padding text-center" value="{{ $imobil->numbar_bai_serviciu }}"></div>
                                    <div class="col-xs-8 no-padding-left"><input name="obs_numar_bai_serviciu" type="text" class="form-control" value="{{ $imobil->obs_numbar_bai_serviciu }}"></div>
                                </div>
                            </div>
                            <div class="form-group col-xs-12 col-sm-4">
                                <label>Numar balcoane</label>
                                <div class="row">
                                    <div class="col-xs-4"><input name="numar_balcoane" type="text" class="form-control no-padding text-center" value="{{ $imobil->numbar_balcoane }}"></div>
                                    <div class="col-xs-8 no-padding-left"><input name="obs_numar_balcoane" type="text" class="form-control" value="{{ $imobil->obs_numbar_balcoane }}"></div>
                                </div>
                            </div>
                            <div class="form-group col-xs-12 col-sm-4">
                                <label>Loc parcare</label>
                                <div>
                                    <div class="row">
                                        <div class="col-xs-4"><input name="loc_parcare" type="text" class="form-control no-padding text-center" value="{{ $imobil->loc_parcare }}"></div>
                                        <div class="col-xs-8 no-padding-left"><input name="obs_loc_parcare" type="text" class="form-control" value="{{ $imobil->obs_loc_parcare }}"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-xs-12 col-sm-4">
                                <label>Boxa</label>
                                <div>
                                    <div class="row">
                                        <div class="col-xs-4"><input name="boxa" type="text" class="form-control no-padding text-center" value="{{ $imobil->boxa }}"></div>
                                        <div class="col-xs-8 no-padding-left"><input name="obs_boxa" type="text" class="form-control" value="{{ $imobil->obs_boxa }}"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-xs-12 col-sm-4">
                                <label>Garaj</label>
                                <div>
                                    <div class="row">
                                        <div class="col-xs-4"><input name="garaj" type="text" class="form-control no-padding text-center" value="{{ $imobil->garaj }}"></div>
                                        <div class="col-xs-8 no-padding-left"><input name="obs_garaj" type="text" class="form-control" value="{{ $imobil->obs_garaj }}"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
                                            <input name="gresie" type="checkbox" value="gresie" {{ $imbunat->gresie ? "checked" : ""}}> Gresie
                                        </label>
                                    </div>
                                    <div class="col-xs-12">
                                        <label class="checkbox-inline">
                                            <input name="faianta" type="checkbox" value="faianta" {{ $imbunat->faianta ? "checked" : ""}}> Faianta
                                        </label>
                                    </div>
                                    <div class="col-xs-12">
                                        <label class="checkbox-inline">
                                            <input name="parchet" type="checkbox" value="parchet" {{ $imbunat->parchet ? "checked" : ""}}> Parchet
                                        </label>
                                    </div>
                                    <div class="col-xs-12">
                                        <label class="checkbox-inline">
                                            <input name="termopan" type="checkbox" value="termopan" {{ $imbunat->termopan ? "checked" : ""}}> Termopan
                                        </label>
                                    </div>
                                    <div class="col-xs-12">
                                        <label class="checkbox-inline">
                                            <input name="aer" type="checkbox" value="aer" {{ $imbunat->aer ? "checked" : ""}}> Aer conditionat
                                        </label>
                                    </div>
                                    <div class="col-xs-12">
                                        <label class="checkbox-inline">
                                            <input name="instalatie_sanitara" type="checkbox" value="instalatie_sanitara" {{ $imbunat->instalatie_sanitara ? "checked" : ""}}> Instalatie sanitara noua
                                        </label>
                                    </div>
                                    <div class="col-xs-12">
                                        <label class="checkbox-inline">
                                            <input name="instalatie_electrica" type="checkbox" value="instalatie_electrica" {{ $imbunat->instalatie_electrica ? "checked" : ""}}> Instalatie electrica noua
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="form-row">
                                    <div class="col-xs-12">
                                        <label class="checkbox-inline">
                                            <input name="contor_gaze" type="checkbox" value="contor_gaze" {{ $imbunat->contor_gaze ? "checked" : ""}}> Contor gaze individual
                                        </label>
                                    </div>
                                    <div class="col-xs-12">
                                        <label class="checkbox-inline">
                                            <input name="centrala" type="checkbox" value="centrala" {{ $imbunat->centrala ? "checked" : ""}}> Centrala
                                        </label>
                                    </div>
                                    <div class="col-xs-12">
                                        <label class="checkbox-inline">
                                            <input name="mobilier" type="checkbox" value="mobilier" {{ $imbunat->mobilier ? "checked" : ""}}> Mobilier inclus
                                        </label>
                                    </div>
                                    <div class="col-xs-12">
                                        <label class="checkbox-inline">
                                            <input name="usi_interioare" type="checkbox" value="usa_metalica" {{ $imbunat->usi_interioare ? "checked" : ""}}> Usi interioare schimbate
                                        </label>
                                    </div>
                                    <div class="col-xs-12">
                                        <label class="checkbox-inline">
                                            <input name="usa_metalica" type="checkbox" value="usa_metalica" {{ $imbunat->usa_metalica ? "checked" : ""}}> Usa metalica
                                        </label>
                                    </div>
                                    <div class="col-xs-12">
                                        &nbsp;
                                    </div>
                                    <div class="col-xs-12">
                                        <label class="checkbox-inline">
                                            <input name="fara_imbunatatiri" type="checkbox" value="fara_imbunatatiri"{{ $imbunat->fara_imbunatatiri ? "checked" : ""}}> Fara imbunatatiri
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- /.row -->

                <div class="row">
                    <div class="col-xs-12 text-center">
                        <button type="submit" class="btn btn-warning btn-lg"><i class="fa fa-pencil"></i> Editeaza anuntul</button>
                        <a href="{{ URL::to('upload-images/' . $anunt->id) }}" class="btn btn-warning btn-lg"><i class="fa fa-file-image-o"></i> Uploadeaza poze</a>
                        <button type="button" onclick="PrintElem('#printable-area')" class="btn btn-warning btn-lg"><i class="fa fa-print"></i> Printeaza anuntul</button>
                    </div>
                </div>
            </form>
        </div> <!-- end container fluid -->
        </div> <!-- end printable area -->
    </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
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
<script type="text/javascript">

    function PrintElem()
    {
        var mywindow = window.open('<?php echo URL::to('printeaza-anunt/' . $anunt->id); ?>', '<?php echo $anunt->titlu; ?>', 'height=600,width=900');

        mywindow.print();

        return true;
    }

</script>
@endsection