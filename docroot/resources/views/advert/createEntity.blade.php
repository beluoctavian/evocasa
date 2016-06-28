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
                    @elseif ($entity_type == 'terrain')
                        Adauga un teren
                    @endif
                </h1>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
@if (count($errors) > 0)
    <div class="row">
        <div class="col-xs-12">
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endif
<div class="row">
    <div class="col-xs-12">
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
            @if (!empty($advert['id']))
                <div class="row margin-bottom" id="status-area">
                    <div class="col-xs-12">
                        <div class="main-title">
                            <i class="fa fa-bullseye"></i>
                            <h2>Status</h2>
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <div class="row">
                            <form method="POST" action="{{ URL::to('advert/add-status/' . $advert['id']) }}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="form-group col-xs-12">
                                    <select required title="Alege statusul" name="status_type" class="form-control">
                                        <option selected disabled hidden value="">Alegeti un status</option>
                                        @foreach ($status_types as $status_type)
                                            <option value="{{ $status_type->id }}">
                                                {{ $status_type->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <button type="submit" class="btn btn-warning"><i class="fa fa-check" aria-hidden="true"></i> Adauga status</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    @if (!empty($advert_status))
                        <div class="col-xs-12">
                            @foreach ($status_types as $status_type)
                                @if (!empty($advert_status[$status_type->id]))
                                    <span class="status-item" data-toggle="tooltip" data-placement="top" title="{{ $advert_status[$status_type->id]['created_at'] }}">
                                        <img src="{{ URL::asset("img/status_icons/{$status_type->title}.png") }}" />
                                        {{ $status_type->title }}
                                        @if ($advert_status[$status_type->id]['count'] > 1)
                                            <span class="badge">x{{ $advert_status[$status_type->id]['count'] }}</span>
                                        @endif
                                        <form method="POST" action="{{ URL::to('advert/delete-status/' . $advert['id']) }}" onSubmit="return confirm('Sigur vrei sa stergi statusul?');">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" name="type_id" value="{{ $status_type->id }}">
                                            <button type="submit"><i class="fa fa-times" aria-hidden="true"></i></button>
                                        </form>
                                    </span>
                                @endif
                            @endforeach
                        </div>
                    @endif
                </div>


                <form method="POST" action="{{ URL::to('advert/edit/' . $advert['id']) }}">
                    <input type="hidden" name="entity_type" value="{{ $entity_type }}">
            @else
                <form method="POST" action="{{ URL::to('advert/add/' . $entity_type) }}">
            @endif
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <!-- DETALII ANUNT -->

                <div class="row margin-bottom">
                    <div class="col-xs-12 col-sm-6">
                        <div class="main-title">
                            <i class="fa fa-file"></i>
                            <h2>
                                <span>Detalii anunt</span>
                                @if (!empty($advert['id']))
                                    <span class="name" style="{{ strlen($advert['code']) > 40 ? 'font-size: 14px;' : '' }}">: <a href="{{ URL::to('anunturi/' . $advert['id']) }}">{{ $advert['code'] }}</a></span>
                                @endif
                            </h2>
                        </div>
                        <div class="row">
                            <div class="form-group col-xs-12 col-sm-12">
                                <label for="advert[title]">Titlu anunt</label>
                                <div>
                                    <input value="{{ !empty($advert['title']) ? $advert['title'] : '' }}" id="advert[title]" name="advert[title]" type="text" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-xs-12 col-sm-4">
                                <label for="advert[neighborhood]">Cartier</label>
                                <div>
                                    <input value="{{ !empty($advert['neighborhood']) ? $advert['neighborhood'] : '' }}" id="advert[neighborhood]" name="advert[neighborhood]" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="form-group col-xs-12 col-sm-4">
                                <label for="advert[area]">Zona</label>
                                <div>
                                    <input value="{{ !empty($advert['area']) ? $advert['area'] : '' }}" id="advert[area]" name="advert[area]" type="text" class="form-control">
                                </div>
                            </div>
                            @if ($entity_type == 'apartment' || $entity_type == 'house')
                                <div class="form-group col-xs-12 col-sm-4">
                                    <label for="advert[no_rooms]">Numar camere</label>
                                    <div>
                                        <select id="advert[no_rooms]" name="advert[no_rooms]" class="form-control">
                                            @for ($i = 1; $i <= 4; $i++)
                                                <option {{ !empty($advert['no_rooms']) && $advert['no_rooms'] == $i ? 'selected' : '' }} value="{{ $i }}">
                                                    {{ $i }}{{ $i == 4 ? '+' : '' }}
                                                </option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="row">
                            <div class="form-group col-xs-12 col-sm-4">
                                <label for="advert[price]">Pret actual</label>
                                <div id="price_icon_container" class="input-group">
                                    <input value="{{ !empty($advert['price']) ? $advert['price'] : '' }}" id="advert[price]" name="advert[price]" type="text" class="form-control">
                                    <span id="price_icon" class="input-group-addon" data-toggle="tooltip" data-placement="right" data-html="true" title='
                                    @if (!empty($advert['price_history']))
                                            <table class="price-history-table table table-bordered table-condensed">
                                                <thead>
                                                <tr>
                                                    <td>Data</td>
                                                    <td>Pret</td>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach ($advert['price_history'] as $price)
                                                    @if (!empty($price['date']) && !empty($price['price']))
                                                        <tr>
                                                            <td>{{ $price['date'] }}</td>
                                                            <td>{{ $price['price'] }} &euro;</td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            </tbody>
                                        </table>
                                    @endif
                                            '>&euro;</span>
                                </div>
                            </div>
                            <div class="form-group col-xs-12 col-sm-4">
                                <label for="advert[old_price]">Pret vechi</label>
                                <div class="input-group">
                                    <input value="{{ !empty($advert['old_price']) ? $advert['old_price'] : '' }}" id="advert[old_price]" name="advert[old_price]" type="text" class="form-control">
                                    <span class="input-group-addon">&euro;</span>
                                </div>
                            </div>
                            <div class="form-group col-xs-12">
                                <label for="advert[description]">Descriere</label>
                                <div>
                                    <textarea id="advert[description]" name="advert[description]" class="form-control" rows="4">{{ !empty($advert['description']) ? $advert['description'] : '' }}</textarea>
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
                        <div class="row">
                            <div class="form-group col-xs-12 col-sm-4">
                                <label for="owner[last_name]">Nume</label>
                                <div>
                                    <input value="{{ !empty($owner['last_name']) ? $owner['last_name'] : '' }}" id="owner[last_name]" name="owner[last_name]" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="form-group col-xs-12 col-sm-4">
                                <label for="owner[first_name]">Prenume</label>
                                <div>
                                    <input value="{{ !empty($owner['first_name']) ? $owner['first_name'] : '' }}" id="owner[first_name]" name="owner[first_name]" type="text" class="form-control">
                                </div>
                            </div>
                            <div id="telefons">
                                @if (!empty($owner['phone']) && count($owner['phone']) > 0)
                                    @foreach($owner['phone'] as $it => $tel)
                                        <div class="form-group col-xs-12 col-sm-4 telefon-container">
                                            @if ($it == 0)
                                                <label for="owner[phone]">Telefon <a class="adauga-telefon" href="javascript:"><i class="fa fa-plus-square"></i></a></label>
                                            @else
                                                <label>Telefon {{ $it }}</label>
                                            @endif
                                            <div>
                                                <input name="owner[phone][]" type="text" class="form-control" value="{{ $tel }}">
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="form-group col-xs-12 col-sm-4 telefon-container">
                                        <label for="owner[phone]">Telefon <a class="adauga-telefon" href="javascript:"><i class="fa fa-plus-square"></i></a></label>
                                        <div>
                                            <input id="owner[phone]" name="owner[phone][]" type="text" class="form-control">
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="form-group col-xs-12 col-sm-8">
                                <label for="owner[email]">E-mail</label>
                                <div>
                                    <input value="{{ !empty($owner['email']) ? $owner['email'] : '' }}" id="owner[email]" name="owner[email]" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="form-group col-xs-12 col-sm-4">
                                <label for="owner[cadaster]">Cadastru</label>
                                <div>
                                    <input value="{{ !empty($owner['cadaster']) ? $owner['cadaster'] : '' }}" id="owner[cadaster]" name="owner[cadaster]" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="form-group col-xs-12 col-sm-4">
                                <label for="owner[registration]">Intabulare</label>
                                <div>
                                    <input value="{{ !empty($owner['registration']) ? $owner['registration'] : '' }}" id="owner[registration]" name="owner[registration]" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="form-group col-xs-12 col-sm-4">
                                @if ($entity_type == 'terrain')
                                    <div>
                                        <label for="owner[urbanism_certificate]">Certificat urbanism</label>
                                        <div>
                                            <input value="{{ !empty($owner['urbanism_certificate']) ? $owner['urbanism_certificate'] : '' }}" id="owner[urbanism_certificate]" name="owner[urbanism_certificate]" type="text" class="form-control">
                                        </div>
                                    </div>
                                @else
                                    <div>
                                        <label for="owner[energy_certificate]">Certificat energetic</label>
                                        <div>
                                            <input value="{{ !empty($owner['energy_certificate']) ? $owner['energy_certificate'] : '' }}" id=owner[energy_certificate] name="owner[energy_certificate]" type="text" class="form-control">
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="form-group col-xs-12 col-sm-4 margin-top-small">
                                <div>
                                    <label class="checkbox-inline">
                                        <input {{ !empty($owner['map_pictures']) ? 'checked' : '' }} name="owner[map_pictures]" type="checkbox" value="1"> Poze MAP
                                    </label>
                                </div>
                                @if ($entity_type == 'apartment')
                                    <div>
                                        <label class="checkbox-inline">
                                            <input {{ !empty($owner['rehabilitated_block']) ? 'checked' : '' }} name="owner[rehabilitated_block]" type="checkbox" value="1"> Bloc reabilitat
                                        </label>
                                    </div>
                                @endif
                            </div>
                            <div class="form-group col-xs-12 col-sm-12">
                                <label for="owner[address]">Adresa</label>
                                <div>
                                    <textarea id="owner[address]" name="owner[address]" class="form-control" rows="2">{{ !empty($owner['address']) ? $owner['address'] : '' }}</textarea>
                                </div>
                            </div>
                            <div class="form-group col-xs-12 col-sm-12">
                                <label for="owner[observation]">Observatii</label>
                                <div>
                                    <textarea id="owner[observation]" name="owner[observation]" class="form-control" rows="2"></textarea>
                                </div>
                                @if (!empty($owner))
                                    @foreach ($owner['observations'] as $observation)
                                        <div class="row observations-container">
                                            <div class="col-xs-12">
                                                <span>{{ $observation->created_at }} <a href="{{ URL::to('advert/delete-observation/' . $observation->id) }}"><i class="red fa fa-times" aria-hidden="true"></i></a></span>
                                                <textarea disabled class="form-control" rows="2">{{ $observation->text }}</textarea>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
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
                            <div class="row">
                                <div class="form-group col-xs-12 col-sm-4">
                                    <label for="entity[usable_area]">Suprafata utila</label>
                                    <div class="input-group">
                                        <input value="{{ !empty($entity['usable_area']) ? $entity['usable_area'] : '' }}" id="entity[usable_area]" name="entity[usable_area]" type="text" class="form-control">
                                        <span class="input-group-addon">mp</span>
                                    </div>
                                </div>
                                <div class="form-group col-xs-12 col-sm-4">
                                    <label for="entity[built_area]">Suprafata totala</label>
                                    <div class="input-group">
                                        <input value="{{ !empty($entity['built_area']) ? $entity['built_area'] : '' }}" id="entity[built_area]" name="entity[built_area]" type="text" class="form-control">
                                        <span class="input-group-addon">mp</span>
                                    </div>
                                </div>
                                <div class="form-group col-xs-12 col-sm-4">
                                    <label for="entity[partitioning]">Compartimentare</label>
                                    <div>
                                        <input value="{{ !empty($entity['partitioning']) ? $entity['partitioning'] : '' }}" id="entity[partitioning]" name="entity[partitioning]" type="text" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-xs-12 col-sm-4">
                                    <label for="entity[comfort]">Confort</label>
                                    <div>
                                        <input value="{{ !empty($entity['comfort']) ? $entity['comfort'] : '' }}" id="entity[comfort]" name="entity[comfort]" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group col-xs-12 col-sm-4">
                                    <label for="entity[floor]">Etaj</label>
                                    <div>
                                        <input value="{{ !empty($entity['floor']) ? $entity['floor'] : '' }}" id=entity[floor] name="entity[floor]" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group col-xs-12 col-sm-4">
                                    <label for="entity[built_year]">An constructie</label>
                                    <div>
                                        <input value="{{ !empty($entity['built_year']) ? $entity['built_year'] : '' }}" id="entity[built_year]" name="entity[built_year]" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group col-xs-12 col-sm-4">
                                    <label for="entity[bathrooms]">Numar bai</label>
                                    <div class="row">
                                        <div class="col-xs-4"><input value="{{ !empty($entity['bathrooms']) ? $entity['bathrooms'] : '' }}" id="entity[bathrooms]" name="entity[bathrooms]" type="text" class="form-control no-padding text-center"></div>
                                        <div class="col-xs-8 no-padding-left"><input value="{{ !empty($entity['obs_bathrooms']) ? $entity['obs_bathrooms'] : '' }}" title="bathrooms observations" name="entity[obs_bathrooms]" type="text" class="form-control"></div>
                                    </div>
                                </div>
                                <div class="form-group col-xs-12 col-sm-4">
                                    <label for="entity[sanitary]">Nr. gr. sanitare</label>
                                    <div class="row">
                                        <div class="col-xs-4"><input value="{{ !empty($entity['sanitary']) ? $entity['sanitary'] : '' }}" id="entity[sanitary]" name="entity[sanitary]" type="text" class="form-control no-padding text-center"></div>
                                        <div class="col-xs-8 no-padding-left"><input value="{{ !empty($entity['obs_sanitary']) ? $entity['obs_sanitary'] : '' }}" title="sanitary" name="entity[obs_sanitary]" type="text" class="form-control"></div>
                                    </div>
                                </div>
                                <div class="form-group col-xs-12 col-sm-4">
                                    <label for="entity[balconies]">Numar balcoane</label>
                                    <div class="row">
                                        <div class="col-xs-4"><input value="{{ !empty($entity['balconies']) ? $entity['balconies'] : '' }}" id="entity[balconies]" name="entity[balconies]" type="text" class="form-control no-padding text-center"></div>
                                        <div class="col-xs-8 no-padding-left"><input value="{{ !empty($entity['obs_balconies']) ? $entity['obs_balconies'] : '' }}" title="balconies observations" name="entity[obs_balconies]" type="text" class="form-control"></div>
                                    </div>
                                </div>
                                <div class="form-group col-xs-12 col-sm-4">
                                    <label for="entity[parking]">Loc parcare</label>
                                    <div>
                                        <div class="row">
                                            <div class="col-xs-4"><input value="{{ !empty($entity['parking']) ? $entity['parking'] : '' }}" id="entity[parking]" name="entity[parking]" type="text" class="form-control no-padding text-center"></div>
                                            <div class="col-xs-8 no-padding-left"><input value="{{ !empty($entity['obs_parking']) ? $entity['obs_parking'] : '' }}" title="parking observations" name="entity[obs_parking]" type="text" class="form-control"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-xs-12 col-sm-4">
                                    <label for="entity[storeroom]">Boxa</label>
                                    <div>
                                        <div class="row">
                                            <div class="col-xs-4"><input value="{{ !empty($entity['storeroom']) ? $entity['storeroom'] : '' }}" id="entity[storeroom]" name="entity[storeroom]" type="text" class="form-control no-padding text-center"></div>
                                            <div class="col-xs-8 no-padding-left"><input value="{{ !empty($entity['obs_storeroom']) ? $entity['obs_storeroom'] : '' }}" title="storeroom observations" name="entity[obs_storeroom]" type="text" class="form-control"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-xs-12 col-sm-4">
                                    <label for="entity[garage]">Garaj</label>
                                    <div>
                                        <div class="row">
                                            <div class="col-xs-4"><input value="{{ !empty($entity['garage']) ? $entity['garage'] : '' }}" id="entity[garage]" name="entity[garage]" type="text" class="form-control no-padding text-center"></div>
                                            <div class="col-xs-8 no-padding-left"><input value="{{ !empty($entity['obs_garage']) ? $entity['obs_garage'] : '' }}" title="garage observations" name="entity[obs_garage]" type="text" class="form-control"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @elseif ($entity_type == 'house')
                            <div class="row">
                                <div class="form-group col-xs-12 col-sm-4">
                                    <label for="entity[land_area]">Suprafata teren</label>
                                    <div class="input-group">
                                        <input value="{{ !empty($entity['land_area']) ? $entity['land_area'] : '' }}" id="entity[land_area]" name="entity[land_area]" type="text" class="form-control">
                                        <span class="input-group-addon">mp</span>
                                    </div>
                                </div>
                                <div class="form-group col-xs-12 col-sm-4">
                                    <label for="entity[street_opening]">Deschidere stradala</label>
                                    <div class="input-group">
                                        <input value="{{ !empty($entity['street_opening']) ? $entity['street_opening'] : '' }}" id="entity[street_opening]" name="entity[street_opening]" type="text" class="form-control">
                                        <span class="input-group-addon">ml</span>
                                    </div>
                                </div>
                                <div class="form-group col-xs-12 col-sm-4">
                                    <label for="entity[footprint]">Amprenta la sol</label>
                                    <div class="input-group">
                                        <input value="{{ !empty($entity['footprint']) ? $entity['footprint'] : '' }}" id="entity[footprint]" name="entity[footprint]" type="text" class="form-control">
                                        <span class="input-group-addon">mp</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-xs-12 col-sm-4">
                                    <label for="entity[total_area]">Suprafata desfasurata</label>
                                    <div class="input-group">
                                        <input value="{{ !empty($entity['total_area']) ? $entity['total_area'] : '' }}" id="entity[total_area]" name="entity[total_area]" type="text" class="form-control">
                                        <span class="input-group-addon">mp</span>
                                    </div>
                                </div>
                                <div class="form-group col-xs-12 col-sm-4">
                                    <label for="entity[level_area]">Suprafata per nivel</label>
                                    <div class="input-group">
                                        <input value="{{ !empty($entity['level_area']) ? $entity['level_area'] : '' }}" id="entity[level_area]" name="entity[level_area]" type="text" class="form-control">
                                        <span class="input-group-addon">mp</span>
                                    </div>
                                </div>
                                <div class="form-group col-xs-12 col-sm-4">
                                    <label for="entity[height]">Regim inaltime</label>
                                    <div>
                                        <input value="{{ !empty($entity['height']) ? $entity['height'] : '' }}" id="entity[height]" name="entity[height]" type="text" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-xs-12 col-sm-4">
                                    <label for="entity[built_year]">An constructie</label>
                                    <div>
                                        <input value="{{ !empty($entity['built_year']) ? $entity['built_year'] : '' }}" id="entity[built_year]" name="entity[built_year]" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group col-xs-12 col-sm-4">
                                    <label for="entity[bathrooms]">Numar bai</label>
                                    <div class="row">
                                        <div class="col-xs-4"><input value="{{ !empty($entity['bathrooms']) ? $entity['bathrooms'] : '' }}" id="entity[bathrooms]" name="entity[bathrooms]" type="text" class="form-control no-padding text-center"></div>
                                        <div class="col-xs-8 no-padding-left"><input value="{{ !empty($entity['obs_bathrooms']) ? $entity['obs_bathrooms'] : '' }}" title="bathrooms observations" name="entity[obs_bathrooms]" type="text" class="form-control"></div>
                                    </div>
                                </div>
                                <div class="form-group col-xs-12 col-sm-4">
                                    <label for="entity[sanitary]">Nr. gr. sanitare</label>
                                    <div class="row">
                                        <div class="col-xs-4"><input value="{{ !empty($entity['sanitary']) ? $entity['sanitary'] : '' }}" id="entity[sanitary]" name="entity[sanitary]" type="text" class="form-control no-padding text-center"></div>
                                        <div class="col-xs-8 no-padding-left"><input value="{{ !empty($entity['obs_sanitary']) ? $entity['obs_sanitary'] : '' }}" title="sanitary" name="entity[obs_sanitary]" type="text" class="form-control"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-xs-12 col-sm-4">
                                    <label for="entity[balconies]">Numar balcoane</label>
                                    <div class="row">
                                        <div class="col-xs-4"><input value="{{ !empty($entity['balconies']) ? $entity['balconies'] : '' }}" id="entity[balconies]" name="entity[balconies]" type="text" class="form-control no-padding text-center"></div>
                                        <div class="col-xs-8 no-padding-left"><input value="{{ !empty($entity['obs_balconies']) ? $entity['obs_balconies'] : '' }}" title="balconies observations" name="entity[obs_balconies]" type="text" class="form-control"></div>
                                    </div>
                                </div>
                                <div class="form-group col-xs-12 col-sm-4">
                                    <label for="entity[garage]">Garaj</label>
                                    <div>
                                        <div class="row">
                                            <div class="col-xs-4"><input value="{{ !empty($entity['garage']) ? $entity['garage'] : '' }}" id="entity[garage]" name="entity[garage]" type="text" class="form-control no-padding text-center"></div>
                                            <div class="col-xs-8 no-padding-left"><input value="{{ !empty($entity['obs_garage']) ? $entity['obs_garage'] : '' }}" title="garage observations" name="entity[obs_garage]" type="text" class="form-control"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @elseif ($entity_type == 'terrain')
                            <div class="row">
                                <div class="form-group col-xs-12 col-sm-4">
                                    <label for="entity[total_area]">Suprafata totala</label>
                                    <div class="input-group">
                                        <input value="{{ !empty($entity['total_area']) ? $entity['total_area'] : '' }}" id="entity[total_area]" name="entity[total_area]" type="text" class="form-control">
                                        <span class="input-group-addon">mp</span>
                                    </div>
                                </div>
                                <div class="form-group col-xs-12 col-sm-4">
                                    <label for="entity[street_opening]">Deschidere stradala</label>
                                    <div class="input-group">
                                        <input value="{{ !empty($entity['street_opening']) ? $entity['street_opening'] : '' }}" id="entity[street_opening]" name="entity[street_opening]" type="text" class="form-control">
                                        <span class="input-group-addon">ml</span>
                                    </div>
                                </div>
                                <div class="form-group col-xs-12 col-sm-4">
                                    <label for="entity[depth]">Adancime</label>
                                    <div class="input-group">
                                        <input value="{{ !empty($entity['depth']) ? $entity['depth'] : '' }}" id="entity[depth]" name="entity[depth]" type="text" class="form-control">
                                        <span class="input-group-addon">ml</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-xs-12 col-sm-4">
                                    <label for="entity[access_width]">Latime drum acces</label>
                                    <div class="input-group">
                                        <input value="{{ !empty($entity['access_width']) ? $entity['access_width'] : '' }}" id="entity[access_width]" name="entity[access_width]" type="text" class="form-control">
                                        <span class="input-group-addon">ml</span>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- END IMOBIL -->

                    <!-- IMBUNATATIRI -->
                    <div class="col-xs-12 col-sm-6">
                        @if ($entity_type == 'apartment')
                            <div class="main-title">
                                <i class="fa fa-star"></i>
                                <h2>Imbunatatiri</h2>
                            </div>
                        @elseif ($entity_type == 'house')
                            <div class="main-title">
                                <i class="fa fa-star"></i>
                                <h2>Imbunatatiri & utilitati</h2>
                            </div>
                        @elseif ($entity_type == 'terrain')
                            <div class="main-title">
                                <i class="fa fa-star"></i>
                                <h2>Utilitati</h2>
                            </div>
                        @endif
                        @if ($entity_type == 'apartment' || $entity_type == 'house')
                            <div class="row">
                                <div class="col-xs-6">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <label class="checkbox-inline">
                                                <input name="improvements[gresie]" {{ !empty($improvements['gresie']) ? 'checked' : '' }} type="checkbox" value="1"> Gresie
                                            </label>
                                        </div>
                                        <div class="col-xs-12">
                                            <label class="checkbox-inline">
                                                <input name="improvements[faianta]" {{ !empty($improvements['faianta']) ? 'checked' : '' }} type="checkbox" value="1"> Faianta
                                            </label>
                                        </div>
                                        <div class="col-xs-12">
                                            <label class="checkbox-inline">
                                                <input name="improvements[parchet]" {{ !empty($improvements['parchet']) ? 'checked' : '' }} type="checkbox" value="1"> Parchet
                                            </label>
                                        </div>
                                        <div class="col-xs-12">
                                            <label class="checkbox-inline">
                                                <input name="improvements[termopan]" {{ !empty($improvements['termopan']) ? 'checked' : '' }} type="checkbox" value="1"> Termopan
                                            </label>
                                        </div>
                                        <div class="col-xs-12">
                                            <label class="checkbox-inline">
                                                <input name="improvements[aer]" {{ !empty($improvements['aer']) ? 'checked' : '' }} type="checkbox" value="1"> Aer conditionat
                                            </label>
                                        </div>
                                        <div class="col-xs-12">
                                            <label class="checkbox-inline">
                                                <input name="improvements[instalatie_sanitara]" {{ !empty($improvements['instalatie_sanitara']) ? 'checked' : '' }} type="checkbox" value="1"> Instalatie sanitara noua
                                            </label>
                                        </div>
                                        <div class="col-xs-12">
                                            <label class="checkbox-inline">
                                                <input name="improvements[instalatie_electrica]" {{ !empty($improvements['instalatie_electrica']) ? 'checked' : '' }} type="checkbox" value="1"> Instalatie electrica noua
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="row">
                                        @if ($entity_type == 'apartment')
                                            <div class="col-xs-12">
                                                <label class="checkbox-inline">
                                                    <input name="improvements[contor_gaze]" {{ !empty($improvements['contor_gaze']) ? 'checked' : '' }} type="checkbox" value="1"> Contor gaze individual
                                                </label>
                                            </div>
                                        @endif
                                        <div class="col-xs-12">
                                            <label class="checkbox-inline">
                                                <input name="improvements[centrala]" {{ !empty($improvements['centrala']) ? 'checked' : '' }} type="checkbox" value="1"> Centrala termica individuala
                                            </label>
                                        </div>
                                        <div class="col-xs-12">
                                            <label class="checkbox-inline">
                                                <input name="improvements[mobilier]" {{ !empty($improvements['mobilier']) ? 'checked' : '' }} type="checkbox" value="1"> Mobilier inclus
                                            </label>
                                        </div>
                                        <div class="col-xs-12">
                                            <label class="checkbox-inline">
                                                <input name="improvements[usi_interioare]" {{ !empty($improvements['usi_interioare']) ? 'checked' : '' }} type="checkbox" value="1"> Usi interioare schimbate
                                            </label>
                                        </div>
                                        <div class="col-xs-12">
                                            <label class="checkbox-inline">
                                                <input name="improvements[usa_metalica]" {{ !empty($improvements['usa_metalica']) ? 'checked' : '' }} type="checkbox" value="1"> Usa metalica
                                            </label>
                                        </div>
                                        <div class="col-xs-12">
                                            &nbsp;
                                        </div>
                                        <div class="col-xs-12">
                                            <label class="checkbox-inline">
                                                <input name="improvements[fara_imbunatatiri]" {{ !empty($improvements['fara_imbunatatiri']) ? 'checked' : '' }} type="checkbox" value="1"> Fara imbunatatiri
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @if ($entity_type == 'house')
                            <div class="row" style="margin-top: 20px;">
                                <div class="col-xs-6">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <label class="checkbox-inline">
                                                <input name="improvements[canalizare]" {{ !empty($improvements['canalizare']) ? 'checked' : '' }} type="checkbox" value="1"> Canalizare
                                            </label>
                                        </div>
                                        <div class="col-xs-12">
                                            <label class="checkbox-inline">
                                                <input name="improvements[apa_curenta]" {{ !empty($improvements['apa_curenta']) ? 'checked' : '' }} type="checkbox" value="1"> Apa curenta
                                            </label>
                                        </div>
                                        <div class="col-xs-12">
                                            <label class="checkbox-inline">
                                                <input name="improvements[gaze]" {{ !empty($improvements['gaze']) ? 'checked' : '' }} type="checkbox" value="1"> Gaze
                                            </label>
                                        </div>
                                        <div class="col-xs-12">
                                            <label class="checkbox-inline">
                                                <input name="improvements[electricitate]" {{ !empty($improvements['electricitate']) ? 'checked' : '' }} type="checkbox" value="1"> Electricitate
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @elseif ($entity_type == 'terrain')
                            <div class="row">
                                <div class="col-xs-6">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <label class="checkbox-inline">
                                                <input name="improvements[canalizare]" {{ !empty($improvements['canalizare']) ? 'checked' : '' }} type="checkbox" value="1"> Canalizare
                                            </label>
                                        </div>
                                        <div class="col-xs-12">
                                            <label class="checkbox-inline">
                                                <input name="improvements[apa_curenta]" {{ !empty($improvements['apa_curenta']) ? 'checked' : '' }} type="checkbox" value="1"> Apa curenta
                                            </label>
                                        </div>
                                        <div class="col-xs-12">
                                            <label class="checkbox-inline">
                                                <input name="improvements[gaze]" {{ !empty($improvements['gaze']) ? 'checked' : '' }} type="checkbox" value="1"> Gaze
                                            </label>
                                        </div>
                                        <div class="col-xs-12">
                                            <label class="checkbox-inline">
                                                <input name="improvements[electricitate]" {{ !empty($improvements['electricitate']) ? 'checked' : '' }} type="checkbox" value="1"> Electricitate
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div><!-- end imbunatatiri -->

                </div><!-- /.row -->

                <div class="row">
                    <div class="col-xs-12 text-center">
                        @if (!empty($advert['id']))
                            <button type="submit" class="btn btn-warning btn-lg">Editeaza anuntul</button>
                            <a href="{{ URL::to("advert/images/{$advert['id']}") }}" class="btn btn-warning btn-lg"><i class="fa fa-file-image-o"></i> Uploadeaza poze</a>
                            <button type="button" onclick="PrintElem('#printable-area')" class="btn btn-warning btn-lg"><i class="fa fa-print"></i> Printeaza anuntul</button>
                        @else
                            <button type="submit" class="btn btn-warning btn-lg">Adauga anuntul</button>
                        @endif
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function PrintElem()
    {
        @if (!empty($advert['id']))
            var mywindow = window.open('{{ URL::to("advert/print/{$advert['id']}") }}', '{{ $advert['title'] }} ', 'height=600,width=900');
            mywindow.print();
        @endif

        return true;
    }
    var tels = 2;
    $(document).ready(function(){
       $('.adauga-telefon').on('click', function(e){
           var el = $(".telefon-container:eq(0)").clone();
           $('input',el).val("");
           $('label',el).text($('label',el).text() + ' ' + tels);
           tels = tels + 1;
           $("#telefons").append(el.clone());
       });
    });
    $('textarea').elastic();
    $(".status-item").tooltip({ trigger: "hover" });
    $("#price_icon").tooltip({ trigger: "hover" });
</script>

@endsection