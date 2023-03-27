@extends('pessoa.layout')
@section('content')

<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Cadastro de Carro</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('carro.index') }}"> voltar</a>
        </div>
    </div>
</div>

<form action="{{ route('carro.store') }}" method="POST">
    @csrf
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Pessoa:</strong>
                <input type="text" class="form-control" value="{{$pessoa->nome}}" readonly>
                <input type="hidden" name="pessoa_id" class="form-control" value="{{$pessoa->id}}">
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Placa:</strong>
                <input type="text" class="form-control" name="placa" placeholder="Placa">
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Modelo:</strong>
                <input type="text" class="form-control" name="modelo" placeholder="Modelo">
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Marca:</strong>
                <select name="marca" class="form-control">
                    <option value="">Selecione</option>
                    <option value="HONDA">Honda</option>
                    <option value="TOYOTA">Toyota</option>
                    <option value="CHEVROLET">Chevrolet</option>
                    <option value="FORD">Ford</option>
                    <option value="MERCEDES">Mercedes</option>
                    <option value="BMW">BMW</option>
                </select>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Cor:</strong>
                <input type="text" class="form-control" name="cor" placeholder="Cor">
            </div>
        </div>

       
        
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Salvar</button>
        </div>
    </div>
</form>
@endsection