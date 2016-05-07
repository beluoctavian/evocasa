@extends('default')

@section('page-header')
<div class="page-header">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h1>Contact</h1>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-xs-12">
        @if(Session::has('success'))
            <div class="alert alert-success">
                <span>Mesajul a fost trimis! Va vom raspunde in cel mai scurt timp.</span>
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
        @endif
        @if (count($errors) > 0)
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger">
                    <span>{{ $error }}</span>
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                </div>
            @endforeach
        @endif
    </div>
</div>

<div class="row">
    <div class="col-xs-12 col-sm-6">
        <h4>Trimiteti-ne un mesaj</h4>
        <form method="POST" action="{{ URL::to('contact') }}" accept-charset="UTF-8" class="contactform">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="row no-padding">
                <div class="form-group col-xs-6">
                    <input required="required" class="form-control" placeholder="Nume*" name="name" type="text">
                </div>
                <div class="form-group col-xs-6">
                    <input required="required" class="form-control" placeholder="Subiect*" name="subject" type="text">
                </div>
            </div>

            <div class="form-group">
                <input required="required" class="form-control" placeholder="E-mail*" name="email" type="text">
            </div>

            <div class="form-group">
                <input required="required" class="form-control" placeholder="Telefon" name="phone" type="text">
            </div>

            <div class="form-group">
                <textarea required="required" class="form-control" placeholder="Scrieti aici mesajul dvs..." name="message" cols="50" rows="10"></textarea>
            </div>

            <div class="form-group">
                <input class="btn btn-warning" type="submit" value="Trimiteti mesajul">
            </div>
        </form>
    </div>

    <div class="col-xs-12 col-sm-6">
        <h4>Date de contact</h4>
        <p>
            <ul class="default">
                <li><i class="fa fa-map-marker"></i> Sediu social: Str. Motilor, nr. 20, sectorul 3, Bucuresti</li>
                <li><i class="fa fa-envelope-o"></i> E-mail: office@evocasainvest.ro</li>
                <li><i class="fa fa-barcode"></i> CUI: 34565174</li>
                <li><i class="fa fa-clipboard"></i> Nr. reg. comert: J40 / 6367 / 2015</li>
                <li><i class="fa fa-phone"></i> 0773 937 217 | 0773 937 205</li>
            </ul>
        </p>
    </div>

</div>
@endsection

@section('scripts')
<script>
</script>
@endsection