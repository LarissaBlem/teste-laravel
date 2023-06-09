@extends('pessoa.layout')
<!-- CSS -->
   <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
 
   <!-- Script -->
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
   <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
 
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Product</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('products.index') }}"> Back</a>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('carro.update', $carro->id) }}" method="POST">
        @csrf
        @method('POST')
         <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Proprietário:</strong>
                    <input type="text" id='pessoa_search' class="form-control" placeholder="Name" value="{{$carro->pessoa->nome}}">
                    <input type="hidden" id='pessoaid' name="pessoa_id" value="{{$carro->pessoa_id}}">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Placa:</strong>
                <input type="text" class="form-control" name="placa" placeholder="Placa" value="{{$carro->placa}}">
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Modelo:</strong>
                <input type="text" class="form-control" name="modelo" placeholder="Modelo" value="{{$carro->modelo}}">
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Marca:</strong>
                <select name="marca" class="form-control">
                @foreach ($marcas as $id => $marca)
                    <option value="{{$id}}" @if($carro->marca == $id) selected  @endif >{{$marca}}</option>
                @endforeach
                </select>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Cor:</strong>
                <input type="text" class="form-control" name="cor" placeholder="Cor" value="{{$carro->cor}}">
            </div>
        </div>
            

            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
    <!-- Script -->
   <script type="text/javascript">
 
   // CSRF Token
   var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
   $(document).ready(function(){
 
     $( "#pessoa_search" ).autocomplete({
        source: function( request, response ) {
           // Fetch data
           $.ajax({
             url:"{{route('pessoa.getPessoas')}}",
             type: 'post',
             dataType: "json",
             data: {
                _token: CSRF_TOKEN,
                search: request.term
             },
             success: function( data ) {
                response( data );
             }
           });
        },
        select: function (event, ui) {
          // Set selection
          $('#pessoa_search').val(ui.item.label); // display the selected text
          $('#pessoaid').val(ui.item.value); // save selected id to input
          return false;
        }
     });
 
   });
   </script>
@endsection