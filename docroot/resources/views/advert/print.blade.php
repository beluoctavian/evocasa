@extends('printit')

@section('content')
<div class="container" id="print">
    <table>
        <tr>
            <td>
                <h2>Detalii anunt</h2>
                <p class="row">
                    <div class="col-xs-3 no-padding"><b>ID anunt:</b></div>
                    <div class="col-xs-9">
                        <input type="text" value="{{ $advert['code'] }}" class="form-control">
                    </div>
                </p>
                <p class="row">
                    <div class="col-xs-3 no-padding"><b>Titlu:</b></div>
                    <div class="col-xs-9">
                        <input type="text" value="{{ $advert['title'] }}" class="form-control">
                    </div>
                </p>
                <p class="row">
                    <div class="col-xs-3 no-padding"><b>Cartier:</b></div>
                    <div class="col-xs-9">
                        <input type="text" value="{{ !empty($advert['neighborhood']) ? $advert['neighborhood'] : '' }}" class="form-control">
                    </div>
                </p>
                <p class="row">
                    <div class="col-xs-3 no-padding"><b>Zona:</b></div>
                    <div class="col-xs-9">
                        <input type="text" value="{{ !empty($advert['area']) ? $advert['area'] : '' }}" class="form-control">
                    </div>
                </p>
                @if ($entity_type == 'apartment' || $entity_type == 'house')
                    <p class="row">
                    <div class="col-xs-3 no-padding"><b>Numar camere:</b></div>
                    <div class="col-xs-9">
                        <input type="text" value="{{ !empty($advert['no_rooms']) ? $advert['no_rooms'] : '' }}" class="form-control">
                    </div>
                    </p>
                @endif
                <p class="row">
                    <div class="col-xs-2 no-padding"><b>Pret actual:</b></div>
                    <div class="col-xs-4"><input type="text" value="{{ !empty($advert['price']) ? $advert['price'] : '' }}" class="form-control"></div>
                    <div class="col-xs-2 no-padding text-right"><b>Pret vechi:</b></div>
                    <div class="col-xs-4"><input type="text" value="{{ !empty($advert['old_price']) ? $advert['old_price'] : '' }}" class="form-control"></div>
                </p>
            </td>
        </tr>
        <tr>
            <td>
                <h2>Detalii imobil</h2>
                @if ($entity_type == 'apartment')
                    <div class="row">
                        <div class="form-group col-xs-6">
                            <label for="entity[usable_area]">Suprafata utila</label>
                            <div>
                                <input value="{{ !empty($entity['usable_area']) ? $entity['usable_area'] . ' mp' : '' }}" id="entity[usable_area]" name="entity[usable_area]" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="form-group col-xs-6">
                            <label for="entity[built_area]">Suprafata totala</label>
                            <div>
                                <input value="{{ !empty($entity['built_area']) ? $entity['built_area'] . ' mp' : '' }}" id="entity[built_area]" name="entity[built_area]" type="text" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-xs-6">
                            <label for="entity[partitioning]">Compartimentare</label>
                            <div>
                                <input value="{{ !empty($entity['partitioning']) ? $entity['partitioning'] : '' }}" id="entity[partitioning]" name="entity[partitioning]" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="form-group col-xs-6">
                            <label for="entity[comfort]">Confort</label>
                            <div>
                                <input value="{{ !empty($entity['comfort']) ? $entity['comfort'] : '' }}" id="entity[comfort]" name="entity[comfort]" type="text" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-xs-6">
                            <label for="entity[floor]">Etaj</label>
                            <div>
                                <input value="{{ !empty($entity['floor']) ? $entity['floor'] : '' }}" id=entity[floor] name="entity[floor]" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="form-group col-xs-6">
                            <label for="entity[built_year]">An constructie</label>
                            <div>
                                <input value="{{ !empty($entity['built_year']) ? $entity['built_year'] : '' }}" id="entity[built_year]" name="entity[built_year]" type="text" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-xs-6">
                            <label for="entity[bathrooms]">Bai</label>
                            <div>
                                <input value="{{ !empty($entity['bathrooms']) ? $entity['bathrooms'] : '' }} {{ !empty($entity['obs_bathrooms']) ? $entity['obs_bathrooms'] : '' }}" id="entity[bathrooms]" name="entity[bathrooms]" type="text" class="form-control no-padding text-center">
                            </div>
                        </div>
                        <div class="form-group col-xs-6">
                            <label for="entity[sanitary]">Gr. sanitare</label>
                            <div>
                                <input value="{{ !empty($entity['sanitary']) ? $entity['sanitary'] : '' }} {{ !empty($entity['obs_sanitary']) ? $entity['obs_sanitary'] : '' }}" id="entity[bathrooms]" name="entity[bathrooms]" type="text" class="form-control no-padding text-center">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-xs-6">
                            <label for="entity[balconies]">Balcoane</label>
                            <div>
                                <input value="{{ !empty($entity['balconies']) ? $entity['balconies'] : '' }} {{ !empty($entity['obs_balconies']) ? $entity['obs_balconies'] : '' }}" id="entity[bathrooms]" name="entity[bathrooms]" type="text" class="form-control no-padding text-center">
                            </div>
                        </div>
                        <div class="form-group col-xs-6">
                            <label for="entity[parking]">Loc parcare</label>
                            <div>
                                <input value="{{ !empty($entity['parking']) ? $entity['parking'] : '' }} {{ !empty($entity['obs_parking']) ? $entity['obs_parking'] : '' }}" id="entity[bathrooms]" name="entity[bathrooms]" type="text" class="form-control no-padding text-center">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-xs-6">
                            <label for="entity[storeroom]">Boxa</label>
                            <div>
                                <input value="{{ !empty($entity['storeroom']) ? $entity['storeroom'] : '' }} {{ !empty($entity['obs_storeroom']) ? $entity['obs_storeroom'] : '' }}" id="entity[bathrooms]" name="entity[bathrooms]" type="text" class="form-control no-padding text-center">
                            </div>
                        </div>
                        <div class="form-group col-xs-6">
                            <label for="entity[garage]">Garaj</label>
                            <div>
                                <input value="{{ !empty($entity['garage']) ? $entity['garage'] : '' }} {{ !empty($entity['obs_garage']) ? $entity['obs_garage'] : '' }}" id="entity[bathrooms]" name="entity[bathrooms]" type="text" class="form-control no-padding text-center">
                            </div>
                        </div>
                    </div>
                @elseif ($entity_type == 'house')
                    <div class="row">
                        <div class="form-group col-xs-6">
                            <label for="entity[land_area]">Suprafata teren</label>
                            <div>
                                <input value="{{ !empty($entity['land_area']) ? $entity['land_area'] . ' mp' : '' }}" id="entity[land_area]" name="entity[land_area]" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="form-group col-xs-6">
                            <label for="entity[street_opening]">Deschidere stradala</label>
                            <div>
                                <input value="{{ !empty($entity['street_opening']) ? $entity['street_opening'] . ' ml' : '' }}" id="entity[street_opening]" name="entity[street_opening]" type="text" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-xs-6">
                            <label for="entity[footprint]">Amprenta la sol</label>
                            <div>
                                <input value="{{ !empty($entity['footprint']) ? $entity['footprint'] . ' mp' : '' }}" id="entity[footprint]" name="entity[footprint]" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="form-group col-xs-6">
                            <label for="entity[total_area]">Suprafata desfasurata</label>
                            <div>
                                <input value="{{ !empty($entity['total_area']) ? $entity['total_area'] . ' mp' : '' }}" id="entity[total_area]" name="entity[total_area]" type="text" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-xs-6">
                            <label for="entity[level_area]">Suprafata per nivel</label>
                            <div>
                                <input value="{{ !empty($entity['level_area']) ? $entity['level_area'] . ' mp' : '' }}" id="entity[level_area]" name="entity[level_area]" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="form-group col-xs-6">
                            <label for="entity[height]">Regim inaltime</label>
                            <div>
                                <input value="{{ !empty($entity['height']) ? $entity['height'] : '' }}" id="entity[height]" name="entity[height]" type="text" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-xs-6">
                            <label for="entity[built_year]">An constructie</label>
                            <div>
                                <input value="{{ !empty($entity['built_year']) ? $entity['built_year'] : '' }}" id="entity[built_year]" name="entity[built_year]" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="form-group col-xs-6">
                            <label for="entity[bathrooms]">Bai</label>
                            <div>
                                <input value="{{ !empty($entity['bathrooms']) ? $entity['bathrooms'] : '' }} {{ !empty($entity['obs_bathrooms']) ? $entity['obs_bathrooms'] : '' }}" id="entity[bathrooms]" name="entity[bathrooms]" type="text" class="form-control no-padding text-center">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-xs-6">
                            <label for="entity[sanitary]">Gr. sanitare</label>
                            <div>
                                <input value="{{ !empty($entity['sanitary']) ? $entity['sanitary'] : '' }} {{ !empty($entity['obs_sanitary']) ? $entity['obs_sanitary'] : '' }}" id="entity[bathrooms]" name="entity[bathrooms]" type="text" class="form-control no-padding text-center">
                            </div>
                        </div>
                        <div class="form-group col-xs-6">
                            <label for="entity[balconies]">Balcoane</label>
                            <div>
                                <input value="{{ !empty($entity['balconies']) ? $entity['balconies'] : '' }} {{ !empty($entity['obs_balconies']) ? $entity['obs_balconies'] : '' }}" id="entity[bathrooms]" name="entity[bathrooms]" type="text" class="form-control no-padding text-center">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-xs-6">
                            <label for="entity[garage]">Garaj</label>
                            <div>
                                <input value="{{ !empty($entity['garage']) ? $entity['garage'] : '' }} {{ !empty($entity['obs_garage']) ? $entity['obs_garage'] : '' }}" id="entity[bathrooms]" name="entity[bathrooms]" type="text" class="form-control no-padding text-center">
                            </div>
                        </div>
                    </div>
                @elseif ($entity_type == 'terrain')
                    <div class="row">
                        <div class="form-group col-xs-12">
                            <label for="entity[total_area]">Suprafata totala</label>
                            <div>
                                <input value="{{ !empty($entity['total_area']) ? $entity['total_area'] . ' mp' : '' }}" id="entity[total_area]" name="entity[total_area]" type="text" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-xs-12">
                            <label for="entity[street_opening]">Deschidere stradala</label>
                            <div>
                                <input value="{{ !empty($entity['street_opening']) ? $entity['street_opening'] . ' ml' : '' }}" id="entity[street_opening]" name="entity[street_opening]" type="text" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-xs-12">
                            <label for="entity[depth]">Adancime</label>
                            <div>
                                <input value="{{ !empty($entity['depth']) ? $entity['depth'] . ' ml' : '' }}" id="entity[depth]" name="entity[depth]" type="text" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-xs-12">
                            <label for="entity[access_width]">Latime drum acces</label>
                            <div>
                                <input value="{{ !empty($entity['access_width']) ? $entity['access_width'] . ' ml' : '' }}" id="entity[access_width]" name="entity[access_width]" type="text" class="form-control">
                            </div>
                        </div>
                    </div>
                @endif
            </td>
        </tr>
    </table>


    {{--<table>--}}
        {{--<tr>--}}
            {{--<td>--}}
                {{--<h2>Detalii proprietar</h2>--}}
                {{--<p class="row">--}}
                {{--<div class="col-xs-3 no-padding"><b>Nume:</b></div>--}}
                {{--<div class="col-xs-9"><input type="text" value="{{ $proprietar->nume }}" class="form-control"></div>--}}
                {{--</p>--}}
                {{--<p class="row">--}}
                {{--<div class="col-xs-3 no-padding"><b>Prenume:</b></div>--}}
                {{--<div class="col-xs-9"><input type="text" value="{{ $proprietar->prenume }}" class="form-control"></div>--}}
                {{--</p>--}}
                {{--<p class="row">--}}
                {{--<div class="col-xs-3 no-padding"><b>Telefon:</b></div>--}}

                {{--<div class="col-xs-9">--}}
                    {{--<textarea name="adresa" class="form-control col-xs-9">{{ $proprietar->telefon }}</textarea>--}}
                {{--</div>--}}
                {{--</p>--}}
                {{--<p class="row">--}}
                {{--<div class="col-xs-3 no-padding"><b>Email:</b></div>--}}
                {{--<div class="col-xs-9"><input type="text" value="{{ $proprietar->email }}" class="form-control"></div>--}}
                {{--</p>--}}
                {{--<p class="row">--}}
                {{--<div class="col-xs-3 no-padding"><b>Cadastru:</b></div>--}}
                {{--<div class="col-xs-9"><input type="text" value="{{ $proprietar->cadastru }}" class="form-control"></div>--}}
                {{--</p>--}}
                {{--<p class="row">--}}
                {{--<div class="col-xs-3 no-padding"><b>Intabulare:</b></div>--}}
                {{--<div class="col-xs-9"><input type="text" value="{{ $proprietar->intabulare }}" class="form-control"></div>--}}
                {{--</p>--}}
                {{--<p class="row">--}}
                {{--<div class="col-xs-3 no-padding"><b>Certificat energetic:</b></div>--}}
                {{--<div class="col-xs-9"><input type="text" value="{{ $proprietar->certificat_energetic ? $proprietar->certificat_energetic : '' }}" class="form-control"></div>--}}
                {{--</p>--}}
                {{--<p class="row">--}}
                {{--<div class="col-xs-6">--}}
                    {{--<label class="checkbox-inline ">--}}
                        {{--<input name="mobilier" type="checkbox" value="mobilier" {{ $proprietar->poze_map ? "checked" : ""}}> Poze MAP--}}
                    {{--</label>--}}
                {{--</div>--}}
                {{--<div class="col-xs-6">--}}
                    {{--<label class="checkbox-inline ">--}}
                        {{--<input name="mobilier" type="checkbox" value="mobilier" {{ $proprietar->bloc_reabilitat ? "checked" : ""}}> Bloc reabilitat--}}
                    {{--</label>--}}
                {{--</div>--}}
                {{--</p>--}}
                {{--<p class="row margin-top-small">--}}
                {{--<div class="col-xs-3 no-padding"><b>Adresa:</b></div>--}}
                {{--<textarea name="adresa" class="form-control col-xs-9">{{ $proprietar->adresa }}</textarea>--}}
                {{--</p>--}}
                {{--<p class="row">--}}
                {{--<div class="col-xs-3 no-padding"><b>Observatii:</b></div>--}}
                {{--<textarea name="adresa" class="form-control col-xs-9">{{ $proprietar->observatii }}</textarea>--}}
                {{--</p>--}}
            {{--</td>--}}
        {{--</tr>--}}
        {{--<tr>--}}
            {{--<td>--}}
                {{--<h2>Imbunatatiri</h2>--}}
                {{--<div class="row">--}}
                    {{--<div class="col-xs-6 no-padding">--}}
                        {{--<div class="col-xs-12">--}}
                            {{--<label class="checkbox-inline">--}}
                                {{--<input name="gresie" type="checkbox" value="gresie" {{ $imbunat->gresie ? "checked" : ""}}> Gresie--}}
                            {{--</label>--}}
                        {{--</div>--}}
                        {{--<div class="col-xs-12">--}}
                            {{--<label class="checkbox-inline">--}}
                                {{--<input name="faianta" type="checkbox" value="faianta" {{ $imbunat->faianta ? "checked" : ""}}> Faianta--}}
                            {{--</label>--}}
                        {{--</div>--}}
                        {{--<div class="col-xs-12">--}}
                            {{--<label class="checkbox-inline">--}}
                                {{--<input name="parchet" type="checkbox" value="parchet" {{ $imbunat->parchet ? "checked" : ""}}> Parchet--}}
                            {{--</label>--}}
                        {{--</div>--}}
                        {{--<div class="col-xs-12">--}}
                            {{--<label class="checkbox-inline">--}}
                                {{--<input name="termopan" type="checkbox" value="termopan" {{ $imbunat->termopan ? "checked" : ""}}> Termopan--}}
                            {{--</label>--}}
                        {{--</div>--}}
                        {{--<div class="col-xs-12">--}}
                            {{--<label class="checkbox-inline">--}}
                                {{--<input name="aer" type="checkbox" value="aer" {{ $imbunat->aer ? "checked" : ""}}> Aer conditionat--}}
                            {{--</label>--}}
                        {{--</div>--}}
                        {{--<div class="col-xs-12">--}}
                            {{--<label class="checkbox-inline">--}}
                                {{--<input name="instalatie_sanitara" type="checkbox" value="instalatie_sanitara" {{ $imbunat->instalatie_sanitara ? "checked" : ""}}> Instalatie sanitara noua--}}
                            {{--</label>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="col-xs-6 no-padding">--}}
                        {{--<div class="col-xs-12">--}}
                            {{--<label class="checkbox-inline">--}}
                                {{--<input name="instalatie_electrica" type="checkbox" value="instalatie_electrica" {{ $imbunat->instalatie_electrica ? "checked" : ""}}> Instalatie electrica noua--}}
                            {{--</label>--}}
                        {{--</div>--}}
                        {{--<div class="col-xs-12">--}}
                            {{--<label class="checkbox-inline">--}}
                                {{--<input name="centrala" type="checkbox" value="contor_gaze" {{ $imbunat->contor_gaze ? "checked" : ""}}> Contor gaze individual--}}
                            {{--</label>--}}
                        {{--</div>--}}
                        {{--<div class="col-xs-12">--}}
                            {{--<label class="checkbox-inline">--}}
                                {{--<input name="centrala" type="checkbox" value="centrala" {{ $imbunat->centrala ? "checked" : ""}}> Centrala--}}
                            {{--</label>--}}
                        {{--</div>--}}
                        {{--<div class="col-xs-12">--}}
                            {{--<label class="checkbox-inline">--}}
                                {{--<input name="mobilier" type="checkbox" value="mobilier" {{ $imbunat->mobilier ? "checked" : ""}}> Mobilier inclus--}}
                            {{--</label>--}}
                        {{--</div>--}}
                        {{--<div class="col-xs-12">--}}
                            {{--<label class="checkbox-inline">--}}
                                {{--<input name="usi_interioare" type="checkbox" value="usa_metalica" {{ $imbunat->usi_interioare ? "checked" : ""}}> Usi interioare--}}
                            {{--</label>--}}
                        {{--</div>--}}
                        {{--<div class="col-xs-12">--}}
                            {{--<label class="checkbox-inline">--}}
                                {{--<input name="usa_metalica" type="checkbox" value="usa_metalica" {{ $imbunat->usa_metalica ? "checked" : ""}}> Usa metalica--}}
                            {{--</label>--}}
                        {{--</div>--}}
                        {{--<div class="col-xs-12">--}}
                            {{--<label class="checkbox-inline">--}}
                                {{--<input name="fara_imbunatatiri" type="checkbox" value="fara_imbunatatiri" {{ $imbunat->fara_imbunatatiri ? "checked" : ""}}> Fara imbunatatiri--}}
                            {{--</label>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</td>--}}
        {{--</tr>--}}
    {{--</table>--}}
</div>
@endsection
