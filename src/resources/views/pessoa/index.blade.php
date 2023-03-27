@extends('layouts.master')
@section('content')
    <div class="table-responsive" class="container">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12 margin-tb">
                        <div class="pull-left">
                            <h2>Gerenciamento de Pessoas</h2>
                        </div>
                        <div class="pull-right">
                            <a class="btn btn-success" href="{{ route('pessoa.create') }}">Novo Cliente</a>
                        </div>
                    </div>
                </div>
                <br/>
                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                @endif

            
                <h5 class="card-title">Filtros</h5>
                <form action="{{ route('pessoa.index.filtro') }}" method="POST">
                    @csrf
                    <div class="">
                        <div class="mb-3">
                            <select class="form-select" aria-label="Default select example" name="genero">
                                <option selected>Selecione</option>
                                <option value="F">Feminino</option>
                                <option value="M">Masculino</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Filtrar</button>
                        <button type="submit" class="btn btn-primary">Limpar</button>
                    </div>
                </form>
                <table class="table table-bordered ">
                    <tr>
                        <th class="col">Id</th>
                        <th class="col">Nome</th>
                        <th class="col">Genero</th>
                        <th class="col">Idade</th>
                        <th class="col" width="280px">Action</th>
                    </tr>

                    @foreach ($pessoas as $pessoa)
                        <tr>
                            <td>{{ $pessoa->id }}</td>
                            <td>{{ $pessoa->nome }}</td>
                            <td>{{ $pessoa->genero }}</td>
                            <td>{{ $pessoa->idade }}</td>
                            <td>
                                <form action="{{ route('pessoa.destroy', $pessoa->id) }}" method="POST">
                                    <a class="btn btn-info" href="{{ route('carro.index.pessoa', $pessoa->id) }}">Veículos</a>
                                    <a class="btn btn-primary" href="{{ route('pessoa.edit', $pessoa->id) }}">Editar</a>
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
    </div>
    {!! $pessoas->links() !!}
@endsection
