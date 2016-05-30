@extends('printit')

@section('content')
<div class="container">
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
    </table>
</div>
@endsection
