@extends('default')

@section('in-head')
<!-- fotorama.css & fotorama.js. -->
<link  href="http://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.css" rel="stylesheet"> <!-- 3 KB -->
<script src="http://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.js"></script> <!-- 16 KB -->
@endsection

@section('page-header')
<div class="page-header">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h1>Despre noi</h1>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="container-fluid">
            <div class="row margin-bottom">
                <div class="col-xs-12 col-sm-6">
                    <div class="row">
                        <div class="col-xs-12"><h3>Despre noi</h3></div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12"><p>Reprezentam evolutia in domeniul imobiliar, si dorim sa ridicam standardele serviciilor imobiliare din Romania!</p></div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12"><p>Prin sintagma „Evoluam impreuna acasa” rezulta o evolutie atat in alegerea unui camin confortabil care sa se preteze cerintelor dumneavoastra, cat si serviciilor noastre care, cu fiecare client multumit sa fie foarte aproape de <b>perfectiune!</b></p></div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12"><p>Va oferim servicii de consultanta imobiliara complete prin specialistii nostrii care de cele mai multe ori pot sa faca diferenta pentru dumneavoastra in achizitionarea unei oferte imbatabile atat din punct de vedere financiar cat si din punct de vedere calitativ.</p></div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6">
                    <div class="fotorama" data-width="100%" data-autoplay="true" data-loop="true">
                        <img src="{{ URL::asset('img/mini_1.jpg') }}" alt="">
                        <img src="{{ URL::asset('img/mini_2.jpg') }}" alt="">
                        <img src="{{ URL::asset('img/mini_3.jpg') }}" alt="">
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
</script>
@endsection