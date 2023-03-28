@extends('layouts.master')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Relatório de Revisões</h2>
            </div>
            <div class="pull-right">
            </div>
        </div>
    </div>

    <div class="table-responsive">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Marcas com maior número de revisões</h5>
                <table class="table table-bordered ">
                    <tr>
                        <th>Marca</th>
                        <th>Revisões</th>
                    </tr>

                    @foreach ($marcas as $marca)
                        <tr>
                            <td>{{ $marca->nome }}</td>
                            <td>{{ $marca->total }}</td>

                        </tr>
                    @endforeach
                </table>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Pessoas com maior número de revisões</h5>
                <table class="table table-bordered ">
                    <tr>
                        <th>Pessoa</th>
                        <th>Revisões</th>
                    </tr>

                    @foreach ($pessoas as $pessoa)
                        <tr>
                            <td>{{ $pessoa->nome }}</td>
                            <td>{{ $pessoa->total }}</td>

                        </tr>
                    @endforeach
                </table>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Média de Tempo entre Revisões</h5>
                <table class="table table-bordered ">
                    <tr>
                        <th>Pessoa</th>
                        <th>Média</th>
                        <th>Próxima Revisão</th>
                    </tr>

                    @foreach ($revisoes_pessoas as $r)
                        <tr>
                            <td>{{ $r['nome'] }}</td>
                            <td>{{ $r['media'] }} - dias</td>
                            <td>{{ $r['proxima'] }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection
