@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Relatório de Carros</h2>
            </div>
            <div class="pull-right">
            </div>
        </div>
    </div>

    <div class="table-responsive">
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered ">
                    <tr>
                        <th>Id</th>
                        <th>Proprietário</th>
                        <th>Placa</th>
                        <th>Modelo</th>
                    </tr>

                    @foreach ($carros as $carro)
                        <tr>
                            <td>{{  $carro->id }}</td>
                            <td>{{ $carro->pessoa->nome }}</td>
                            <td>{{ $carro->placa }}</td>
                            <td>{{ $carro->modelo }}</td>

                        </tr>
                    @endforeach
                </table>


            </div>
        </div>
    </div>
@endsection
