@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Gerenciamento de revisões</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('pessoa.create') }}">Novo Cliente</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <div class="table-responsive">

        <table class="table table-bordered ">
            <tr>
                <th>Id</th>
                <th>Nome</th>
                <th>Genero</th>
                <th>Idade</th>
                <th width="280px">Action</th>
            </tr>

            @foreach ($pessoas as $pessoa)
                <tr>
                    <td>{{ $pessoa->id }}</td>
                    <td>{{ $pessoa->nome }}</td>
                    <td>{{ $pessoa->genero }}</td>
                    <td>{{ $pessoa->idade }}</td>
                    <td>
                        <form action="{{ route('pessoa.destroy', $pessoa->id) }}" method="POST">
                            <a class="btn btn-info" href="{{ route('pessoa.show', $pessoa->id) }}">Detalhes</a>
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
    {!! $pessoas->links() !!}
@endsection
