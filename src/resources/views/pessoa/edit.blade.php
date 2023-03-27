@extends('pessoa.layout')
<!-- CSS -->
   <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
 
   <!-- Script -->
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
   <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
 
@section('content')
 <div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Editar Cliente</h2>
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

     <form class="mb-3" action="{{ route('pessoa.update', $pessoa->id) }}" method="POST">
                @csrf
                @method('POST')
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Nome Completo:</strong>
                            <input type="text" name="nome" id="pessoa_id"class="form-control" placeholder="Nome Completo" value="{{$pessoa->nome}}"aria-label="default input example">
                        </div>
                    </div>

                    <div  class="mb-3">
                        <div class="">
                            <strong>Gênero:</strong>
                            <select name="genero" class="form-select" aria-label="Default select example">
                                <option value="F" @if ($pessoa->genero == 'F') selected @endif>Feminino</option>
                                <option value="M"@if ($pessoa->genero == 'M') selected @endif>Masculino</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Data de Nascimento:</strong>
                            <input type="date" name="dt_nasc" value="{{$pessoa->dt_nasc}}" />
                        </div>
                    </div>
                    <br/>
                    <div class="col-xs-12 col-sm-12 col-md-12 text-center" class="btn btn-primary">
                            <button  class="btn btn-primary" type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                    <div class="pull-right">
                        <a class="btn btn-primary" href="{{ route('pessoa.index') }}"> voltar</a>
                    </div>
                </div>
        </form>
    </div>
</div>
@endsection