@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Relatório de Pessoas</h2>
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
                        <th>Nome</th>
                        <th>Genero</th>
                        <th>Idade</th>
                    </tr>

                    @foreach ($pessoas as $pessoa)
                        <tr>
                            <td>{{ $pessoa->id }}</td>
                            <td>{{ $pessoa->nome }}</td>
                            <td>{{ $pessoa->genero }}</td>
                            <td>{{ $pessoa->idade }}</td>

                        </tr>
                    @endforeach
                </table>
                {!! $pessoas->links() !!}
                <div class="row">
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Homens</h5>
                                <p class="card-text">{{$homens->total}}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Mulheres</h5>
                                <p class="card-text">{{$mulheres->total}}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Média idade Homens</h5>
                                <p class="card-text">{{number_format($homens->media)}}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Média idade Mulheres</h5>
                                <p class="card-text">{{number_format($mulheres->media)}}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
