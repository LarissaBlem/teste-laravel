@extends('layouts.master')
@section('content')

<div class= "card">
    <div class="card-body">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Cadastro de Carro</h2>
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
                        <select name="marca_id" class="form-control">
                        @foreach ($marcas as $marca)
                            <option value="{{$marca->id}}">{{$marca->nome}}</option>
                        @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Cor:</strong>
                        <input type="text" class="form-control" name="cor" placeholder="Cor">
                    </div>
                </div>
               
                <br/>
                <div class="col-xs-12 col-sm-12 col-md-12 text-center" class="card-body">
                        <button type="submit" class="btn btn-primary">Salvar</button>
                        <a class="btn btn-primary" href="{{ route('carro.index') }}"> voltar</a>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection