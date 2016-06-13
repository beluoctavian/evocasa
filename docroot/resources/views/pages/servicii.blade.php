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
                <h1>Servicii si costuri</h1>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12">
                    <h3>
                        Agenția noastră vă oferă servicii imobiliare complete pentru vânzarea sau cumpărarea unui imobil.</h3>
                    <h3>
                        Pachete de servicii:
                    </h3>
                </div>
            </div>
            <div class="row margin-bottom">
                <div class="col-xs-12 col-sm-6">
                    <div class="row">
                        <div class="col-xs-12"><h4>1. Pachet servicii cumpărător:</h4></div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <ul>
                                <li>Prezentarea unui portofoliu de oferte complex care sa fie pretabil cerințelor dvs</li>
                                <li>Consultanță imobiliară de specialitate în vederea pregătirii pentru tranzacționare (verificarea din punct de vedere juridic a documentației de vânzare pentru apartamentul ales de dvs.)</li>
                                <li>Posibilitatea organizării prin colaboratorii noștri a perfectării actelor de vânzare-cumpărare după caz: Promisiune de Vânzare-Cumpărare sau Contract de Vânzare-Cumpărare (costurile acestor servicii nu sunt acoperite de agenția noastră, acestea se achită direct colaboratorilor către care ați fost îndrumat)</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6">
                    <div class="row">
                        <div class="col-xs-12"><h4>2. Pachet servicii vânzător:</h4></div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <ul>
                                <li>Promovarea pe site-ul propriu a ofertei dvs. de vânzare</li>
                                <li>Promovare în mica și marea publicitate atât online cât și offline a ofertei dvs. de vânzare</li>
                                <li>Prezentarea ofertei dvs. către clienții din portofoliul agenției cu criterii de căutare asemănătoare cu caracteristicile imobilului care se vinde</li>
                                <li>Consultanță imobiliară de specialitate în vederea pregătirii pentru tranzacționare</li>
                                <li>Servicii rapide prin colaboratorii noștri pentru completarea documentației de vânzare: întocmire și eliberare Cadastru și Intabulare; întocmire și eliberare Certificat Energetic (costurile acestor servicii nu sunt acoperite de agenția noastră, acestea se discuta și se achită direct cu colaboratorii către care sunteți îndrumați)</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <span>Costul perceput de agenția noastră pentru oricare din pachetele descrise mai sus este de 2 (doi) % din prețul de tranzacționare al imobilului.</span>
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