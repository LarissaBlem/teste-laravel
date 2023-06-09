@extends('pessoa.layout')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Teste do mozão</h2>
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
            <th>Placa</th>
            <th>Marca</th>
            <th>Modelo</th>
            <th>Cor</th>
            <th width="280px">Action</th>
        </tr>

        @foreach ($carros as $carro)
        <tr>
            <td>{{ $carro->id }}</td>
            <td>{{ $carro->pessoa->nome }}</td>
            <td>{{ $carro->placa }}</td>
            <td>{{ $carro->marca }}</td>
            <td>{{ $carro->modelo }}</td>
            <td>{{ $carro->cor }} </td>
            <td>
                <form action="{{ route('carro.destroy', $carro->id) }}" method="POST">
                    <a class="btn btn-primary" href="{{ route('carro.edit',$carro->id) }}">Editar</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Apagar</button>
                </form>
            </td>
        </tr>

        @endforeach
    </table>

    {!! $carros->links() !!}
@endsection