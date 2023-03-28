@extends('layouts.master')
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="h2">
                        <h2 class="pull-left">Gerenciamento de Revisões</h2>
                        <a class="btn btn-success" class="pull-right" href="{{ route('revisao.create') }}">Nova Revisão</a>
                    </div>
                </div>
            </div>
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif
            <h5 class="card-title">Filtros</h5>
            <form action="{{ route('revisao.index.filtro') }}" method="POST">
                @csrf
                <div class="">
                    <div class="mb-3">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Data inicial:</strong>
                                <input type="date" name="ini" class="form-control" />
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Data final:</strong>
                                <input type="date" name="fim" class="form-control" />
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Filtrar</button>
                    <button type="submit" class="btn btn-primary">Limpar</button>
                </div>
            </form>

            <table class="table table-bordered">
                <tr>
                    <th>Id</th>
                    <th>Proprietário</th>
                    <th>Veículo</th>
                    <th>Data</th>
                    <th width="280px">Action</th>
                </tr>

                @foreach ($revisoes as $revisao)
                    <tr>
                        <td>{{ $revisao->id }}</td>
                        <td>{{ $revisao->pessoa->nome }}</td>
                        <td>{{ $revisao->carro->placa . ' / ' . $revisao->carro->modelo }}</td>
                        <td>{{ $revisao->data_revisao }}</td>
                        <td>
                            <form action="{{ route('revisao.destroy', $revisao->id) }}" method="POST">
                                <a class="btn btn-primary" href="{{ route('revisao.edit', $revisao->id) }}">Editar</a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Apagar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection
