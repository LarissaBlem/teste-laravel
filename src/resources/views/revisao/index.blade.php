@extends('pessoa.layout')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Teste do mozão</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('revisao.create') }}">Nova Revisao</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

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

    {!! $revisoes->links() !!}
@endsection