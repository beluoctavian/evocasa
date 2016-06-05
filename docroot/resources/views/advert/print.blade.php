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
                                <input value="{{ !empty($entity['bathrooms']) ? $entity['bathrooms'] : '' }} {{ !empty($entity['obs_bathrooms']) ? $entity['obs_bathrooms'] : '' }}" id="entity[bathrooms]" name="entity[bathrooms]" type="text" class="form-control no-padding">
                            </div>
                        </div>
                        <div class="form-group col-xs-6">
                            <label for="entity[sanitary]">Gr. sanitare</label>
                            <div>
                                <input value="{{ !empty($entity['sanitary']) ? $entity['sanitary'] : '' }} {{ !empty($entity['obs_sanitary']) ? $entity['obs_sanitary'] : '' }}" id="entity[bathrooms]" name="entity[bathrooms]" type="text" class="form-control no-padding">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-xs-6">
                            <label for="entity[balconies]">Balcoane</label>
                            <div>
                                <input value="{{ !empty($entity['balconies']) ? $entity['balconies'] : '' }} {{ !empty($entity['obs_balconies']) ? $entity['obs_balconies'] : '' }}" id="entity[bathrooms]" name="entity[bathrooms]" type="text" class="form-control no-padding">
                            </div>
                        </div>
                        <div class="form-group col-xs-6">
                            <label for="entity[parking]">Loc parcare</label>
                            <div>
                                <input value="{{ !empty($entity['parking']) ? $entity['parking'] : '' }} {{ !empty($entity['obs_parking']) ? $entity['obs_parking'] : '' }}" id="entity[bathrooms]" name="entity[bathrooms]" type="text" class="form-control no-padding">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-xs-6">
                            <label for="entity[storeroom]">Boxa</label>
                            <div>
                                <input value="{{ !empty($entity['storeroom']) ? $entity['storeroom'] : '' }} {{ !empty($entity['obs_storeroom']) ? $entity['obs_storeroom'] : '' }}" id="entity[bathrooms]" name="entity[bathrooms]" type="text" class="form-control no-padding">
                            </div>
                        </div>
                        <div class="form-group col-xs-6">
                            <label for="entity[garage]">Garaj</label>
                            <div>
                                <input value="{{ !empty($entity['garage']) ? $entity['garage'] : '' }} {{ !empty($entity['obs_garage']) ? $entity['obs_garage'] : '' }}" id="entity[bathrooms]" name="entity[bathrooms]" type="text" class="form-control no-padding">
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
                                <input value="{{ !empty($entity['bathrooms']) ? $entity['bathrooms'] : '' }} {{ !empty($entity['obs_bathrooms']) ? $entity['obs_bathrooms'] : '' }}" id="entity[bathrooms]" name="entity[bathrooms]" type="text" class="form-control no-padding">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-xs-6">
                            <label for="entity[sanitary]">Gr. sanitare</label>
                            <div>
                                <input value="{{ !empty($entity['sanitary']) ? $entity['sanitary'] : '' }} {{ !empty($entity['obs_sanitary']) ? $entity['obs_sanitary'] : '' }}" id="entity[bathrooms]" name="entity[bathrooms]" type="text" class="form-control no-padding">
                            </div>
                        </div>
                        <div class="form-group col-xs-6">
                            <label for="entity[balconies]">Balcoane</label>
                            <div>
                                <input value="{{ !empty($entity['balconies']) ? $entity['balconies'] : '' }} {{ !empty($entity['obs_balconies']) ? $entity['obs_balconies'] : '' }}" id="entity[bathrooms]" name="entity[bathrooms]" type="text" class="form-control no-padding">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-xs-6">
                            <label for="entity[garage]">Garaj</label>
                            <div>
                                <input value="{{ !empty($entity['garage']) ? $entity['garage'] : '' }} {{ !empty($entity['obs_garage']) ? $entity['obs_garage'] : '' }}" id="entity[bathrooms]" name="entity[bathrooms]" type="text" class="form-control no-padding">
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


    <table>
        <tr>
            <td>
                <h2>Detalii proprietar</h2>
                <p class="row">
                    <div class="col-xs-3 no-padding">
                        <label for="owner[last_name]">Nume</label>
                    </div>
                    <div class="col-xs-9">
                        <div>
                            <input value="{{ !empty($owner['last_name']) ? $owner['last_name'] : '' }}" id="owner[last_name]" name="owner[last_name]" type="text" class="form-control">
                        </div>
                    </div>
                </p>
                <p class="row">
                    <div class="col-xs-3 no-padding">
                        <label for="owner[first_name]">Prenume</label>
                    </div>
                    <div class="col-xs-9">
                        <div>
                            <input value="{{ !empty($owner['first_name']) ? $owner['first_name'] : '' }}" id="owner[first_name]" name="owner[first_name]" type="text" class="form-control">
                        </div>
                    </div>
                </p>
                <p class="row">
                    <div class="col-xs-3 no-padding">
                        <label>Telefon</label>
                    </div>
                    <div class="col-xs-9">
                        <textarea class="form-control">{{ (!empty($owner['phone']) && count($owner['phone']) > 0) ? implode(', ', $owner['phone']) : '' }}</textarea>
                    </div>
                </p>
                <p class="row">
                    <div class="col-xs-3 no-padding">
                        <label for="owner[email]">E-mail</label>
                    </div>
                    <div class="col-xs-9">
                        <input value="{{ !empty($owner['email']) ? $owner['email'] : '' }}" id="owner[email]" name="owner[email]" type="text" class="form-control">
                    </div>
                </p>
                <p class="row">
                    <div class="col-xs-3 no-padding">
                        <label for="owner[cadaster]">Cadastru</label>
                    </div>
                    <div class="col-xs-9">
                        <input value="{{ !empty($owner['cadaster']) ? $owner['cadaster'] : '' }}" id="owner[cadaster]" name="owner[cadaster]" type="text" class="form-control">
                    </div>
                </p>
                <p class="row">
                    <div class="col-xs-3 no-padding">
                    <label for="owner[registration]">Intabulare</label>
                    </div>
                    <div class="col-xs-9">
                        <input value="{{ !empty($owner['registration']) ? $owner['registration'] : '' }}" id="owner[registration]" name="owner[registration]" type="text" class="form-control">
                    </div>
                </p>
                @if ($entity_type == 'terrain')
                    <p class="row">
                        <div class="col-xs-3 no-padding">
                            <label for="owner[urbanism_certificate]">Certificat urbanism</label>
                        </div>
                        <div class="col-xs-9">
                            <input value="{{ !empty($owner['urbanism_certificate']) ? $owner['urbanism_certificate'] : '' }}" id="owner[urbanism_certificate]" name="owner[urbanism_certificate]" type="text" class="form-control">
                        </div>
                    </p>
                @else
                    <p class="row">
                        <div class="col-xs-3 no-padding">
                            <label for="owner[energy_certificate]">Certificat energetic</label>
                        </div>
                        <div class="col-xs-9">
                            <input value="{{ !empty($owner['energy_certificate']) ? $owner['energy_certificate'] : '' }}" id=owner[energy_certificate] name="owner[energy_certificate]" type="text" class="form-control">
                        </div>
                    </p>
                @endif
                <p class="row">
                    <div class="col-xs-6">
                        <label class="checkbox-inline">
                            <input {{ !empty($owner['map_pictures']) ? 'checked' : '' }} name="owner[map_pictures]" type="checkbox" value="1"> Poze MAP
                        </label>
                    </div>
                    @if ($entity_type == 'apartment')
                        <div class="col-xs-6">
                            <label class="checkbox-inline">
                                <input {{ !empty($owner['rehabilitated_block']) ? 'checked' : '' }} name="owner[rehabilitated_block]" type="checkbox" value="1"> Bloc reabilitat
                            </label>
                        </div>
                    @endif
                </p>
                <p class="row">
                    <div class="col-xs-12 no-padding">
                        <label for="owner[address]">Adresa</label>
                        <div>
                            <textarea id="owner[address]" name="owner[address]" class="form-control" rows="2">{{ !empty($owner['address']) ? $owner['address'] : '' }}</textarea>
                        </div>
                    </div>
                </p>
                <p class="row">
                    <div class="col-xs-12 no-padding">
                        <label for="owner[observation]">Observatii</label>
                    </div>
                </p>
                @if (!empty($owner) && !empty($owner['observations']->count()))
                    @foreach ($owner['observations'] as $observation)
                        <p class="row observations-container">
                            <div class="col-xs-12 no-padding">
                                <span>{{ $observation->created_at }}</span>
                                <textarea class="form-control" rows="2">{{ $observation->text }}</textarea>
                            </div>
                        </p>
                    @endforeach
                @else
                    <p class="row observations-container">
                        <div class="col-xs-12 no-padding">
                            <textarea class="form-control" rows="2"></textarea>
                        </div>
                    </p>
                @endif
            </td>
        </tr>
        <tr>
            <td>
                @if ($entity_type == 'apartment')
                    <h2>Imbunatatiri</h2>
                @elseif ($entity_type == 'house')
                    <h2>Imbunatatiri & utilitati</h2>
                @elseif ($entity_type == 'terrain')
                    <h2>Utilitati</h2>
                @endif
                <div class="row">
                    <div class="col-xs-12">
                        <div class="row">
                            @foreach ($improvements as $i => $checked)
                                <div class="col-xs-12">
                                    <label class="checkbox-inline">
                                        <input name="improvements[{{ $i }}]" checked type="checkbox" value="1"> {{ ucwords(str_replace('_', ' ', $i)) }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </td>
        </tr>
    </table>
</div>
@endsection
