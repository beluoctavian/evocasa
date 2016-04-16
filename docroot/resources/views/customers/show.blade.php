@extends('default')

@section('page-header')
<div class="page-header">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h1>Clienti</h1>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="row">
    <div id="main-content" class="col-xs-12 col-sm-12">
        <div class="container-fluid">
            @if(Session::has('successAdd'))
            <div class="row">
                <div class="col-xs-12">
                    <div class="alert alert-success">
                        <span>Ati adaugat cu succes clientul!</span>
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                    </div>
                </div>
            </div>
            @endif
            @if(Session::has('successDelete'))
            <div class="row">
                <div class="col-xs-12">
                    <div class="alert alert-success">
                        <span>Ati sters clientul!</span>
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                    </div>
                </div>
            </div>
            @endif
            <form method="POST" action="{{ URL::to('adauga-client') }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="row" id="adauga-client">
                    <div class="col-xs-12">
                        <div class="main-title">
                            <i class="fa fa-user"></i>
                            <h2>Adauga client</h2>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-xs-12 col-sm-2">
                                <label>Nume</label>
                                <div>
                                    <input name="nume" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="form-group col-xs-12 col-sm-2">
                                <label>Prenume</label>
                                <div>
                                    <input name="prenume" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="form-group col-xs-12 col-sm-2">
                                <label>Telefon</label>
                                <div>
                                    <input name="telefon" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="form-group col-xs-12 col-sm-2">
                                <label>E-mail</label>
                                <div>
                                    <input name="email" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="form-group col-xs-12 col-sm-2">
                                <label>Buget</label>
                                <div class="input-group">
                                    <input name="buget" type="text" class="form-control">
                                    <span class="input-group-addon">&euro;</span>
                                </div>
                            </div>
                            <div class="form-group col-xs-12 col-sm-2">
                                <label>Tip plata</label>
                                <div>
                                    <input name="tip_plata" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="form-group col-xs-12 col-sm-2">
                                <label>Nr. camere cautate</label>
                                <div>
                                    <input name="numar_camere_cautate" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="form-group col-xs-12 col-sm-2">
                                <label>Oras</label>
                                <div>
                                    <input name="oras" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="form-group col-xs-12 col-sm-2">
                                <label>Cartier</label>
                                <div>
                                    <input name="cartier" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="form-group col-xs-12 col-sm-2">
                                <label>Zona</label>
                                <div>
                                    <input name="zona" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="form-group col-xs-12 col-sm-4">
                                <label>Observatii</label>
                                <div>
                                    <textarea name="observatii" class="form-control" rows="2"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- /.row -->

                <div class="row margin-bottom">
                    <div class="col-xs-12 text-center">
                        <button type="submit" class="btn btn-warning btn-lg">Adauga client</button>
                    </div>
                </div>
            </form>

            <form method="POST" action="{{ URL::to('cauta-client') }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="row" id="adauga-client">
                    <div class="col-xs-12">
                        <div class="main-title">
                            <i class="fa fa-search"></i>
                            <h2>Cauta client</h2>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-xs-12 col-sm-2">
                                <label>Nume / Prenume</label>
                                <div>
                                    <input name="nume" type="text" class="form-control" value="{{ Input::get('nume') ? Input::get('nume') : '' }}">
                                </div>
                            </div>
                            <div class="form-group col-xs-12 col-sm-2">
                                <label>Numar telefon</label>
                                <div>
                                    <input name="telefon" type="text" class="form-control" value="{{ Input::get('telefon') ? Input::get('telefon') : '' }}">
                                </div>
                            </div>
                            <div class="form-group col-xs-12 col-sm-2">
                                <label>Numar camere</label>
                                <div>
                                    <input name="camere" type="text" class="form-control" value="{{ Input::get('camere') ? Input::get('camere') : '' }}">
                                </div>
                            </div>
                            <div class="form-group col-xs-12 col-sm-2">
                                <label>Buget minim</label>
                                <div>
                                    <input name="buget_minim" type="text" class="form-control" value="{{ Input::get('buget_minim') ? Input::get('buget_minim') : '' }}">
                                </div>
                            </div>
                            <div class="form-group col-xs-12 col-sm-2">
                                <label>Buget maxim</label>
                                <div>
                                    <input name="buget_maxim" type="text" class="form-control" value="{{ Input::get('buget_maxim') ? Input::get('buget_maxim') : '' }}">
                                </div>
                            </div>
                            <div class="form-group col-xs-12 col-sm-2">
                                <label>Cartier</label>
                                <div>
                                    <input name="cartier" type="text" class="form-control" value="{{ Input::get('cartier') ? Input::get('cartier') : '' }}">
                                </div>
                            </div>

                        </div>
                    </div>
                </div><!-- /.row -->

                <div class="row margin-bottom">
                    <div class="col-xs-12 text-center">
                        <button type="submit" class="btn btn-warning btn-lg">Cauta client</button>
                    </div>
                </div>
            </form>
            <div class="row" id="client">
                <div class="col-xs-12">
                    <div class="main-title">
                        <i class="fa fa-users"></i>
                        <h2>Clienti</h2>
                        <div class="pull-right ordoneaza hidden-xs hidden-sm">
                            <?php
                            $link_final = '';
                            foreach(Input::get() as $key => $value){
                                if($key == "sort")
                                    continue;
                                if($link_final != '')
                                    $link_final = $link_final . '&' . $key . '=' . $value;
                                else
                                    $link_final = '?' . $key . '=' . $value;
                            }
                            if($link_final != '')
                                $link_final = $link_final . '&sort=buget';
                            else
                                $link_final = '?sort=buget';
                            ?>
                            Ordoneaza dupa buget:
                            <a href="{{ URL::to('/clienti'. $link_final . '&tip_sortare=asc') }}">crescator <i class="fa fa-arrow-circle-o-up"></i></a>
                            <span>|</span>
                            <a href="{{ URL::to('/clienti'. $link_final . '&tip_sortare=desc') }}">descrescator <i class="fa fa-arrow-circle-o-down"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nume</th>
                                <th>Telefon</th>
                                <th>E-mail</th>
                                <th>Buget</th>
                                <th>Tip plata</th>
                                <th>Nr. camere</th>
                                <th>Oras</th>
                                <th>Cartier</th>
                                <th>Zona</th>
                                <th>Observatii</th>
                                <th>Optiuni</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if(count($customers))
                            @for($it = $page * 10 - 10 ; $it <= $page * 10 - 1 && $it < count($customers) ; $it++)
                                <?php $customer = $customers[$it]; ?>
                                <tr>
                                    <th class="text-center">{{ $customer->id }}</th>
                                    <td>{{ $customer->nume . ' ' . $customer->prenume }}</td>
                                    <td>{{ $customer->telefon }}</td>
                                    <td>{{ $customer->email }}</td>
                                    <td>{{ $customer->buget }} &euro;</td>
                                    <td>{{ $customer->tip_plata }}</td>
                                    <td>{{ $customer->numar_camere_cautate }}</td>
                                    <td>{{ $customer->oras }}</td>
                                    <td>{{ $customer->cartier }}</td>
                                    <td>{{ $customer->zona }}</td>
                                    <td>{{ $customer->observatii }}</td>
                                    <td class="customer-options text-center ">
                                        <a href="{{ URL::to('edit-client/' . $customer->id) }}" class="edit"><i class="fa fa-pencil"></i> Edit</a>
                                        <a href="{{ URL::to('delete-client/' . $customer->id) }}" onclick="return confirm('Sigur vrei sa stergi clientul?');" class="delete"><i class="fa fa-ban"></i> Delete</a>
                                    </td>
                                </tr>
                            @endfor
                        @endif
                        </tbody>
                    </table>
                </div>
                <div class="col-xs-12 text-center">
                    <nav>
                        <ul class="pagination">
                            @if($page == 1 || !$page)
                            <li class="disabled">
                                <a href="javascript:" aria-label="Next">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                            @else
                            <?php
                            $link_final = '';
                            foreach(Input::get() as $key => $value){
                                if($key == "page"){
                                    $value --;
                                }
                                if($link_final != '')
                                    $link_final = $link_final . '&' . $key . '=' . $value;
                                else
                                    $link_final = '?' . $key . '=' . $value;
                            }
                            ?>
                            <li>
                                <a href="{{ URL::to('clienti'. $link_final) }}" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                            @endif
                            @for($it =  1 ; $it <= floor((count($customers)-1)/10 + 1) ; $it++)
                            <li <?php echo $it == $page ? "class='active'" : ""; ?> >
                                <?php
                                $link_final = '';
                                foreach(Input::get() as $key => $value){
                                    if($link_final != '')
                                        $link_final = $link_final . '&' . $key . '=' . $value;
                                    else
                                        $link_final = '?' . $key . '=' . $value;
                                }
                                if($link_final != '')
                                    $link_final = $link_final . '&page=' . ($it);
                                else
                                    $link_final = '?page=' . ($it);
                                ?>
                                <a href="{{ URL::to('clienti'. $link_final) }}">{{ $it }}</a>
                            </li>
                            @endfor
                            @if(($page) == floor((count($customers)-1)/10 + 1))
                            <li class="disabled">
                                <a href="javascript:" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                            @else
                            <?php
                            $link_final = '';
                            $found = false;
                            foreach(Input::get() as $key => $value){
                                if($key == "page"){
                                    $value ++;
                                    $found = true;
                                }
                                if($link_final != '')
                                    $link_final = $link_final . '&' . $key . '=' . $value;
                                else
                                    $link_final = '?' . $key . '=' . $value;
                            }
                            if($found === false){
                                if($link_final != '')
                                    $link_final = $link_final . '&page=' . ($page+1);
                                else
                                    $link_final = '?page=' . ($page+1);
                            }
                            ?>
                            <li>
                                <a href="{{ URL::to('clienti'. $link_final) }}" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                            @endif
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div id="sidebar" class="col-xs-12 col-sm-3">
        <div class="container-fluid">
        </div>
    </div>
</div><!-- /.row -->
@endsection

@section('scripts')
<script type="text/javascript">
    $(function() {
    });
</script>
@endsection