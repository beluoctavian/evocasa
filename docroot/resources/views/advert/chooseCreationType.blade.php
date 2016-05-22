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
    <div class="col-xs-12 text-center">
        <a href="/advert/add/apartment" class="btn btn-lg btn-warning add-advert-type">
            <span class="glyphicon glyphicon-th"></span>
            <span>Apartament</span>
        </a>
        <a href="/advert/add/house" class="btn btn-lg btn-primary add-advert-type">
            <span class="glyphicon glyphicon-home"></span>
            <span>Casa / Vila</span>
        </a>
        <a href="/advert/add/terrain" class="btn btn-lg btn-success add-advert-type">
            <span class="glyphicon glyphicon-picture"></span>
            <span>Teren</span>
        </a>
    </div>
</div>
@endsection

@section('scripts')
@endsection