@extends('layouts.master')
@section('content')

 <div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Cadastro de Cliente</h2>
                </div>
            </div>
        </div>

        <form class="mb-3" action="{{ route('pessoa.store') }}" method="POST">
            @csrf
            <div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="">
                        <strong>Nome:</strong>
                        <input type="text" name="nome" class="form-control" placeholder="Nome Completo" aria-label="default input example">
                    </div>
                </div>

                <div  class="mb-3">
                    <div class="">
                        <strong>Gênero:</strong>
                        <select name="genero" class="form-select" aria-label="Default select example">
                            <option value="F">Feminino</option>
                            <option value="M">Masculino</option>
                        </select>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Data de Nascimento:</strong>
                        <input type="date" name="dt_nasc" />
                    </div>
                </div>
                <br/>
                <div class="col-xs-12 col-sm-12 col-md-12 text-center" class="card-body">
                        <button  class="btn btn-primary" type="submit" class="btn btn-primary">Salvar</button>
                        <a class="btn btn-primary" href="{{ route('pessoa.index') }}"> voltar</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection