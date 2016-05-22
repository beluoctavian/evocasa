@extends('default')

@section('in-head')
@endsection

@section('page-header')
<div class="page-header">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h1>Uploadeaza imagini</h1>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div id="printable-area">
        <div class="container-fluid">
            @if(Session::has('success'))
            <div class="row">
                <div class="col-xs-12">
                    <div class="alert alert-success">
                        <span>{{ Session::get('success') }}</span>
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                    </div>
                </div>
            </div>
            @endif
            @if(Session::has('fail'))
                <div class="row">
                    <div class="col-xs-12">
                        <div class="alert alert-danger">
                            <span>{{ Session::get('fail') }}</span>
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                        </div>
                    </div>
                </div>
            @endif
            @if (count($errors) > 0)
                @foreach ($errors->all() as $error)
                <div class="row">
                    <div class="col-xs-12">
                        <div class="alert alert-danger">
                            <span>{{ $error }}</span>
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                        </div>
                    </div>
                </div>
                @endforeach
            @endif
            <form method="POST" enctype="multipart/form-data" action="{{ URL::to('advert/images/' . $advert['id']) }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <!-- Adauga imagini -->
                <div class="row margin-bottom">
                    <div class="col-xs-12 col-sm-12">
                        <div class="main-title">
                            <i class="fa fa-file"></i>
                            <h2>Cod anunt: <a href="{{ URL::to('anunturi/' . $advert['id']) }}">{{ $advert['code'] }}</a></h2>
                        </div>
                        <div class="form-row text-center">
                            <div class="form-group col-xs-12 col-sm-2 col-sm-offset-5">
                                <label>Selectati imaginile</label>
                                <div>
                                    <input type="file" id="files" name="files[]" multiple />
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-xs-12 col-sm-6 col-sm-offset-3 text-center">
                                <label>Imagini selectate</label>
                                <div>
                                    <div id="list"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row margin-bottom">
                    <div class="col-xs-12 text-center">
                        <button type="submit" class="btn btn-warning btn-lg"><i class="fa fa-picture-o"></i> Adauga imagini</button>
                    </div>
                </div>
            </form>

            <!-- Imagini uploadate -->
            <div class="row" id="images">
                <div class="col-xs-12 col-sm-12">
                    <div class="main-title">
                        <i class="fa fa-picture-o"></i>
                        <h2>Imagini uploadate</h2>
                    </div>
                    <div class="row">
                        <form class="images-form" role="form" method="POST" action="{{ URL::to('advert/change-image-order/' . $advert['id']) }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="path" value="{{ 'uploaded-images/anunt_' . $advert['id'] . '/' }}">
                            @foreach ($files as $key => $file)
                            <div class="col-xs-12 col-sm-3">
                                <div class="thumbnail">
                                    <a class="banner-preview-container" href="{{ URL::asset('uploaded-images/anunt_' . $advert['id'] . '/' . $file->getRelativePathName()) }}">
                                        <img class="banner-preview" src="{{ URL::asset('uploaded-images/anunt_' . $advert['id'] . '/' . $file->getRelativePathName()) }}" alt=""/>
                                    </a>
                                    <div class="caption">
                                        <p>
                                            <input type="hidden" name="filename[]" value="{{ $file->getRelativePathName() }}">
                                            <select id="number{{ $key }}" name="number[]" class="form-control">
                                                @foreach ($files as $it => $f)
                                                    <option value="{{ $it +1 }}" {{ $key == $it ? 'selected' : '' }}> {{ $it + 1 }} </option>
                                                @endforeach
                                            </select>
                                            <a onclick="return confirm('Sigur doriti sa stergeti imaginea?');" href="{{ URL::to('advert/delete-image/' . $advert['id']) }}?file={{ $file->getFilename() }}" class="btn btn-danger pull-right"><i class="fa fa-trash-o"></i> Sterge imaginea</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            <div class="row margin-bottom">
                                <div class="col-xs-12 text-center">
                                    <button type="submit" class="btn btn-warning btn-lg"><i class="fa fa-random"></i> Sorteaza imaginile</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div> <!-- end container fluid -->
        </div> <!-- end printable area -->
    </div>
</div>
@endsection

@section('scripts')<script type="text/javascript">
    // Check for the various File API support.
    if (!window.File || !window.FileReader || !window.FileList || !window.Blob) {
        alert('The File APIs are not fully supported in this browser. You could encounter problems when uploading files.');
    }
</script>
<script>
    var _URL = window.URL || window.webkitURL;
    function handleFileSelect(evt) {
        $('#preview').empty();
        var files = evt.target.files; // FileList object
        // files is a FileList of File objects. List some properties.
        var output = [];
        for (var i = 0, f; f = files[i]; i++) {
            output.push('<div class="selected-file selected-file-',encodeURI(f.name),'">','<div>', encodeURI(f.name), '(', f.type || 'n/a', ')','</div></div>');
            if (!f.type.match('image.*')) {
                continue;
            }
            var reader = new FileReader();
            // Closure to capture the file information.
            reader.onload = (function(theFile) {
                return function(e) {
                    // Render thumbnail.
                    var div = document.createElement('div');
                    div.innerHTML = ['<img class="thumb thumb-file-',encodeURI(theFile.name),'" src="', e.target.result,'" title="', encodeURI(theFile.name), '"/>'].join('');
                    $('img',div).hover(
                        function(){
                            var to_hover = document.getElementsByClassName('selected-file-' + encodeURI(theFile.name));
                            $(to_hover).css("background-color","#e3e3e3");
                            $(this).css("border-color","#ff0000");
                        },
                        function(){
                            var to_hover = document.getElementsByClassName('selected-file-' + encodeURI(theFile.name));
                            $(to_hover).css("background-color","#ffffff");
                            $(this).css("border-color","#000000");
                        }
                    );
                    document.getElementById('preview').insertBefore(div, null);
                    img = new Image();
                    img.onload = function () {
                        var to_put = document.getElementsByClassName('selected-file-' + encodeURI(theFile.name));
                        $(to_put).append('<div class="thumb-dimensions">Dimensiuni: ' + this.width.toString() + 'px x ' + this.height.toString() + 'px</div>');
                    };
                    img.src = _URL.createObjectURL(theFile);
                };
            })(f);
            // Read in the image file as a data URL.
            reader.readAsDataURL(f);
        }
        document.getElementById('list').innerHTML = output.join('');
        $('.selected-file').hover(
            function(){
                var clsname = this.classList[1];
                var to_hover = document.getElementsByClassName(clsname.replace('selected','thumb'));
                $(to_hover).css("border-color","#ff0000");
                $(this).css("background-color","#e3e3e3");
            },
            function(){
                var clsname = this.classList[1];
                var to_hover = document.getElementsByClassName(clsname.replace('selected','thumb'));
                $(to_hover).css("border-color","#000000");
                $(this).css("background-color","#ffffff");
            }
        );
    }
    document.getElementById('files').addEventListener('change', handleFileSelect, false);
</script>

@endsection