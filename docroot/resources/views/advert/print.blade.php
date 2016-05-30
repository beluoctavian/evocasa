@extends('printit')


@section('content')
<div class="container">
    <table>
        <tr>
            <td>
                <h2>Detalii anunt</h2>
                <p class="row">
                    <div class="col-xs-3 no-padding"><b>ID anunt:</b></div>
                    <div class="col-xs-9"><input type="text" value="{{ $anunt->cod }}" class="form-control"></div>
               </p>
                <p class="row">
                    <div class="col-xs-3 no-padding"><b>Tip:</b></div>
                    <div class="col-xs-9"><input type="text" value="{{ $anunt->tip }}" class="form-control"></div>
               </p>
                <p class="row">
                    <div class="col-xs-3 no-padding"><b>Categorie:</b></div>
                    <div class="col-xs-9"><input type="text" value="{{ $anunt->categorie }}" class="form-control"></div>
               </p>
                <p class="row">
                    <div class="col-xs-3 no-padding"><b>Numar camere:</b></div>
                    <div class="col-xs-9"><input type="text" value="{{ $anunt->nr_camere }}" class="form-control"></div>
               </p>
               <p class="row">
                    <div class="col-xs-3 no-padding"><b>Oras:</b></div>
                    <div class="col-xs-9"><input type="text" value="{{ $anunt->oras }}" class="form-control"></div>
               </p>
                <p class="row">
                    <div class="col-xs-3 no-padding"><b>Cartier:</b></div>
                    <div class="col-xs-9"><input type="text" value="{{ $anunt->cartier }}" class="form-control"></div>
               </p>
                <p class="row">
                    <div class="col-xs-3 no-padding"><b>Zona:</b></div>
                    <div class="col-xs-9"><input type="text" value="{{ $anunt->zona }}" class="form-control"></div>
                </p>
                <p class="row">
                    <div class="col-xs-2 no-padding"><b>Pret actual:</b></div>
                    <div class="col-xs-4"><input type="text" value="{{ $anunt->pret }}" class="form-control"></div>
                    <div class="col-xs-2 no-padding text-right"><b>Pret vechi:</b></div>
                    <div class="col-xs-4"><input type="text" value="{{ $anunt->pret_vechi }}" class="form-control"></div>
                </p>
            </td>
        </tr>
        <tr>
            <td>
                <h2>Detalii imobil</h2>
                <p class="row">
                <div class="col-xs-2 no-padding"><b>SU:</b></div>
                <div class="col-xs-4"><input type="text" value="{{ $imobil->su }}" class="form-control"></div>
                <div class="col-xs-2 no-padding text-right"><b>SC:</b></div>
                <div class="col-xs-4"><input type="text" value="{{ $imobil->sc }}" class="form-control"></div>
                </p>
                <p class="row">
                <div class="col-xs-3 no-padding"><b>Compart:</b></div>
                <div class="col-xs-9"><input type="text" value="{{ $imobil->compartimentare }}" class="form-control"></div>
                </p>
                <p class="row">
                <div class="col-xs-2 no-padding"><b>Confort:</b></div>
                <div class="col-xs-4"><input type="text" value="{{ $imobil->confort }}" class="form-control"></div>
                <div class="col-xs-2 no-padding text-right"><b>Etaj:</b></div>
                <div class="col-xs-4"><input type="text" value="{{ $imobil->etaj }}" class="form-control"></div>
                </p>
                <p class="row">
                <div class="col-xs-3 no-padding"><b>An constructie:</b></div>
                <div class="col-xs-9"><input type="text" value="{{ $imobil->an_constructie }}" class="form-control"></div>
                </p>
                <p class="row">
                <div class="col-xs-3 no-padding"><b>Numar bai:</b></div>
                <div class="col-xs-9"><input type="text" value="{{ $imobil->numbar_bai . ' ' . $imobil->obs_numbar_bai }}" class="form-control"></div>
                </p>
                <p class="row">
                <div class="col-xs-3 no-padding"><b>Grup sanitar:</b></div>
                <div class="col-xs-9"><input type="text" value="{{ $imobil->numbar_bai_serviciu . ' ' . $imobil->obs_numbar_bai_serviciu }}" class="form-control"></div>
                </p>
                <p class="row">
                <div class="col-xs-3 no-padding"><b>Numar balcoane:</b></div>
                <div class="col-xs-9"><input type="text" value="{{ $imobil->numbar_balcoane . ' ' . $imobil->obs_numbar_balcoane }}" class="form-control"></div>
                </p>
                <p class="row">
                <div class="col-xs-3 no-padding"><b>Loc parcare:</b></div>
                <div class="col-xs-9"><input type="text" value="{{ $imobil->loc_parcare . ' ' . $imobil->obs_loc_parcare }}" class="form-control"></div>
                </p>
                <p class="row">
                <div class="col-xs-3 no-padding"><b>Boxa:</b></div>
                <div class="col-xs-9"><input type="text" value="{{ $imobil->boxa . ' ' . $imobil->obs_boxa }}" class="form-control"></div>
                </p>
                <p class="row">
                <div class="col-xs-3 no-padding"><b>Garaj:</b></div>
                <div class="col-xs-9"><input type="text" value="{{ $imobil->garaj . ' ' . $imobil->obs_garaj }}" class="form-control"></div>
                </p>
            </td>
        </tr>
    </table>
    <table>
        <tr>
            <td>
                <h2>Detalii proprietar</h2>
                <p class="row">
                <div class="col-xs-3 no-padding"><b>Nume:</b></div>
                <div class="col-xs-9"><input type="text" value="{{ $proprietar->nume }}" class="form-control"></div>
                </p>
                <p class="row">
                <div class="col-xs-3 no-padding"><b>Prenume:</b></div>
                <div class="col-xs-9"><input type="text" value="{{ $proprietar->prenume }}" class="form-control"></div>
                </p>
                <p class="row">
                <div class="col-xs-3 no-padding"><b>Telefon:</b></div>

                <div class="col-xs-9">
                    <textarea name="adresa" class="form-control col-xs-9">{{ $proprietar->telefon }}</textarea>
                </div>
                </p>
                <p class="row">
                <div class="col-xs-3 no-padding"><b>Email:</b></div>
                <div class="col-xs-9"><input type="text" value="{{ $proprietar->email }}" class="form-control"></div>
                </p>
                <p class="row">
                <div class="col-xs-3 no-padding"><b>Cadastru:</b></div>
                <div class="col-xs-9"><input type="text" value="{{ $proprietar->cadastru }}" class="form-control"></div>
                </p>
                <p class="row">
                <div class="col-xs-3 no-padding"><b>Intabulare:</b></div>
                <div class="col-xs-9"><input type="text" value="{{ $proprietar->intabulare }}" class="form-control"></div>
                </p>
                <p class="row">
                <div class="col-xs-3 no-padding"><b>Certificat energetic:</b></div>
                <div class="col-xs-9"><input type="text" value="{{ $proprietar->certificat_energetic ? $proprietar->certificat_energetic : '' }}" class="form-control"></div>
                </p>
                <p class="row">
                <div class="col-xs-6">
                    <label class="checkbox-inline ">
                        <input name="mobilier" type="checkbox" value="mobilier" {{ $proprietar->poze_map ? "checked" : ""}}> Poze MAP
                    </label>
                </div>
                <div class="col-xs-6">
                    <label class="checkbox-inline ">
                        <input name="mobilier" type="checkbox" value="mobilier" {{ $proprietar->bloc_reabilitat ? "checked" : ""}}> Bloc reabilitat
                    </label>
                </div>
                </p>
                <p class="row margin-top-small">
                <div class="col-xs-3 no-padding"><b>Adresa:</b></div>
                <textarea name="adresa" class="form-control col-xs-9">{{ $proprietar->adresa }}</textarea>
                </p>
                <p class="row">
                <div class="col-xs-3 no-padding"><b>Observatii:</b></div>
                <textarea name="adresa" class="form-control col-xs-9">{{ $proprietar->observatii }}</textarea>
                </p>
            </td>
        </tr>
        <tr>
            <td>
                <h2>Imbunatatiri</h2>
                <div class="row">
                    <div class="col-xs-6 no-padding">
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
                    </div>
                    <div class="col-xs-6 no-padding">
                        <div class="col-xs-12">
                            <label class="checkbox-inline">
                                <input name="instalatie_electrica" type="checkbox" value="instalatie_electrica" {{ $imbunat->instalatie_electrica ? "checked" : ""}}> Instalatie electrica noua
                            </label>
                        </div>
                        <div class="col-xs-12">
                            <label class="checkbox-inline">
                                <input name="centrala" type="checkbox" value="contor_gaze" {{ $imbunat->contor_gaze ? "checked" : ""}}> Contor gaze individual
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
                                <input name="usi_interioare" type="checkbox" value="usa_metalica" {{ $imbunat->usi_interioare ? "checked" : ""}}> Usi interioare
                            </label>
                        </div>
                        <div class="col-xs-12">
                            <label class="checkbox-inline">
                                <input name="usa_metalica" type="checkbox" value="usa_metalica" {{ $imbunat->usa_metalica ? "checked" : ""}}> Usa metalica
                            </label>
                        </div>
                        <div class="col-xs-12">
                            <label class="checkbox-inline">
                                <input name="fara_imbunatatiri" type="checkbox" value="fara_imbunatatiri" {{ $imbunat->fara_imbunatatiri ? "checked" : ""}}> Fara imbunatatiri
                            </label>
                        </div>
                    </div>
                </div>
            </td>
        </tr>
    </table>
</div>