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
        <a href="/advert/add/apartment" class="add-advert-type">
            <span class="glyphicon glyphicon-th"></span>
            <span>Apartament</span>
        </a>
        <a href="/advert/add/house" class="add-advert-type">
            <span class="glyphicon glyphicon-home"></span>
            <span>Casa / Vila</span>
        </a>
        <a href="/advert/add/terrain" class="add-advert-type">
            <span class="glyphicon glyphicon-picture"></span>
            <span>Teren</span>
        </a>
    </div>
</div>
@endsection

@section('scripts')
@endsection