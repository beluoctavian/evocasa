@extends('default')

@section('in-head')
@endsection

@section('page-header')
<div class="page-header">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h1>Alegeti tipul anuntului</h1>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-xs-12">
        <a class="add-advert-type" href="{!! route('advert.add.apartment') !!}">
            <span class="glyphicon glyphicon-th"></span>
            <span>Apartament</span>
        </a>
        <a class="add-advert-type" href="{!! route('advert.add.house') !!}">
            <span class="glyphicon glyphicon-home"></span>
            <span>Casa / Vila</span>
        </a>
        <a class="add-advert-type" href="{!! route('advert.add.terrain') !!}">
            <span class="glyphicon glyphicon-picture"></span>
            <span>Teren</span>
        </a>
    </div>
</div>
@endsection

@section('scripts')
@endsection